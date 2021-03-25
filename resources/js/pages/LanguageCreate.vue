<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" label="Language title*">
                        <b-input placeholder="Language title"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" label="Language ISO*">
                        <b-input placeholder="Language ISO"
                                 v-model="iso"
                                 type="text"
                                 required
                                 maxlength="3">
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
    name: "LanguageCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            id: '',
            title: '',
            iso: ''
        }
    },
    methods: {
        create() {
            const payload = {
                title: this.title,
                iso: this.iso
            }
            api.request('post',`/api/languages/?_method=put`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Language create successful! You will be redirected to languages list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/languages');
                    }, 2000);
                });
        }
    },
    computed: {
        disableBtn() {
            if(this.title.length === 0 || this.iso.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
