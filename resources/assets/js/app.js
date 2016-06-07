import $ from 'jquery'
import Vue from 'vue'
import Resource from 'vue-resource'
import Transitions from './transisions/transisions'
import Animations from './animations/animations'
import Filters from './filters/filters'
import App from './app.vue'
import banner from './components/banner/banner.vue'
import mainHeader from './components/main-header/main-header.vue'
import mainContent from './components/main-content/main-content.vue'

Vue.use(Resource)
Vue.config.debug = true

for (let key in Transitions) {
	Vue.transition(key, Transitions[key])
}

for (let key in Filters) {
	Vue.filter(key, Filters[key])
}

for (let key in Animations) {
	Vue.component(key, Animations[key])
}

Vue.component('banner', banner);
Vue.component('main-header', mainHeader);
Vue.component('main-content', mainContent);

window.$ = $;
window.Vue = Vue;

new Vue(App);