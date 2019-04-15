import Vue from 'vue'
import VueRouter from 'vue-router'
import AuthService from './services/auth'

/*
 |--------------------------------------------------------------------------
 | Admin Views
 |--------------------------------------------------------------------------|
 */

// Dashboard
import Basic from './views/admin/dashboard/Basic.vue'

// Layouts
import LayoutBasic from './views/layouts/LayoutBasic.vue'
import LayoutLogin from './views/layouts/LayoutLogin.vue'

// Auth
import Login from './views/auth/Login'

// Pages
import Pages from './views/admin/pages/Index'
import PageCreate from './views/admin/pages/Create'
import PageShow from './views/admin/pages/Show'

import NotFoundPage from './views/errors/404'

Vue.use(VueRouter)

const routes = [

    /*
     |--------------------------------------------------------------------------
     | Admin Backend Routes
     |--------------------------------------------------------------------------|
     */
    {
        path: '/backend',
        component: LayoutBasic, // Change the desired Layout here
        meta: {requiresAuth: true},
        children: [
            // Dashboard
            {
                path: '',
                component: Basic,
                name: 'dashboard'
            },
            // Pages
            {
                path: 'pages',
                component: Pages,
                name: 'pages.index'
            },
            {
                path: 'pages/create/:parent_id?',
                component: PageCreate,
                name: 'page.create'
            },
            {
                path: 'pages/:id',
                component: PageShow,
                name: 'page.show'
            },
        ]
    },

    /*
     |--------------------------------------------------------------------------
     | Auth & Registration Routes
     |--------------------------------------------------------------------------|
     */

    {
        path: '/backend',
        component: LayoutLogin,
        children: [
            {
                path: 'login',
                component: Login,
                name: 'login'
            },
        ]
    },

    //  DEFAULT ROUTE
    {path: '*', component: NotFoundPage}
]

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: 'active'
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(m => m.meta.requiresAuth)) {
        return AuthService.check().then(authenticated => {
            if (!authenticated) {
                return next({name: 'login'})
            }

            return next()
        })
    }

    return next()
})

export default router
