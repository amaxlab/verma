import axios from 'axios';
import store from '@/store';

const baseUrl = 'http://127.0.0.1:8000';

const client = {
    get: (url) => new Promise ((resolve, reject) => {
        store.commit('loader/show');
        axios.get(baseUrl+url, {
            headers: {
                Accept: 'application/ld+json',
                Authorization: 'bearer '+store.state.session.accessToken
            }
        }).then(response => {
            store.commit('loader/hide');
            resolve(response.data);
        }).catch(error => {
            store.commit('loader/hide');
            reject(error);
        });
    }),
    post: (url, data) => new Promise ((resolve, reject) => {
        store.commit('loader/show');
        axios.post(baseUrl+url, data, {
            headers: {
                Accept: 'application/ld+json',
                Authorization: 'bearer '+store.state.session.accessToken
            }
        }).then(response => {
            store.commit('loader/hide');
            resolve(response.data);
        }).catch(error => {
            store.commit('loader/hide');
            reject(error);
        });
    }),
    put: (url, data) => new Promise ((resolve, reject) => {
        store.commit('loader/show');
        axios.put(baseUrl+url, data, {
            headers: {
                Accept: 'application/ld+json',
                Authorization: 'bearer '+store.state.session.accessToken
            }
        }).then(response => {
            store.commit('loader/hide');
            resolve(response.data);
        }).catch(error => {
            store.commit('loader/hide');
            reject(error);
        });
    })
};

export default client;
