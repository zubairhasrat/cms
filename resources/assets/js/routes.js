import Router from 'vue-router';
import { sync } from 'vuex-router-sync'
import { store } from './store/store.js'
import Vue from 'vue';
// const unsync = sync(store, router)
Vue.use(Router);

const ifNotAuthenticated = (to, from, next) => {
    if (router.app.$store.getters.getLoginStatus) {
      next();
      return;
    }
    next('/');
  };
let routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: require('./components/admin/DashBoard'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/posts',
        name: 'posts',
        component: require('./components/posts/posts'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/addPost',
        name: 'addPost',
        component: require('./components/admin/post/addPost'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/posts/login')
    },
    {
        path: '/registration',
        name: 'registration',
        component: require('./components/posts/registration'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/viewPost',
        name: 'viewPost',
        component: require('./components/admin/post/viewAllPost'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/viewComments',
        component: require('./components/admin/comment/viewComments'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/addUsers',
        name: 'addUsers',
        component: require('./components/admin/user/addusers'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/viewUser',
        name: 'viewUser',
        component: require('./components/admin/user/viewAllUser'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/editUser',
        name: 'editUser',
        props: true,
        component: require('./components/admin/user/editUser'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/category',
        name: 'category',
        component: require('./components/admin/category/categories'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/role',
        name: 'role',
        component: require('./components/admin/user/viewRoles'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/addRole',
        name: 'addRole',
        component: require('./components/admin/user/addRoles'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/editrole',
        name: 'editrole',
        props: true,
        component: require('./components/admin/user/editRole'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/viewPermission',
        name: 'viewpermissions',
        component: require('./components/admin/user/viewPermissions'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/addPermission',
        name: 'addPermission',
        component: require('./components/admin/user/addPermission'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/editPermission',
        name: 'editpermission',
        props: true,
        component: require('./components/admin/user/editPermission'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/editPost',
        name: 'editPost',
        props: true,
        component: require('./components/admin/post/editPost'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/detailpost',
        name: 'detailpost',
        props: true,
        component: require('./components/posts/postDetail'),
        beforeEnter: ifNotAuthenticated
    },
    {
        path: '/',
        component: require('./components/posts/allPosts')
    }
];

const router = new Router({
    routes,
});
export default router
// router.beforeEach((to, from, next) => {
//     if (router.app.$store.getters.getLoginStatus == false) {
       
//         next("/")
//     } else {
//         next()
//     }
// })