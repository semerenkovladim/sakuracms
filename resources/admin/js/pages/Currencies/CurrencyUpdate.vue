<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Currency title*">
                        <b-input placeholder="Currency title"
                                 v-model="currency.title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Currency ISO*">
                        <b-input placeholder="Currency ISO"
                                 v-model="currency.iso"
                                 type="text"
                                 required
                                 maxlength="3">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Currency ratio*">
                        <b-input placeholder="Currency ratio"
                                 v-model="currency.ratio"
                                 type="number"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button type="is-primary" expanded @click="update" v-if="!disableBtn">Create</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "CurrencyUpdate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            currency: [],
        }
    },
    methods: {
        retrievApi() {
            api.request('get',`/api/currency/${this.id}`).then((res) => {
                console.log(res);
                this.currency = res.data;
            });
        },
        update() {
            const payload = {
                title: this.currency.title,
                iso: this.currency.iso,
                ratio: this.currency.ratio
            }
            api.request('post',`/api/currencies/${this.id}`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Currency update successful! You will be redirected to currencies list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/currencies');
                    }, 2000);
                });
        }
    },
    created() {
        this.id = this.$route.params['id'];
        this.retrievApi();
    },
    computed: {
        disableBtn() {
            if(this.currency.title.length === 0 || this.currency.iso.length === 0 || this.currency.ratio.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
