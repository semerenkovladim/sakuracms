<template>
    <div class="container">
        <Sidebar/>
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <div class="column is-12-mobile is-12">
                <form class="is-flex is-flex-wrap-wrap">
                    <b-field class="column is-12-mobile is-6" :label="$t('newsletters.title')">
                        <b-input :placeholder="$t('newsletters.title')"
                                 v-model="title"
                                 type="text"
                                 required
                                 maxlength="255">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('newsletters.body')">
                        <b-input :placeholder="$t('newsletters.body')"
                                 v-model="body"
                                 type="textarea"
                                 required
                                 maxlength="2000">
                        </b-input>
                    </b-field>
                    <b-field class="column is-12-mobile is-6" :label="$t('newsletters.sendingAt')">
                        <b-datetimepicker
                            v-model="sending_at"
                            placeholder="Click to select..."
                            icon="calendar-today"
                            trap-focus>
                        </b-datetimepicker>
                    </b-field>
                    <b-field class="column is-12-mobile is-12">
                        <b-button type="is-primary" expanded @click="create" v-if="!disableBtn">{{ $t('newsletters.create') }}</b-button>
                    </b-field>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar";

export default {
    name: "NewsletterCreate",
    components: {
        Sidebar,
    },
    data() {
        return {
            title: '',
            body: '',
            sending_at: new Date(),
        }
    },
    methods: {
        create() {
            const payload = {
                title: this.title,
                body: this.body,
                sending_at: this.sending_at,
            }
            api.request('post',`/api/newsletters/?_method=put`, payload)
                .then((response) => {
                    this.$buefy.toast.open({
                        message: 'Newsletter create successful! You will be redirected to newsletters list',
                        type: 'is-success'
                    });
                    setTimeout(() => {
                        this.$router.push('/admin/newsletters');
                    }, 2000);
                });
        }
    },
    computed: {
        disableBtn() {
            if(this.title.length === 0 || this.body.length === 0) {
                return true
            }
            return false
        }
    }
}
</script>

<style scoped>

</style>
