import CKEditor from '@ckeditor/ckeditor5-vue';
import router from './router.js'
import utils from './helpers/utilities'
import store from './store'
require('./bootstrap')

Vue.prototype.$utils = utils
Vue.use(CKEditor);

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
    store
})
