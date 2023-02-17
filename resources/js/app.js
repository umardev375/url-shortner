require('./bootstrap');

import Vue from 'vue'; // if this is not work add this =>  window.Vue = require('vue');
import VeeValidate from "vee-validate";
import axios from 'axios';
import VueAxios from 'vue-axios';
import Swal from 'sweetalert2';

const api_token = document.querySelector('meta[name="api_token"]').content;
axios.defaults.params = {}
axios.defaults.params['api_token'] = `${api_token}`;

Vue.use(VeeValidate);
Vue.use(VueAxios, axios);
Vue.config.productionTip = false

Vue.component('url-component', require('./components/UrlComponent.vue').default);

//toaster
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Swal = Swal;
window.Toast = Toast;


const app = new Vue({
    el: '#app',
});
