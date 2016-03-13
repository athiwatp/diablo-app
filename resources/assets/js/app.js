import $ from 'jquery';
import Vue from 'vue';
import vueResource from 'vue-resource';
import transitions from './transisions/transisions';
import animations from './animations/animations';
import filters from './filters/filters';
import banner from './components/banner/banner.vue';
import mainHeader from './components/main-header/main-header.vue';
import mainContent from './components/main-content/main-content.vue';

Vue.use(vueResource);
Vue.config.debug = true;

for (var key in transitions) {
	Vue.transition(key, transitions[key]);
}

for (var key in filters) {
	Vue.filter(key, filters[key]);
}

Vue.component('banner', banner);
Vue.component('main-header', mainHeader);
Vue.component('main-content', mainContent);

for (var key in animations) {
	Vue.component(key, animations[key]);
}

window.$ = $;
window.Vue = Vue;

$(window).scroll(function(){
    $("#top-banner .banner__content").css("opacity", 1 - $(window).scrollTop() / 450);
    $("#top-banner .banner__content").css("margin-top", $(window).scrollTop() / 2);
});

new Vue(require('./app.vue'));