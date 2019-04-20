import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import VDropdown from './components/dropdown/VDropdown'
import VDropdownItem from './components/dropdown/VDropdownItem'
import VDropdownDivider from './components/dropdown/VDropdownDivider'
import VCollapse from './components/collapse/VCollapse'
import VCollapseItem from './components/collapse/VCollapseItem'
import VueClipboard from 'vue-clipboard2'
import VueMoment from 'vue-moment'
const moment = require('moment')
require('moment/locale/ru')

/**
 * Global CSS imports
 */
// import 'vue-tabs-component/docs/resources/tabs-component.css'
// import 'vue-multiselect/dist/vue-multiselect.min.css'
// import 'vue2-dropzone/dist/vue2Dropzone.css'

/**
 * Global plugins
 */
// global.notie = require('notie')
global.toastr = require('toastr')
global._ = require('lodash')


/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

global.Vue = require('vue')

Vue.prototype.$validationErrors = {};

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

global.axios = require('axios')

global.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
}

global.token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    global.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


/**
 * Custom Directives
 */
require('./helpers/directives')

/**
 * Global Components
 */
Vue.component('v-dropdown', VDropdown)
Vue.component('v-dropdown-item', VDropdownItem)
Vue.component('v-dropdown-divider', VDropdownDivider)
Vue.component('v-collapse', VCollapse)
Vue.component('v-collapse-item', VCollapseItem)

Vue.use(VueClipboard)
Vue.use(VueRouter)
Vue.use(Vuelidate)
Vue.use(VueMoment, {
    moment
})
