<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="currency/create" class="button is-primary">
                        <strong>Create new currency</strong>
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

            <b-table-column field="iso" label="ISO" v-slot="props">
                {{ props.row.iso }}
            </b-table-column>

            <b-table-column field="ratio" label="Ratio" v-slot="props">
                {{ props.row.ratio }}
            </b-table-column>

            <b-table-column label="Delete" v-slot="props">
                <b-button @click="deletePopup(props.row.id, props.row.title)">
                    <b-icon icon="delete"/>
                </b-button>
            </b-table-column>

            <b-table-column label="Update" v-slot="props">
                <b-button>
                    <router-link :to="'/admin/currency/' + props.row.id">
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
    name: "Currencies",
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
                onConfirm: () => this.deleteCurrency()
            })
        },
        deleteCurrency() {
            api.request('delete', '/api/currencies/' + this.deleteID);
            this.$buefy.toast.open('Currency deleted');
            this.data.splice(this.deleteID - 1, 1);
        }
    },
    created() {
        api.request('get', '/api/currencies').then((response) => {
            this.data = response[0];
        });
    },
}
</script>

<style scoped>

</style>
