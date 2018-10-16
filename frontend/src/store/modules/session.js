import router from '../../router'
import axios from 'axios'
import jwt_decode from 'jwt-decode';

const accessToken = localStorage.getItem('accessToken');
const payload = accessToken ? jwt_decode(accessToken) : {};

const state = {
    payload: payload,
    accessToken: accessToken,
    refreshToken: localStorage.getItem('refreshToken')
};

const getters = {
    isExpired() {
        //TODO make this implementation
        return false;
    },
    isAuthenticated: state => {
        return true;
        //state.payload.roles
    }
};

const actions = {
    login({ dispatch, commit }, { username, password }) {
        // TODO make config
        axios.post('http://127.0.0.1:8000/api/users/token', {
            username: username,
            password: password
        })
        .then(response => {
            commit('successLogin', {accessToken: response.data.token, refreshToken:response.data.refresh_token});
        })
        .catch(function (error) {
            commit('failLogin');
        });
    },
    refreshToken({ commit, state }) {
        axios.post('http://127.0.0.1:8000/api/users/token/refresh', {
            refresh_token: state.refreshToken
        })
        .then(response => {
            commit('successLogin', {accessToken: response.data.token, refreshToken:response.data.refresh_token});
        })
        .catch(function (error) {
            commit('failLogin');
        });
    },
    logout({ commit }) {
        commit('logout');
    }
};

const mutations = {
    successLogin(state, {accessToken, refreshToken}) {
        state.accessToken = accessToken;
        state.refreshToken = refreshToken;
        state.payload = jwt_decode(accessToken);

        localStorage.setItem('accessToken', accessToken);
        localStorage.setItem('refreshToken', refreshToken);

        router.push('/');
    },
    failLogin(state) {
        state.accessToken = null;
        state.refreshToken = null;

        localStorage.removeItem('accessToken');
        localStorage.removeItem('refreshToken');
    },
    logout(state) {
        state.accessToken = null;
        state.refreshToken = null;

        localStorage.removeItem('accessToken');
        localStorage.removeItem('refreshToken');

        router.push('/login');
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
