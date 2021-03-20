<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6">
                        <b-input placeholder="Product title"
                                 v-model="title"
                                 type="text"
                                 icon="email">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-input placeholder="Product price"
                                 v-model="price"
                                 type="number"
                                 icon="email"
                                 required
                                 icon-right="close-circle"
                                 icon-right-clickable
                                 @icon-right-click="price = ''"
                                 minlength="1"
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-input type="textarea"
                                 minlength="10"
                                 maxlength="2000"
                                 required
                                 placeholder="Product description" v-model="description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-input type="textarea"
                                 minlength="10"
                                 maxlength="255"
                                 placeholder="Product short description" v-model="short_description"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-input type="textarea"
                                 minlength="10"
                                 maxlength="255"
                                 placeholder="Product meta description" v-model="meta_description">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-input type="textarea"
                                 minlength="10"
                                 maxlength="255"
                                 placeholder="Product meta title" v-model="meta_title">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-taginput
                            maxlength="10"
                            placeholder="Product meta tags"
                            v-model="meta_tags">
                        </b-taginput>
                    </b-field>
                    <b-field class="column is-12-mobile is-6">
                        <b-select placeholder="Select a category" v-model="category_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field class="column is-12">
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
                    <b-field class="column is-12">
                        <b-button type="is-primary" expanded @click="create" v-if="!disableBtn">Create</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar";

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
