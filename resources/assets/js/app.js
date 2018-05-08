require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import router from './routes.js'
import store from './store/store.js'
import VeeValidate from 'vee-validate'
Vue.use(VueRouter)
Vue.use(VeeValidate)
Vue.component('sidebar-component', require('./components/admin/sideBar.vue'));
Vue.component('posts-component', require('./components/posts/posts.vue'))
Vue.component('allposts-component', require('./components/posts/allPosts.vue'))
Vue.component('header-component',require('./components/posts/header.vue'))
 var mainApp = Vue.extend(require('./app.vue'));
 var adminApp = Vue.extend(require('./admin.vue'));
 const app1 = new Vue({
    el: "#main",
    store,
    router,
    render: h => h(mainApp)
    });
export default { app1, router, store };