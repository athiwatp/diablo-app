var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.config.debug = true;
window.Vue = Vue;

new Vue(require('./app.vue')).$mount('#app');