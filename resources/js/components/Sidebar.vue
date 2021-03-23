<template>
    <section class="mb-5">
        <b-sidebar
            type="is-light"
            :fullheight="true"
            :overlay="true"
            v-model="open"
        >
            <div class="p-1 my-4">
                <b-menu>
                    <b-menu-list>
                        <b-menu-item icon="slideshow" label="Showcase">
                            <b-menu-item label="Products" tag="router-link" to="/admin/products"></b-menu-item>
<!--                            <b-menu-item label="Tags" tag="router-link" to="/admin/tags"></b-menu-item>-->
<!--                            <b-menu-item label="Attributes" tag="router-link" to="/admin/attributes"></b-menu-item>-->
                            <b-menu-item label="Categories" tag="router-link" to="/admin/categories"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Business">
                            <b-menu-item label="Orders" tag="router-link" to="/admin/orders"></b-menu-item>
<!--                            <b-menu-item label="Messages" tag="router-link" to="/admin/messages"></b-menu-item>-->
<!--                            <b-menu-item label="Reviews" tag="router-link" to="/admin/reviews"></b-menu-item>-->
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Themes">
                            <b-menu-item label="Themes" tag="router-link" to="/admin/themes"></b-menu-item>
                            <b-menu-item label="Modules" tag="router-link" to="/admin/modules"></b-menu-item>
                            <b-menu-item label="Hooks" tag="router-link" to="/admin/hooks"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Localization">
                            <b-menu-item label="Languages" tag="router-link" to="/admin/languages"></b-menu-item>
                            <b-menu-item label="Currencies" tag="router-link" to="/admin/currencies"></b-menu-item>
                            <b-menu-item label="Translation" tag="router-link" to="/admin/translation"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Users">
                            <b-menu-item label="Users" tag="router-link" to="/admin/users"></b-menu-item>
                            <b-menu-item label="Administrators" tag="router-link" to="/admin/admins"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Statistics">
                            <b-menu-item label="Orders" tag="router-link" to="/admin/statistics/orders"></b-menu-item>
                            <b-menu-item label="Devices" tag="router-link" to="/admin/statistics/devices"></b-menu-item>
                            <b-menu-item label="Countries" tag="router-link" to="/admin/statistics/countries"></b-menu-item>
                        </b-menu-item>
                    </b-menu-list>
                </b-menu>
            </div>
        </b-sidebar>
        <b-navbar>
            <template #brand>
                <b-navbar-item href="#" @click.prevent="open = true">
                    <b-icon icon="menu" size="is-medium"></b-icon>
                </b-navbar-item>
            </template>
            <template #start>
                <b-navbar-item tag="router-link" :to="{ path: '/admin/dashboard' }">
                    <img
                        src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                        alt="Lightweight UI components for Vue.js based on Bulma"
                    >
                </b-navbar-item>
            </template>

            <template #end>
                <b-navbar-item tag="div">
                    <div class="buttons">
                        <a class="button is-primary" href="/">
                            <strong>Visit shop</strong>
                        </a>
                        <a class="button is-light">
                            Logout
                        </a>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>
    </section>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
            open: false,
        }
    }
}
</script>

<style scoped>

</style>
