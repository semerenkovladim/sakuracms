<template>
    <div class="container">
        <Sidebar/>

        <div class="columns">
            <div class="column">
                <div class="buttons">
                    <router-link to="promotions/create" class="button is-primary">
                        <strong>{{ $t('promotions.createPromotion') }}</strong>
                    </router-link>
                </div>
            </div>
        </div>
        <b-table
            :data="data.data">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="title" :label="$t('promotions.title')" v-slot="props">
                {{ props.row.title }}
            </b-table-column>

            <b-table-column field="category" :label="$t('promotions.beforeProducts')" v-slot="props">
                {{ props.row.before_product }}
            </b-table-column>

            <b-table-column :label="$t('promotions.products')" v-slot="props">
                <div v-for="product in props.row.products" :key="product.id">
                    <div>Title: {{ product.title }}</div>
                    <div>Price: {{ product.price }}</div>
                </div>
            </b-table-column>

            <b-table-column field="category" :label="$t('promotions.afterProducts')" v-slot="props">
                {{ props.row.after_product }}
            </b-table-column>

            <b-table-column field="date" :label="$t('promotions.sendingAt')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.sending_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column field="date" :label="$t('promotions.createAt')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column :label="$t('promotions.delete')" v-slot="props">
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
        this.getResults();
    },
    methods: {
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
        },
        getResults(page = 1) {
            api.request('get','/api/promotions?page=' + page)
                .then(response => {
                    this.data = response;
                });
        }
    }
}
</script>

<style scoped>

</style>
