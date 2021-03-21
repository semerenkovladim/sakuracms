<template>
    <div class="container">
        <Sidebar/>

    <div class="columns">
        <div class="column">
            <div class="buttons">
                <a class="button is-primary" href="/admin/products/create">
                    <strong>Create new product</strong>
                </a>
            </div>
        </div>
    </div>
    <b-table
        :data="data">

        <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
            {{ props.row.id }}
        </b-table-column>

        <b-table-column label="Images" v-slot="props">
            <b-image
                :src="'/storage' + props.row.images[0].path"
                alt="A random image"
                ratio="6by4" v-if="props.row.images.length !== 0"></b-image>
            <b-image
                src="/storage/image/empty/no_image.jpg"
                alt="A random image"
                ratio="6by4" v-else></b-image>
        </b-table-column>

        <b-table-column field="title" label="Title" v-slot="props">
            {{ props.row.title }}
        </b-table-column>

        <b-table-column field="description" label="Description" v-slot="props">
            {{ props.row.description }}
        </b-table-column>

        <b-table-column field="short_description" label="Short Description" v-slot="props">
            {{ props.row.short_description }}
        </b-table-column>

        <b-table-column field="meta_tags" label="Meta Tags" v-slot="props">
            {{ props.row.meta_tags }}
        </b-table-column>

        <b-table-column field="meta_description" label="Meta Description" v-slot="props">
            {{ props.row.meta_description }}
        </b-table-column>

        <b-table-column field="meta_title" label="Meta Title" v-slot="props">
            {{ props.row.meta_title }}
        </b-table-column>

        <b-table-column field="category" label="Category" v-slot="props">
            {{ props.row.category.title }}
        </b-table-column>

        <b-table-column field="date" label="Date" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                </span>
        </b-table-column>

        <b-table-column label="Delete" v-slot="props">
            <b-button @click="deletePopup(props.row.id, props.row.title)">
                <b-icon icon="delete"/>
            </b-button>
        </b-table-column>

        <b-table-column label="Update" v-slot="props">
            <b-button>
                <router-link :to="'/admin/products/' + props.row.id">
                    <b-icon icon="file-edit"/>
                </router-link>
            </b-button>
        </b-table-column>

    </b-table>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar";

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
        this.retriveApi();
    },
    methods: {
        retriveApi() {
            api.request('get', '/api/products').then((response) => {
                this.data = response[0];
            });
        },
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
        }
    }
}
</script>

<style scoped>

</style>
