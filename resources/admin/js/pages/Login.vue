<template>
    <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
        <div class="column is-12-mobile is-4">
            <form>
                <b-field>
                    <b-input placeholder="Email"
                             v-model="email"
                             type="email"
                             icon="email"
                             icon-right="close-circle"
                             icon-right-clickable
                             @icon-right-click="clearIconClick">
                    </b-input>
                </b-field>
                <b-field>
                    <b-input placeholder="Password"
                             v-model="password"
                             type="password"
                             icon="email" password-reveal>
                    </b-input>
                </b-field>
                <b-field>
                    <b-button type="is-primary" expanded @click="login">Login</b-button>
                </b-field>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        clearIconClick() {
            this.username = '';
        },
        login() {
            let data = {
                email: this.email,
                password: this.password
            };
            axios.post('/api/login', data)
                .then(({data}) => {
                    auth.login(data.token, data.refresh_token, data.user);

                    this.$router.push('/admin/dashboard');
                })
                .catch(({response}) => {
                    alert(response.data.message);
                });
        }
    },
}
</script>

<style scoped>

</style>
