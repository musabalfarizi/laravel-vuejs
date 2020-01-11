/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window._ = require('lodash');
global.$ = global.jQuery = require('jquery');

Vue.config.devtools = true;
Vue.config.performance = true;



import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Index from './components/PostboardComponent.vue';
import Create from './components/CreateComponent.vue';
import Read from './components/ReadComponent.vue';

import Update from './components/UpdateComponent.vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('Leaderboard', require('./components/LeaderboardComponent.vue').default);
Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('example-component', require('./components/DatangComponent.vue').default);
Vue.component('Postboard', require('./components/PostboardComponent.vue').default);


const routes = [
  { path: '/', component: Index },
  { path: '/create', component: Create },
  { path: '/read/:id', component: Read, name:'readPost' },
  { path: '/:id/edit', component: Update, name:'editPost' }

]

const router = new VueRouter({
  routes // short for `routes: routes`
})

const app = new Vue({
  router
}).$mount('#app')
/**
const app = new Vue({
    el: '#app',
});
**/
/**
import App from './components/App.vue';

const app = new Vue({
  el: '#app',
  components: {
    App
  },
  render: h => h(App)
});
*/
