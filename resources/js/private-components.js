
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
    'brands-component-item',
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
    'edit-seller',
    require('./components/EditSeller.vue').default
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

Vue.component(
    'notifications',
    require('./components/header/Notifications.vue').default
);

Vue.component(
    'create-collection',
    require('./components/CreateCollection.vue').default
);

Vue.component('commission-component',require('./components/CommissionComponent.vue').default);
Vue.component('rating-modal',require('./components/RatingModal.vue').default);
Vue.component('btn-rating-modal',require('./components/BtnRatingModal.vue').default);
Vue.component('return-photos',require('./components/ReturnPhotos.vue').default);
Vue.component('modal-gallery',require('./components/ModalGallery.vue').default);
Vue.component('open-gallery-btn',require('./components/OpenGalleryBtn.vue').default);
Vue.component('payment-component',require('./components/PaymentComponent.vue').default);
Vue.component('transfer-btn',require('./components/TransferBtn.vue').default);
Vue.component('page-component',require('./components/reports/Page.vue').default);
Vue.component('general-component',require('./components/reports/General.vue').default);
Vue.component('sellers-component',require('./components/reports/Sellers.vue').default);
Vue.component('buys-component',require('./components/reports/Buys.vue').default);
Vue.component('departments-component',require('./components/reports/Departments.vue').default);
Vue.component('returns-component',require('./components/reports/Returns.vue').default);
Vue.component('sells-component',require('./components/reports/Sells.vue').default);
Vue.component('bank-component',require('./components/reports/Bank.vue').default);
Vue.component('shipping-component',require('./components/reports/Shipping.vue').default);
Vue.component('brands-component',require('./components/Brands.vue').default);
Vue.component('users-list-component',require('./components/UsersListComponent.vue').default);


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
