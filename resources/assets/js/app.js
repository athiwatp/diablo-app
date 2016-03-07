import $ from 'jquery';
import Vue from 'vue';
import vueResource from 'vue-resource';

import {fade, slide} from './transisions/transisions';
import {region, battleTag, classPortrait, classText, number, classCrest, classBanner, leaderboardClassLink} from './filters/filters';

Vue.use(vueResource);

Vue.filter('battleTag', battleTag);
Vue.filter('classPortrait', classPortrait);
Vue.filter('classText', classText);
Vue.filter('number', number);
Vue.filter('classCrest', classCrest);
Vue.filter('region', region);
Vue.filter('classBanner', classBanner);
Vue.filter('leaderboardClassLink', leaderboardClassLink);

Vue.transition('fade', fade);
Vue.transition('slide', slide);

Vue.config.debug = true;

window.$ = $;
window.Vue = Vue;

$(window).scroll(function(){
    $("#top-banner .banner__content").css("opacity", 1 - $(window).scrollTop() / 450);
    $("#top-banner .banner__content").css("margin-top", $(window).scrollTop() / 2);
});

new Vue(require('./app.vue'));