import $ from 'jquery';
import Vue from 'vue';
import vueResource from 'vue-resource';

import {fade, slide} from './transisions/transisions';
import {battleTag, classPortrait, classText, number} from './filters/filters';

Vue.use(vueResource);

Vue.filter('battleTag', battleTag);
Vue.filter('classPortrait', classPortrait);
Vue.filter('classText', classText);
Vue.filter('number', number);

Vue.transition('fade', fade);
Vue.transition('slide', slide);

Vue.config.debug = true;

window.$ = $;
window.Vue = Vue;

new Vue(require('./app.vue'));