import Vue from 'vue'
import { ToastPlugin, ModalPlugin } from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import vSelect from 'vue-select'
import mdiVue from 'mdi-vue/v2'
import * as mdijs from '@mdi/js'
import DatePicker from 'vue2-datepicker'
import VueDragscroll from 'vue-dragscroll'
import { VuejsDatatableFactory } from 'vuejs-datatable'
import VueSweetalert2 from 'vue-sweetalert2'
import store from './store'
import router from './router'
import App from './App.vue'
import 'vue2-datepicker/index.css'
// Global Components
import './global-components'

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css'

// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'
import 'vue-select/dist/vue-select.css'
import 'vue-search-select/dist/VueSearchSelect.css'
// import 'alga-css/dist/alga.min.css'
// window.Jquery.$ = require('jquery')
// window.dt = require('datatables.net')()
// BSV Plugin Registration
Vue.use(VueSweetalert2)
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)
Vue.use(mdiVue, {
  icons: mdijs,
})
Vue.use(VueDragscroll)
Vue.use(VuejsDatatableFactory)
Vue.component('date-picker', DatePicker)
// <mdicon name="mdi:folder-open" />
Vue.component('v-select', vSelect)

// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/style.scss')

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
