<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="promotions/create" class="button is-primary">
                        <strong>Create new promotion</strong>
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

            <b-table-column field="category" label="Before products" v-slot="props">
                {{ props.row.before_product }}
            </b-table-column>

            <b-table-column label="Products" v-slot="props">
                <div v-for="product in props.row.products">
                    <div>Title: {{ product.title }}</div>
                    <div>Price: {{ product.price }}</div>
                </div>
            </b-table-column>

            <b-table-column field="category" label="After products" v-slot="props">
                {{ props.row.after_product }}
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

        </b-table>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar";

export default {
    name: "Promotions",
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
            api.request('get', '/api/promotions').then((response) => {
                this.data = response[0];
            });
        },
        deletePopup(id, title) {
            this.deleteID = id;
            this.showPopup = true;
            this.$buefy.dialog.confirm({
                message: 'Do you want delete ' + title,
                onConfirm: () => this.deletePromotion()
            })
        },
        deletePromotion() {
            api.request('delete', '/api/promotions/' + this.deleteID);
            this.$buefy.toast.open('Promotion deleted');
            this.data.splice(this.deleteID - 1, 1);
        }
    }
}
</script>

<style scoped>

</style>
