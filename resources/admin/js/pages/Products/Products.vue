<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="products/create" class="button is-primary">
                        <strong>{{ $t('products.createProduct') }}</strong>
                    </router-link>
                </div>
            </div>
        </div>
        <b-table
            :data="data.data">

            <b-table-column field="id" :label="$t('products.id')" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column :label="$t('products.images')" v-slot="props">
                <b-image
                    :src="'/storage' + props.row.images[0].path"
                    alt="A random image"
                    ratio="6by4" v-if="props.row.images.length !== 0"></b-image>
                <b-image
                    src="/storage/image/empty/no_image.jpg"
                    alt="A random image"
                    ratio="6by4" v-else></b-image>
            </b-table-column>

            <b-table-column field="title" :label="$t('products.title')" v-slot="props">
                {{ props.row.title }}
            </b-table-column>

            <b-table-column field="description" :label="$t('products.description')" v-slot="props">
                <template v-if="props.row.description.length > 255">
                    {{ props.row.description.slice(0, 255) }}
                    <b-collapse :open="false" position="is-bottom" aria-id="contentIdForA11y1">
                        <template #trigger="props">
                            <a aria-controls="contentIdForA11y1">
                                <b-icon :icon="!props.open ? 'menu-down' : 'menu-up'"></b-icon>
                                {{ !props.open ? 'All options' : 'Fewer options' }}
                            </a>
                        </template>
                        {{ props.row.description.slice(256) }}
                    </b-collapse>
                </template>
                <template v-else>
                    {{ props.row.description }}
                </template>
            </b-table-column>

            <b-table-column field="short_description" :label="$t('products.shortDescription')" v-slot="props">
                {{ props.row.short_description }}
            </b-table-column>

            <b-table-column field="meta_tags" :label="$t('products.metaTags')" v-slot="props">
                {{ props.row.meta_tags }}
            </b-table-column>

            <b-table-column field="meta_description" :label="$t('products.metaDescription')" v-slot="props">
                {{ props.row.meta_description }}
            </b-table-column>

            <b-table-column field="meta_title" :label="$t('products.metaTitle')" v-slot="props">
                {{ props.row.meta_title }}
            </b-table-column>

            <b-table-column field="category" :label="$t('products.category')" v-slot="props">
                {{ props.row.category.title }}
            </b-table-column>

            <b-table-column field="price" :label="$t('products.price')" v-slot="props">
                {{ props.row.price }}
            </b-table-column>

            <b-table-column field="date" :label="$t('products.date')" centered v-slot="props">
                    <span class="tag is-success">
                        {{ new Date(props.row.created_at).toLocaleDateString() }}
                    </span>
            </b-table-column>

            <b-table-column :label="$t('products.delete')" v-slot="props">
                <b-button @click="deletePopup(props.row.id, props.row.title)">
                    <b-icon icon="delete"/>
                </b-button>
            </b-table-column>

            <b-table-column :label="$t('products.update')" v-slot="props">
                <b-button>
                    <router-link :to="'/admin/products/' + props.row.id">
                        <b-icon icon="file-edit"/>
                    </router-link>
                </b-button>
            </b-table-column>
        </b-table>
        <pagination :data="data" class="mb-3" @pagination-change-page="getResults" :limit="-1" align="center"></pagination>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "Products",
    components: {
        Sidebar,
    },
    data() {
        return {
            data: [],
            deleteID: '',
            showPopup: false,
        }
    },
    created() {
        this.getResults();
    },
    methods: {
        deletePopup(id, title) {
            this.deleteID = id;
            this.showPopup = true;
            this.$buefy.dialog.confirm({
                message: 'Do you want delete ' + title,
                onConfirm: () => this.deleteProduct()
            })
        },
        deleteProduct() {
            api.request('delete', '/api/products/' + this.deleteID);
            this.$buefy.toast.open('Product deleted');
            this.data.splice(this.deleteID - 1, 1);
        },
        getResults(page = 1) {
            api.request('get','/api/products?page=' + page)
                .then(response => {
                    this.data = response;
                });
        }
    }
}
</script>

<style scoped>

</style>
