import $ from 'jquery';
import Vue from 'vue';
import vueResource from 'vue-resource';
import app from './app.vue';

import {battleTag, classPortrait, classText} from './filters/filters.js';

Vue.use(vueResource);

Vue.filter('battleTag', battleTag);
Vue.filter('classPortrait', classPortrait);
Vue.filter('classText', classText);

Vue.config.debug = true;

window.$ = $;
window.Vue = Vue;

new Vue(app);