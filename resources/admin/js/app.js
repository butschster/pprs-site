import router from './router.js'
import utils from './helpers/utilities'
import store from './store'
import Vue from "vue";
require('./bootstrap')

Vue.component('quote-preview', require('../../js/components/Quote').default);

Vue.prototype.$utils = utils

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
