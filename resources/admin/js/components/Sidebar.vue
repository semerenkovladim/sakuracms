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
                        <b-menu-item :label="$t('sidebar.showcase')">
                            <b-menu-item :label="$t('sidebar.products')" tag="router-link" to="/admin/products"></b-menu-item>
                            <b-menu-item :label="$t('sidebar.categories')" tag="router-link" to="/admin/categories"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item :label="$t('sidebar.business')">
                            <b-menu-item :label="$t('sidebar.orders')" tag="router-link" to="/admin/orders"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item :label="$t('sidebar.localization')">
                            <b-menu-item :label="$t('sidebar.languages')" tag="router-link" to="/admin/languages"></b-menu-item>
                            <b-menu-item :label="$t('sidebar.currencies')" tag="router-link" to="/admin/currencies"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item :label="$t('sidebar.newsletter')">
                            <b-menu-item :label="$t('sidebar.news')" tag="router-link" to="/admin/newsletters"></b-menu-item>
                            <b-menu-item :label="$t('sidebar.promotions')" tag="router-link" to="/admin/promotions"></b-menu-item>
                        </b-menu-item>
                        <b-menu-item>
                            <template #label>
                                {{ $t('sidebar.currentLanguage') }}
                                <b-dropdown aria-role="list" class="is-pulled-right" position="is-bottom-left">
                                    <template #trigger>
                                        <b-icon icon="dots-vertical"></b-icon>
                                    </template>
                                    <b-dropdown-item aria-role="listitem" @click="setLocale('en')">EN</b-dropdown-item>
                                    <b-dropdown-item aria-role="listitem" @click="setLocale('ru')">RU</b-dropdown-item>
                                </b-dropdown>
                            </template>
                        </b-menu-item>
                        <b-menu-item :label="$t('sidebar.additional')">
                            <div class="buttons">
                                <a class="button is-primary" href="/">
                                    <strong>{{ $t('sidebar.visitShop') }}</strong>
                                </a>
                                <a class="button is-light" @click="logout">
                                    {{ $t('sidebar.logout') }}
                                </a>
                            </div>
                        </b-menu-item>
                    </b-menu-list>
                </b-menu>
            </div>
        </b-sidebar>
        <b-navbar :mobile-burger="false">
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
                            <strong>{{ $t('sidebar.visitShop') }}</strong>
                        </a>
                        <a class="button is-light" @click="logout">
                            {{ $t('sidebar.logout') }}
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
    },
    methods: {
        logout() {
            auth.logout();
            this.$router.push('/admin/login');
        },
        setLocale(locale) {
            this.$i18n.locale = locale;
            window.localStorage.setItem('locale', locale);
        }
    }
}
</script>

<style scoped>

</style>
