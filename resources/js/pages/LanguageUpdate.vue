<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Language title*">
                        <b-input placeholder="Language title"
                                 v-model="language.title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Language ISO*">
                        <b-input placeholder="Language ISO"
                                 v-model="language.iso"
                                 type="text"
                                 required
                                 maxlength="3">
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
import Sidebar from "../components/Sidebar";

export default {
    name: "LanguageUpdate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            language: [],
        }
    },
    methods: {
        async retrievApi() {
            let { data } = await axios.get(`/api/language/${this.id}`);
            this.language = data[0];
        },
        update() {
            const payload = {
                title: this.language.title,
                iso: this.language.iso
            }
            api.request('post',`/api/languages/${this.id}`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Language update successful! You will be redirected to languages list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/languages');
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
            if(this.language.title.length === 0 || this.language.iso.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
