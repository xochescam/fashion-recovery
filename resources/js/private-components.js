
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

if(window.Mercadopago) {
    window.Mercadopago.setPublishableKey("TEST-9f8e2eef-693d-4cb0-895e-ce1abd37cfbd");
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

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

Vue.component(
    'card-payment',
    require('./components/CardPayment.vue').default
);

Vue.component(
    'select-component',
    require('./components/SelectComponent.vue').default
);
Vue.component(
    'question',
    require('./components/question/Question.vue').default
);

Vue.component(
    'question-page',
    require('./components/question/QuestionPage.vue').default
);

Vue.component(
    'question-parent',
    require('./components/question/QuestionParent.vue').default
);

Vue.component(
    'question-son',
    require('./components/question/QuestionSon.vue').default
);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#dashboard',
    data: {
        path: document.body.getAttribute('data-root') || '',
    },

});
