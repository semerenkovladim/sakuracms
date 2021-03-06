<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-4" :label="$t('products.title')">
                        <b-input :placeholder="$t('products.title')"
                                 v-model="product.title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.price')">
                        <b-input :placeholder="$t('products.price')"
                                 v-model="product.price"
                                 type="number"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaTags')">
                        <b-taginput
                            maxlength="10"
                            :placeholder="$t('products.metaTags')"
                            v-model="product.meta_tags">
                        </b-taginput>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('products.description')">
                        <b-input type="textarea"
                                 maxlength="3000"
                                 required
                                 :placeholder="$t('products.description')" v-model="product.description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('products.shortDescription')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.shortDescription')" v-model="product.short_description"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaDescription')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.metaDescription')" v-model="product.meta_description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.metaTitle')">
                        <b-input type="textarea"
                                 maxlength="255"
                                 :placeholder="$t('products.metaTitle')" v-model="product.meta_title">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-4" :label="$t('products.category')">
                        <b-select :placeholder="$t('products.category')" v-model="product.category_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field class="column is-12-mobile is-12" :label="$t('products.images')">
                        <b-upload v-model="product.images"
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
                            <span v-for="(file, index) in product.images"
                                  :key="index"
                                  class="tag is-primary" >
                                <template v-if="file.path">
                                    {{file.path.slice(file.path.lastIndexOf('/'))}}
                                </template>
                                <template v-else>
                                    {{file.name}}
                                </template>
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
                                  @click="update"
                                  v-if="!disableBtn">
                            {{ $t('products.update') }}
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
    name: "ProductUpdate",
    components: {
        Sidebar,
    },
    data() {
        return {
            product: {},
            data: [],
            errorMsg: null,
            showError: false,
            id: '',
            tags: [],
            images: [],
        }
    },
    methods: {
        deleteDropFile(index) {
            this.product.images.splice(index, 1);
        },
        async retrievApi() {
            let { data } = await axios.get(`/api/product/${this.id}`);
            this.product = data.data;
            if(this.product.meta_tags !== null) {
                this.product.meta_tags = this.product.meta_tags.split(',');
            } else {
                this.product.meta_tags = [];
            }
        },
        async retrievCategory() {
            let { data } = await axios.get(`/api/categories-all`);
            this.data = data.data;
        },
        update() {
            const images = this.product.images.filter(file => file.type.slice(0, file.type.lastIndexOf('/')) === 'image')
            if(images.length === 0) {
                this.errorMsg = this.$t('products.errorMsg');
                this.showError = true;
                this.productImages = [];
                return false;
            }
            let tags = [];
            if(this.product.meta_tags === null) {
                tags = null;
            } else {
                tags = this.product.meta_tags.join(',');
            }
            const form = new FormData();
            form.append('title', this.product.title);
            form.append('price', this.product.price);
            form.append('description', this.product.description);
            form.append('short_description', this.product.short_description);
            form.append('meta_tags', tags);
            form.append('meta_description', this.product.meta_description);
            form.append('meta_title', this.product.meta_title);
            form.append('category_id', this.product.category_id);
            images.map((image, index) => {
                form.append(`images[${index}]`, image);
            });
            api.request('post',`/api/products/${this.id}`, form,'multipart/form-data')
                .then((response) => {
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
            if(!this.product.title || !this.product.price || !this.product.description || !this.product.short_description || !this.product.category_id || this.product.images.length === 0) {
                return true;
            } else {
                return false;
            }
        }
    },
    created() {
        this.id = this.$route.params['id'];
        this.retrievApi();
        this.retrievCategory();
    },
}
</script>

<style scoped>

</style>
