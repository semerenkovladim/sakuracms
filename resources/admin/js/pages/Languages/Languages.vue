<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="language/create" class="button is-primary">
                        <strong>Create new language</strong>
                    </router-link>
                </div>
            </div>
        </div>
        <b-table
            :data="data.data">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="title" label="Title" v-slot="props">
                {{ props.row.title }}
            </b-table-column>

            <b-table-column field="category" label="ISO" v-slot="props">
                    {{ props.row.iso }}
            </b-table-column>

            <b-table-column label="Delete" v-slot="props">
                <b-button @click="deletePopup(props.row.id, props.row.title)">
                    <b-icon icon="delete"/>
                </b-button>
            </b-table-column>

            <b-table-column label="Update" v-slot="props">
                <b-button>
                    <router-link :to="'/admin/languages/' + props.row.id">
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
    name: "Languages",
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
    methods: {
        deletePopup(id, title) {
            this.deleteID = id;
            this.showPopup = true;
            this.$buefy.dialog.confirm({
                message: 'Do you want delete ' + title,
                onConfirm: () => this.deleteLanguage()
            })
        },
        deleteLanguage() {
            api.request('delete', '/api/languages/' + this.deleteID);
            this.$buefy.toast.open('Language deleted');
            this.data.splice(this.deleteID - 1, 1);
        },
        getResults(page = 1) {
            api.request('get','/api/languages?page=' + page)
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
