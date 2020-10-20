require('./bootstrap');


import 'es6-promise'

import Vue from 'vue'

//import VueAuth from '@websanova/vue-auth'

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
//import auth from './auth'
import router from './router'
import Vuetify from 'vuetify'
import Vuex from 'vuex'
import Vuelidate from "vuelidate";

import { Form, HasError, AlertError } from 'vform'
import VueProgressBar from 'vue-progressbar'
import Snotify, { SnotifyPosition } from 'vue-snotify'

import VueTheMask from 'vue-the-mask'

//import Lightbox from 'vue-my-photos'
//Vue.component('lightbox', Lightbox);


window.Form = Form


//import 'vuetify/dist/vuetify.min.css'
//import StoreData from './store'

window.Vue = Vue


Vue.use('vue-resource');



const SnotifyOptions = {
    toast: {
        position: SnotifyPosition.rightTop
    }
}
Vue.use(Snotify, SnotifyOptions)

const VueProgressBaroptions = {
  color: '#0C7CEC',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

Vue.use(VueProgressBar, VueProgressBaroptions);

Vue.use(VueTheMask)


//support vuex
//Vue.use(Vuex)
//import storeData from "./store/index"
//const store = new Vuex.Store(StoreData)

//vuetify
//Vue.vuetify = vuetify
Vue.use(Vuetify)

//validacoes
Vue.use(Vuelidate);



// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
//Vue.use(VueAxios, axios)
axios.defaults.baseURL = "/api"
//Vue.use(VueAuth, auth)
Vue.component('pagination', require('./partial/PaginationComponent.vue').default);
Vue.component('propriedade', require('./pages/Propriedade.vue').default);
Vue.component('index', require('./Index.vue').default);



Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


const app = new Vue({
  el: '#app',
  router,
  vuetify : new Vuetify()
  

})

