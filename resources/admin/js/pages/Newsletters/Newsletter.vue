<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="newsletter/create" class="button is-primary">
                        <strong>{{ $t('newsletters.createNewsletter') }}</strong>
                    </router-link>
                </div>
            </div>
        </div>
        <b-table
            :data="data.data">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="title" :label="$t('newsletters.title')" v-slot="props">
                {{ props.row.title }}
            </b-table-column>

            <b-table-column field="body" :label="$t('newsletters.body')" v-slot="props">
                {{ props.row.body }}
            </b-table-column>

            <b-table-column field="date" :label="$t('newsletters.sendingAt')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.sending_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column field="date" :label="$t('newsletters.createAt')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column :label="$t('newsletters.delete')" v-slot="props">
                <b-button @click="deletePopup(props.row.id, props.row.title)">
                    <b-icon icon="delete"/>
                </b-button>
            </b-table-column>
        </b-table>
        <pagination :data="data" class="mb-3" @pagination-change-page="getResults" :limit="-1" align="center"></pagination>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "Newsletter",
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
                onConfirm: () => this.deleteNewsletter()
            })
        },
        deleteNewsletter() {
            api.request('delete', '/api/newsletters/' + this.deleteID);
            this.$buefy.toast.open('Newsletter deleted');
            this.data.splice(this.deleteID - 1, 1);
        },
        getResults(page = 1) {
            api.request('get','/api/newsletters?page=' + page)
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
