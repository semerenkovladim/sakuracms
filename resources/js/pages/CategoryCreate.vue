<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Product title*">
                        <b-input placeholder="Category title"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Parent category*">
                        <b-select placeholder="Select a category" v-model="category_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
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
    name: "CategoryCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            title: '',
            category_id: null,
            data: [],
        }
    },
    methods: {
        retriveApi() {
            api.request('get', '/api/categories').then((response) => {
                this.data = response[0];
            });
        },
        create() {
            const payload = {
                title: this.title,
                category_id: this.category_id
            }
            axios.post('/api/categories?_method=put', payload).then((res) => {
                    this.$buefy.toast.open({
                        message: 'Category added successful! You will be redirected to categories list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/categories');
                    }, 2000);
            }).catch((error) => {
                if(error.response.status === 401) {
                    const token = window.localStorage.getItem('token');
                    const user = window.localStorage.getItem('user');
                    const refresh_token = window.localStorage.getItem('refresh_token');
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                    const data = {
                        refresh_token: refresh_token
                    }
                    axios.post('/api/login/refresh', data)
                        .then((res) => {
                            auth.login(res.data.token, res.data.refresh_token, res.data.user);
                            this.create();
                        })

                }
                if(error.response.status === 403) {
                    this.$buefy.toast.open({
                        message: error.response.data.message,
                        type: 'is-danger'
                    });
                } else if(error.response.status === 422) {
                    this.$buefy.toast.open({
                        message: error.response.data.message,
                        type: 'is-danger'
                    });
                }
            });
        }
    },
    created() {
        this.retriveApi();
    },
    computed: {
        disableBtn() {
            if(this.title.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
