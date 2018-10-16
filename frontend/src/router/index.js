import Vue from 'vue'
import Router from 'vue-router'
import Login from '../screens/Login'
import Dashboard from '../screens/Dashboard'
import Users from '../screens/Users'
import UserView from '../screens/UserView'
import Projects from '../screens/Projects'
import store from '@/store'

Vue.use(Router);

let router = new Router({
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/projects',
            name: 'projects',
            component: Projects,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/users/:id',
            name: 'user_view',
            component: UserView,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/users',
            name: 'users',
            component: Users,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                guest: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters['session/isAuthenticated'] !== true) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router
