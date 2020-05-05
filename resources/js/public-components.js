
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

(function() {

    Vue.component('heart-wishlist-component',require('./components/HeartWishlistComponent.vue'));
    Vue.component('item-to-shopping-cart',require('./components/ItemToShoppingCartComponent.vue'));
    
    // Search
    Vue.component('header-component', require('./components/header/Header.vue'));
    Vue.component('notifications',require('./components/header/Notifications.vue'));
    Vue.component('search-filter',require('./components/search/Filters.vue'));
    
    // Search
    Vue.component('search-page', require('./components/search/SearchPage.vue'));
    Vue.component('search-input', require('./components/search/SearchInput.vue'));
    Vue.component('hits', require('./components/search/Hits.vue'));
    Vue.component('refinament', require('./components/search/Refinament.vue'));
    Vue.component('question',require('./components/question/Question.vue'));
    
    Vue.component('question-parent',require('./components/question/QuestionParent.vue'));
    Vue.component('question-son',require('./components/question/QuestionSon.vue'));

})();


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
