<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Promotion title*">
                        <b-input placeholder="Promotion title"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Promotion before products*">
                        <b-input placeholder="Promotion before products"
                                 v-model="before_product"
                                 type="textarea"
                                 required
                                 maxlength="2000">
                        </b-input>
                    </b-field>

                    <b-field class="column is-12-mobile is-6" label="Promotion after products*">
                        <b-input placeholder="Promotion after products"
                                 v-model="after_product"
                                 type="textarea"
                                 required
                                 maxlength="2000">
                        </b-input>
                    </b-field>

                    <b-field class="column is-12-mobile is-6" label="Promotion products*">
                        <b-dropdown
                            append-to-body
                            aria-role="menu"
                            scrollable
                            max-height="200"
                            trap-focus
                            :close-on-click="false"
                        >
                            <template #trigger>
                                <a
                                    class="navbar-item"
                                    role="button">
                                    <span>Products</span>
                                    <b-icon icon="menu-down"></b-icon>
                                </a>
                            </template>

                            <b-dropdown-item custom aria-role="listitem">
                                <b-input v-model="searchTerm" placeholder="search" expanded />
                            </b-dropdown-item>

                            <b-dropdown-item v-for="item of filteredData" :key="item.id" aria-role="listitem">
                                <b-checkbox v-model="products_id"
                                            :native-value="item.id">
                                    {{ item.title }}
                                </b-checkbox>
                            </b-dropdown-item>
                        </b-dropdown>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Promotion send*">
                        <b-datetimepicker
                            v-model="sending_at"
                            placeholder="Click to select..."
                            icon="calendar-today"
                            trap-focus>
                        </b-datetimepicker>
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
    name: "PromotionCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            searchTerm: '',
            title: '',
            before_product: '',
            after_product: '',
            products_id: [],
            products: [],
            sending_at: new Date(),
        }
    },
    methods: {
        retriveApi() {
            api.request('get', '/api/products').then((response) => {
                this.products = response[0];
            });
        },
        create() {
            const payload = {
                title: this.title,
                before_product: this.before_product,
                after_product: this.after_product,
                products_id: this.products_id,
                sending_at: this.sending_at
            }
            api.request('post',`/api/promotions/?_method=put`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Promotion create successful! You will be redirected to promotions list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/promotions');
                    }, 2000);
                });
        }
    },
    computed: {
        disableBtn() {
            if(!this.title || !this.before_product || !this.after_product || this.products_id.length === 0) {
                return true;
            } else {
                return false;
            }
        },
        filteredData() {
            return this.products.filter((item) => item.title.toLowerCase().indexOf(this.searchTerm.toLowerCase()) >= 0);
        }
    },
    created() {
        this.retriveApi();
    }
}
</script>

<style scoped>

</style>
