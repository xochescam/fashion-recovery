
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
import InstantSearch from 'vue-instantsearch';
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
Vue.use(InstantSearch);





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'example-component',
    require('./components/ExampleComponent.vue').default
);

Vue.component(
    'select-component',
    require('./components/SelectComponent.vue').default
);

Vue.component(
    'brands-component',
    require('./components/BrandsComponent.vue').default
);

Vue.component(
    'guardarropa-component',
    require('./components/GuardarropaStatusComponent.vue').default
);

Vue.component(
    'heart-wishlist-component',
    require('./components/HeartWishlistComponent.vue').default
);

Vue.component(
    'item-to-shopping-cart',
    require('./components/ItemToShoppingCartComponent.vue').default
);



Vue.component(
    'item-list-component',
    require('./components/ItemListComponent.vue').default
);

Vue.component(
    'shopping-steps-component',
    require('./components/ShoppingStepsComponent.vue').default
);

Vue.component(
    'confirm-buy',
    require('./components/ConfirmBuy.vue').default
);

Vue.component(
    'cancel-order',
    require('./components/CancelOrderComponent.vue').default
);

Vue.component(
    'create-seller',
    require('./components/CreateSeller.vue').default
);

Vue.component(
    'address-form',
    require('./components/AddressForm.vue').default
);

// Search
Vue.component('header-component', require('./components/header/Header.vue').default);

Vue.component(
    'search-filter',
    require('./components/search/Filters.vue').default
);


// Search
Vue.component('search-page', require('./components/search/SearchPage.vue').default);
Vue.component('search-input', require('./components/search/SearchInput.vue').default);
Vue.component('hits', require('./components/search/Hits.vue').default);
Vue.component('refinament', require('./components/search/Refinament.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    data: {
        path: document.body.getAttribute('data-root') || '',
    },

});
