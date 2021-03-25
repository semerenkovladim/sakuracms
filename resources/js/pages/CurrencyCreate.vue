<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Currency title*">
                        <b-input placeholder="Currency title"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Currency ISO*">
                        <b-input placeholder="Currency ISO"
                                 v-model="iso"
                                 type="text"
                                 required
                                 maxlength="3">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Currency ratio*">
                        <b-input placeholder="Currency ratio"
                                 v-model="ratio"
                                 type="number"
                                 required>
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button type="is-primary" expanded @click="create" v-if="!disableBtn">Create</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar";

export default {
    name: "CurrencyCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            title: '',
            iso: '',
            ratio: '',
        }
    },
    methods: {
        create() {
            const payload = {
                title: this.title,
                iso: this.iso,
                ratio: this.ratio,
            }
            api.request('post',`/api/currencies/?_method=put`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Currency create successful! You will be redirected to currencies list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/currencies');
                    }, 2000);
                });
        }
    },
    computed: {
        disableBtn() {
            if(this.length === 0 || this.length === 0 || this.ratio.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
