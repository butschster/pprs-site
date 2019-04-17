import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

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
import PagesIndex from './views/admin/pages/Index'
import PageCreate from './views/admin/pages/Create'
import PageShow from './views/admin/pages/Show'

// Quotes
import QuotesIndex from './views/admin/quotes/Index'
import QuoteCreate from './views/admin/quotes/Create'
import QuoteShow from './views/admin/quotes/Show'

// News
import NewsIndex from './views/admin/news/Index'
import NewsCreate from './views/admin/news/Create'
import NewsShow from './views/admin/news/Show'

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
                component: PagesIndex,
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
            // Quotes
            {
                path: 'quotes',
                component: QuotesIndex,
                name: 'quotes.index'
            },
            {
                path: 'quotes/create',
                component: QuoteCreate,
                name: 'quote.create'
            },
            {
                path: 'quotes/:id',
                component: QuoteShow,
                name: 'quote.show'
            },
            // News
            {
                path: 'news',
                component: NewsIndex,
                name: 'news.index'
            },
            {
                path: 'news/create',
                component: NewsCreate,
                name: 'news.create'
            },
            {
                path: 'news/:id',
                component: NewsShow,
                name: 'news.show'
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
        if (store.getters['auth/isLoggedIn']) {
            next()
            return
        }

        return next({name: 'login'})
    }

    return next()
})

export default router
