var Vue = require('vue');
Vue.config.debug = true;
window.Vue = Vue;

new Vue(require('./app.vue')).$mount('#app');