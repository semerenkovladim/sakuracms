<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="newsletter/create" class="button is-primary">
                        <strong>Create new newsletter</strong>
                    </router-link>
                </div>
            </div>
        </div>
        <b-table
            :data="data">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="title" label="Title" v-slot="props">
                {{ props.row.title }}
            </b-table-column>

            <b-table-column field="category" label="Body" v-slot="props">
                {{ props.row.body }}
            </b-table-column>

            <b-table-column field="date" label="Sending at" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.sending_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column field="date" label="Create at" centered v-slot="props">
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
                    <router-link :to="'/admin/newsletter/' + props.row.id">
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
        }
    },
    created() {
        api.request('get', '/api/newsletters').then((response) => {
            this.data = response[0];
        });
    },
}
</script>

<style scoped>

</style>
