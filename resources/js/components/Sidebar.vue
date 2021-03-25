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
                            <b-menu-item label="Categories" tag="router-link" to="/admin/categories"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Business">
                            <b-menu-item label="Orders" tag="router-link" to="/admin/orders"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Localization">
                            <b-menu-item label="Languages" tag="router-link" to="/admin/languages"></b-menu-item>
                            <b-menu-item label="Currencies" tag="router-link" to="/admin/currencies"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Translation">
                            <b-menu-item label="Products" tag="router-link" to="/admin/translation/products"></b-menu-item>
                            <b-menu-item label="Categories" tag="router-link" to="/admin/translation/categories"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item icon="slideshow" label="Import/Export">
                            <b-menu-item label="Export" tag="router-link" to="/admin/export"></b-menu-item>
                            <b-menu-item label="Import" tag="router-link" to="/admin/import"></b-menu-item>
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
