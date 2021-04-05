<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" :label="$t('orders.status')">
                        <b-select :placeholder="$t('orders.status')" v-model="order.status_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button type="is-primary" expanded @click="update">{{ $t('orders.update') }}</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "OrderUpdate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            order: [],
            data: [],
        }
    },
    methods: {
        retrievApi() {
            api.request('get', `/api/order/${this.id}`).then((res) => {
                this.order = res.data;
            });
        },
        async retrievStatuses() {
            api.request('get', `/api/order-statuses`).then((res) => {
                this.data = res.data;
            });

        },
        update() {
            const payload = {
                status_id: this.order.status_id
            }
            api.request('post',`/api/orders/${this.id}`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Order update successful! You will be redirected to orders list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/orders');
                    }, 2000);
                });
        }
    },
    created() {
        this.id = this.$route.params['id'];
        this.retrievApi();
        this.retrievStatuses();
    },
}
</script>

<style scoped>

</style>
