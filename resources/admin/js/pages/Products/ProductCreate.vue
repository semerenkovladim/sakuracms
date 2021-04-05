<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-4" :label="$t('products.title')">
                        <b-input :placeholder="$t('products.title')"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.price')">
                        <b-input :placeholder="$t('products.price')"
                                 v-model="price"
                                 type="number"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaTags')">
                        <b-taginput
                            maxlength="10"
                            :placeholder="$t('products.metaTags')"
                            v-model="meta_tags">
                        </b-taginput>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('products.description')">
                        <b-input type="textarea"
                                 maxlength="3000"
                                 required
                                 :placeholder="$t('products.description')" v-model="description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('products.shortDescription')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.shortDescription')" v-model="short_description"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaDescription')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.metaDescription')" v-model="meta_description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaTitle')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.metaTitle')" v-model="meta_title">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.category')">
                        <b-select :placeholder="$t('products.category')" v-model="category_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field class="column is-12-mobile is-12" :label="$t('products.images')">
                        <b-upload v-model="productImages"
                                  multiple
                                  drag-drop required expanded>
                            <section class="section">
                                <div class="content has-text-centered">
                                    <p>
                                        <b-icon
                                            icon="upload"
                                            size="is-large">
                                        </b-icon>
                                    </p>
                                    <p>Drop your files here or click to upload</p>
                                </div>
                            </section>
                        </b-upload>
                        <div class="tags">
                            <span v-for="(file, index) in productImages"
                                  :key="index"
                                  class="tag is-primary" >
                                {{file.name}}
                                <button class="delete is-small"
                                        type="button"
                                        @click="deleteDropFile(index)">
                                </button>
                            </span>
                        </div>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button type="is-primary"
                                  expanded
                                  @click="create"
                                  v-if="!disableBtn">
                            {{ $t('products.create') }}
                        </b-button>
                    </b-field>
                </form>
                <b-notification
                    type="is-danger"
                    has-icon
                    aria-close-label="Close notification"
                    role="alert" v-if="showError">
                    {{errorMsg}}
                </b-notification>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "ProductCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            title: '',
            price: '',
            description: '',
            short_description: '',
            meta_tags: [],
            meta_description: '',
            meta_title: '',
            category_id: null,
            data: [],
            productImages: [],
            errorMsg: null,
            showError: false,
        }
    },
    methods: {
        retriveApi() {
            api.request('get', '/api/categories').then((response) => {
                this.data = response[0];
            });
        },
        deleteDropFile(index) {
            this.productImages.splice(index, 1);
        },
        create() {
            const images = this.productImages.filter(file => file.type.slice(0, file.type.lastIndexOf('/')) === 'image')
            if(images.length === 0) {
                this.errorMsg = this.$t('products.errorMsg');
                this.showError = true;
                this.productImages = [];
                return false;
            }
            const tags = this.meta_tags.join(',');
            const form = new FormData();
            form.append('title', this.title);
            form.append('price', this.price);
            form.append('description', this.description);
            form.append('short_description', this.short_description);
            form.append('meta_tags', tags);
            form.append('meta_description', this.meta_description);
            form.append('meta_title', this.meta_title);
            form.append('category_id', this.category_id);
            images.map((image, index) => {
                form.append(`images[${index}]`, image);
            })
            api.request('post','/api/products?_method=put', form,'multipart/form-data')
                .then(() => {
                    this.$buefy.toast.open({
                        message: this.$t('products.successful',['update']),
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/products');
                    }, 2000);
            });
        }
    },
    computed: {
        disableBtn() {
            if(!this.title || !this.price || !this.description || !this.short_description || !this.category_id || this.productImages.length === 0) {
                return true;
            } else {
                return false;
            }
        }
    },
    created() {
        this.retriveApi();
    }
}
</script>

<style scoped>

</style>
