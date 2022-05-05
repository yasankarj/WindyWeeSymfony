import Vue from 'vue';
import Product from './pages/product';

new Vue({
    el: '#app',
    render: (h) => h(Product),
}).$mount('#app');
