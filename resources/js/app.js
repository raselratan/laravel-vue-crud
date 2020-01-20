/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import moment from 'moment'
window.moment = moment;

Vue.filter('rdate', function(mdate) {
    return moment(mdate).format('MMM Do YYYY');
});

window.Fire = new Vue();

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

import DatePicker from 'vue2-datepicker'
window.DatePicker = DatePicker;

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px'
})

import "chart.js";
import "hchs-vue-charts";
Vue.use(window.VueCharts);

Vue.filter('postBody', function(text, len = 400) {
    return text.substr(0, len) + "...  ";
});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    { path: '/admin', component: require('./components/Test.vue').default },
    { path: '/admin/add-products', component: require('./components/dashboard/AddProducts.vue').default },
    { path: '/admin/list-products', component: require('./components/dashboard/ProductsList.vue').default },
];

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.component('login-component', require('./components/Login.vue').default);
Vue.component('admin', require('./components/Admin.vue').default);


const app = new Vue({
    el: '#app',
    router,
});