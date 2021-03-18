import Vue from 'vue';
import VueRouter from 'vue-router';
import isAuth from './middleware/isAuth';
import Login from './pages/Login.vue';
import middlewarePipeline from "./middleware/middlewarePipeline";

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
            meta: {
                middleware: [
                    isAuth
                ]
            }
        }
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
