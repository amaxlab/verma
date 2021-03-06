import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.css'
import "font-awesome/css/font-awesome.min.css";

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import App from './App'
import router from './router'
import Axios from 'axios'
import store from './store'

Vue.prototype.$http = Axios;
Vue.config.productionTip = false;
Vue.use(BootstrapVue);
store.dispatch('session/refreshToken');

new Vue({
  el: '#app',
  store,
  router,
  components: { App },
  template: '<App/>'
});
