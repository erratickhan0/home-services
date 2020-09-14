// Route components
import VueRouter from 'vue-router'

const routes = [

    /* Login page */
    {
        name: 'home',
        path: '/admin/',
        meta: {
            title: 'Home Services',

            bodyClass: 'hold-transition login-page',
            noHeader: true

        },
        component: require('./components/auth/login').default,
    },
    {
        name: 'category-management',
        path: '/admin/category-management',
        meta: {
            title: 'Home Services',
            bodyClass: 'skin-green',
            noHeader: true,
            requiresAuth: true
        },
        component: require('./components/category/category').default,
    },
    {
        name: 'labour-management',
        path: '/admin/labour-management',
        meta: {
            title: 'Home Services',
            bodyClass: 'skin-green',
            noHeader: true,
            requiresAuth: true
        },
        component: require('./components/labour/labour').default,
    },
    {
        name: 'job-management',
        path: '/admin/job-management',
        meta: {
            title: 'Home Services',
            bodyClass: 'skin-green',
            noHeader: true,
            requiresAuth: true
        },
        component: require('./components/job/job').default,
    },

];


// Create the router instance
const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
    app,
});

const admin = 1;
const title = document.title;

router.beforeEach((to, from, next) => {
    return next();
});

export default router
