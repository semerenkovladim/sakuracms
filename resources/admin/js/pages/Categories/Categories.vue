<template>
    <main>
        <Sidebar/>
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="buttons">
                        <router-link to="categories/create" class="button is-primary">
                            <strong>{{ $t('categories.createCategory') }}</strong>
                        </router-link>
                    </div>
                </div>
            </div>
            <b-table
                :data="data.data" class="mb-3">

                <b-table-column field="id" :label="$t('categories.id')" width="40" numeric v-slot="props">
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="title" :label="$t('categories.title')" v-slot="props">
                    {{ props.row.title }}
                </b-table-column>

                <b-table-column field="category" :label="$t('categories.parentCategory')" v-slot="props">
                    <template v-if="props.row.category">
                        {{ props.row.category.title }}
                    </template>
                    <template v-else>
                        none
                    </template>
                </b-table-column>

                <b-table-column field="products" :label="$t('categories.countProducts')" v-slot="props">
                    {{ props.row.products.length }}
                </b-table-column>

                <b-table-column field="date" :label="$t('categories.date')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                </span>
                </b-table-column>

                <b-table-column :label="$t('categories.delete')" v-slot="props">
                    <b-button @click="deletePopup(props.row.id, props.row.title)">
                        <b-icon icon="delete"/>
                    </b-button>
                </b-table-column>

                <b-table-column :label="$t('categories.update')" v-slot="props">
                    <b-button>
                        <router-link :to="'/admin/categories/' + props.row.id">
                            <b-icon icon="file-edit"/>
                        </router-link>
                    </b-button>
                </b-table-column>

            </b-table>
            <pagination :data="data" class="mb-3" @pagination-change-page="getResults" :limit="-1" align="center"></pagination>
        </div>
    </main>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "Categories",
    components: {
        Sidebar,
    },
    data() {
        return {
            data: {},
            deleteID: '',
            showPopup: false,
        }
    },
    methods: {
        deletePopup(id, title) {
            this.deleteID = id;
            this.showPopup = true;
            this.$buefy.dialog.confirm({
                message: 'Do you want delete ' + title,
                onConfirm: () => this.deleteCategory()
            })
        },
        deleteCategory() {
            api.request('delete', '/api/categories/' + this.deleteID);
            this.$buefy.toast.open('Category deleted');
            this.data.splice(this.deleteID - 1, 1);
            this.data.filter((item) => {
                if(item.category_id === this.deleteID) {
                    item.category = null;
                }
            })
        },
        getResults(page = 1) {
            api.request('get','/api/categories?page=' + page)
                .then(response => {
                    this.data = response;
                });
        }
    },
    created() {
        this.getResults();
    },
}
</script>

<style scoped>

</style>
