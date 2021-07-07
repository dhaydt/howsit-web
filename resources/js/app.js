/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import moment from 'moment';
import VueEvents from 'vue-events'
import VueResource from 'vue-resource';
import Vue from 'vue';
import vuetify from './components/plugins/vuetify';
require('./bootstrap');

window.Vue = require('vue').default;
window.Vue = require('vue')
require('vue-events')



Vue.use(VueResource)
const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)
Vue.use(VueEvents)

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY | hh:mm')
    }
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("agora-chat", require("./components/AgoraChat.vue").default);
Vue.component("chat-app", require("./components/pages/chatApp.vue").default);
Vue.component("info-page", require("./components/pages/info.vue").default);
Vue.component("setting-page", require("./components/pages/setting.vue").default);
Vue.component("group-page", require("./components/pages/group.vue").default);
Vue.component("furnite-page", require("./components/pages/furnite.vue").default);
Vue.component("help-page", require("./components/pages/help.vue").default);
Vue.component("notify-item", require("./components/notify.vue").default);

//-------------------------------Home Component
Vue.component("chat-home", require("./components/chatHome/chatApp.vue").default);
Vue.component("call-home", require("./components/chatHome/AgoraChat.vue").default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify
});
