<template>
    <div class="container">
        <Sidebar/>
        <b-table
            :data="data.data">

            <b-table-column field="id" label="ID" width="40" numeric v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column :label="$t('orders.userEmail')" v-slot="props">
                {{ props.row.user.email }}
            </b-table-column>

            <b-table-column :label="$t('orders.userFullname')" v-slot="props">
                {{ `${props.row.user.name} ${props.row.user.surname}` }}
            </b-table-column>

            <b-table-column :label="$t('orders.products')" v-slot="props">
                <div v-for="product in props.row.products">
                    <div>Title: {{ product.title }}</div>
                    <div>Price: {{ product.price }}</div>
                </div>
            </b-table-column>

            <b-table-column :label="$t('orders.total')" v-slot="props">
                {{ props.row.total }}
            </b-table-column>

            <b-table-column :label="$t('orders.status')" v-slot="props">
                <b-tag type="is-dark" v-if="props.row.status.title === 'Created'">{{ props.row.status.title }}</b-tag>
                <b-tag type="is-info" v-else-if="props.row.status.title === 'Accepted'">{{ props.row.status.title }}</b-tag>
                <b-tag type="is-primary" v-else-if="props.row.status.title === 'Confirmed'">{{ props.row.status.title }}</b-tag>
                <b-tag type="is-success" v-else>{{ props.row.status.title }}</b-tag>
            </b-table-column>

            <b-table-column field="date" :label="$t('orders.date')" centered v-slot="props">
                <span class="tag is-success">
                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column :label="$t('orders.delete')" v-slot="props">
                <b-button @click="deletePopup(props.row.id, props.row.title)">
                    <b-icon icon="delete"/>
                </b-button>
            </b-table-column>

            <b-table-column :label="$t('orders.update')" v-slot="props">
                <b-button v-if="props.row.status.title !== 'Completed'">
                    <router-link :to="'/admin/orders/' + props.row.id">
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
    name: "Orders",
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
                onConfirm: () => this.deleteOrders()
            })
        },
        deleteOrders() {
            api.request('delete', '/api/orders/' + this.deleteID);
            this.$buefy.toast.open('Order deleted');
            this.data.splice(this.deleteID - 1, 1);
        },
        getResults(page = 1) {
            api.request('get','/api/orders?page=' + page)
                .then(response => {
                    this.data = response;
                });
        }
    },
    created() {
        this.getResults();
    }
}
</script>

<style scoped>

</style>
