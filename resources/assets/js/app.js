import $ from 'jquery';
import Vue from 'vue';
import vueResource from 'vue-resource';
import app from './app.vue';

Vue.use(vueResource);
Vue.config.debug = true;

window.$ = $;
window.Vue = Vue;

new Vue(app);