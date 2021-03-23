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
