/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
let subdomain = location.hostname.split('.').shift();
     // alert('subdomain is ' + subdomain);
require('./bootstrap');

window.Vue = require('vue').default;
Vue.use(require('vue-moment'));
window.axios = require('axios');
import VueEasyLightbox from 'vue-easy-lightbox'
import wysiwyg from "vue-wysiwyg";
import VEmojiPicker from 'v-emoji-picker';
import VueSocketIO from 'vue-socket.io';
import socketio from 'socket.io-client';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

var domainname = window.location.origin;
// const SocketInstance = socketio.connect('http://'+subdomain+'.quotebiz.local:3000');
const SocketInstance = socketio.connect('http://'+subdomain+'.shopgrabthis.com:3000');
Vue.use(new VueSocketIO({
    debug: true,
    connection: SocketInstance
}));
Vue.use(VueToast);
Vue.use(VueEasyLightbox)
Vue.use(VEmojiPicker);
Vue.use(wysiwyg, {});
//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Vue.config.productionTip = false;
window.axios.defaults.baseURL = domainname;
Vue.prototype.$hostname = domainname;

// window.axios.defaults.baseURL = 'http://'+subdomain+'.shopgrabthis.com/';
// Vue.prototype.$hostname = 'http://'+subdomain+'.shopgrabthis.com/'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('leads-component', require('./components/serviceprovider/LeadsComponent.vue').default);
Vue.component('responses-component', require('./components/serviceprovider/ResponsesComponent.vue').default);

// Customer

Vue.component('customer-responses-component', require('./components/customer/ResponsesComponent.vue').default);

// Question
Vue.component('question-component', require('./components/QuestionComponent.vue').default);

// Admin Question
Vue.component('question-admin-component', require('./components/QuestionAdminComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
