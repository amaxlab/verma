import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import ScreenLogin from '@/screens/Login'
import store from '@/store'

Vue.use(Router);

let router = new Router({
    routes: [
        {
            path: '/',
            name: 'HelloWorld',
            component: HelloWorld,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: ScreenLogin,
            meta: {
                guest: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (store.getters['session/isExpired']) {
        store.dispatch('session/refreshToken');
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.state.session.accessToken == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('user'));
            if (to.matched.some(record => record.meta.is_admin)) {
                if (user.is_admin === 1) {
                    next()
                } else {
                    next({ name: 'userboard'})
                }
            } else {
                next()
            }
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('jwt') == null){
            next()
        } else {
            next({ name: 'userboard'})
        }
    } else {
        next()
    }
});

export default router
