/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vue from 'vue'
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)


Vue.component('sidebar', require('./components/Sidebar.vue').default);
Vue.component('mobile-menu', require('./components/MobileMenu.vue').default);
Vue.component('catalog-component', require('./components/CatalogComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('table-size-component', require('./components/TableSizeComponent.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);


Vue.component('admin-product-component', require('./components/admin/ProductComponent.vue').default);
Vue.component('admin-orders-component', require('./components/admin/OrdersComponent.vue').default);
Vue.component('admin-collection-component', require('./components/admin/CollectionComponent.vue').default);
Vue.component('admin-add-product-component', require('./components/admin/AddProductComponent.vue').default);
Vue.component('admin-add-collection-component', require('./components/admin/AddCollectionComponent.vue').default);


Vue.directive('click-outside', {
    bind(el, binding) {
        el.addEventListener('click', e => e.stopPropagation());
        document.body.addEventListener('click', binding.value);
    },
    unbind(el, binding) {
        document.body.removeEventListener('click', binding.value);
    }
});

var goTopBtn = document.querySelector('.back_to_top');

if (goTopBtn){
    window.addEventListener('scroll', trackScroll);
    goTopBtn.addEventListener('click', backToTop);

}

function trackScroll() {
    var scrolled = window.pageYOffset;
    var coords = document.documentElement.clientHeight / 5;

    if (scrolled > coords) {
        goTopBtn.classList.add('back_to_top-show');
    }
    if (scrolled < coords) {
        goTopBtn.classList.remove('back_to_top-show');
    }
}

function backToTop() {
    if (window.pageYOffset > 0) {
        window.scrollBy(0, -80);
        setTimeout(backToTop, 0);
    }
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
