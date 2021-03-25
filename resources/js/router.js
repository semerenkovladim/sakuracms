import Vue from 'vue';
import VueRouter from 'vue-router';
import isAuth from './middleware/isAuth';
import Login from './pages/Login.vue';
import middlewarePipeline from "./middleware/middlewarePipeline";
import Dashboard from "./pages/Dashboard";
import Products from "./pages/Products";
import ProductCreate from "./pages/ProductCreate";
import ProductUpdate from "./pages/ProductUpdate";
import Categories from "./pages/Categories";
import CategoryCreate from "./pages/CategoryCreate";
import CategoryUpdate from "./pages/CategoryUpdate";
import Orders from "./pages/Orders";
import OrderUpdate from "./pages/OrderUpdate";
import Languages from "./pages/Languages";
import LanguageUpdate from "./pages/LanguageUpdate";
import LanguageCreate from "./pages/LanguageCreate";
import Currencies from "./pages/Currencies";
import CurrencyUpdate from "./pages/CurrencyUpdate";
import CurrencyCreate from "./pages/CurrencyCreate";
import Newsletter from "./pages/Newsletter";
import NewsletterCreate from "./pages/NewsletterCreate";
import Promotions from "./pages/Promotions";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/admin/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/admin/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/products',
            name: 'products',
            component: Products,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/products/create',
            name: 'products.create',
            component: ProductCreate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/products/:id',
            name: 'products.update',
            component: ProductUpdate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/categories',
            name: 'categories',
            component: Categories,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/categories/create',
            name: 'categories.create',
            component: CategoryCreate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/categories/:id',
            name: 'categories.update',
            component: CategoryUpdate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/orders',
            name: 'orders',
            component: Orders,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/orders/:id',
            name: 'orders.update',
            component: OrderUpdate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/languages',
            name: 'languages',
            component: Languages,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/languages/:id',
            name: 'languages.update',
            component: LanguageUpdate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/language/create',
            name: 'languages.create',
            component: LanguageCreate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/currencies',
            name: 'currencies',
            component: Currencies,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/currency/create',
            name: 'currencies.create',
            component: CurrencyCreate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/currency/:id',
            name: 'currencies.update',
            component: CurrencyUpdate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/newsletters',
            name: 'newsletters',
            component: Newsletter,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/newsletter/create',
            name: 'newsletters.create',
            component: NewsletterCreate,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
        {
            path: '/admin/promotions',
            name: 'promotions',
            component: Promotions,
            meta: {
                middleware: [
                    isAuth
                ]
            }
        },
    ]
});
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next
    }
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})
export default router;
