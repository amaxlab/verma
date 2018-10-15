import 'bootstrap/dist/css/bootstrap.min.css';

import Vue from 'vue'
import App from './App'
import router from './router'
import Axios from 'axios'
import store from './store'

Vue.prototype.$http = Axios;

Vue.config.productionTip = false;

new Vue({
  el: '#app',
  store,
  router,
  components: { App },
  template: '<App/>'
});
