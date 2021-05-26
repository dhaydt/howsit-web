import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const routes = [
    //project route
    {
        path: '/',
        component: home,
        name: '/'
    },
    {
        path: '/register',
        component: register,
        name: 'register'
    },
    {
        path: '/tags',
        component: tags,
        name: 'tags'
    },
    {
        path: '/category',
        component: category,
        name: 'category'
    },
    {
        path: '/createblog',
        component: createblog,
        name: 'createblog'
    },

    {
        path: '/adminusers',
        component: adminusers,
        name: 'adminusers'
    },
    {
        path: '/login',
        component: login,
        name: 'login'
    },
    {
        path: '/role',
        component: role,
        name: 'role'
    },
    {
        path: '/assignrole',
        component: assignrole,
        name: 'assignrole'
    },

]

export default new Router({
    mode: 'history',
    routes
})
