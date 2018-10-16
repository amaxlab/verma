import Vue from 'vue'
import Vuex from 'vuex'
import session from './modules/session'
import loader from './modules/loader'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        session,
        loader
    },
});
