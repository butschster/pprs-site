import router from './router.js'
import utils from './helpers/utilities'
import store from './store'
import Vue from "vue";
require('./bootstrap')

Vue.component('quote-preview', require('../../js/components/Quote').default);

Vue.prototype.$utils = utils

/**
 * Global Axios Request Interceptor
 */

global.axios.interceptors.request.use((config) => {
    // Do something before request is sent
    const bearerString = store.getters['auth/bearerString']

    if (bearerString) {
        config.headers.common['Authorization'] = bearerString
    }

    return config
}, error => {
    return Promise.reject(error)
})

global.axios.interceptors.response.use(response => {
    store.dispatch('validation/clear')
    return response
}, error => {
    switch (error.response.status) {
        case 422:
            store.dispatch('validation/setErrors', error.response.data.errors)
            break;
    }

    return Promise.reject(error)
})

const app = new Vue({
    el: '#app',
    router,
    store,
    created() {
        this.$moment.locale('ru')
    }
})
