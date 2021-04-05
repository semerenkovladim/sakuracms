<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" :label="$t('categories.title')">
                        <b-input :placeholder="$t('categories.title')"
                                 v-model="category.title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('categories.parentCategory')">
                        <b-select :placeholder="$t('categories.parentCategory')" v-model="category.category_id">
                            <option
                                v-for="option in data"
                                :value="option.id"
                                :key="option.id">
                                {{ option.title }}
                            </option>
                        </b-select>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button
                            type="is-primary"
                            expanded
                            @click="update"
                            v-if="!disableBtn">
                            {{ $t('categories.update') }}
                        </b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "CategoryUpdate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            category: [],
            data: [],
        }
    },
    methods: {
        async retrievApi() {
            let { data } = await axios.get(`/api/category/${this.id}`);
            this.category = data.data;
        },
        async retrievCategory() {
            let { data } = await axios.get(`/api/categories-all`);
            this.data = data.data;
        },
        update() {
            const payload = {
                title: this.category.title,
                category_id: this.category.category_id
            }
            api.request('post',`/api/categories/${this.id}`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Category update successful! You will be redirected to categories list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/categories');
                    }, 2000);
                });
        }
    },
    created() {
        this.id = this.$route.params['id'];
        this.retrievApi();
        this.retrievCategory();
    },
    computed: {
        disableBtn() {
            if(this.category.title.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
