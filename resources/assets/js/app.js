
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('list-input', require('./components/list-input.vue'));
Vue.component('sub-form', require('./components/sub-form.vue'));
Vue.component('exercises', require('./components/exercises.vue'));
Vue.component('list-med', require('./components/list-med.vue'));

/*const app = new Vue({
    el: '#app'
});*/

