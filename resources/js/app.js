/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import '@github/include-fragment-element'

import AtComponents from 'at-ui'
Vue.use(AtComponents);

import SimpleVueValidation from 'simple-vue-validator';
import VueInternationalization from 'vue-i18n';
import Locale from './messages';

// use the components
Vue.use(SimpleVueValidation);
Vue.use(VueInternationalization);

// the validation is passive at first, just the same as manual mode.
// But once the $validate() method is called, it becomes active
// and acts exactly like interactive mode.
// SimpleVueValidation.setMode('conservative');

//const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: 'en',
    messages: Locale
});


// =-=-=-=-=-=-=-=-=-=-=-=

Vue.mixin({
    methods: {
        redirect: url => window.location.assign(url)
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/FlashComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('filtered-listings', require('./components/FilteredListingContainer').default);
Vue.component('filtered-search', require('./components/FilteredListingSearch.vue').default);

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('profile-page', require('./components/profile/ProfilePage.vue').default);
Vue.component('profile', require('./components/profile/Profile').default);
Vue.component('configs', require('./components/profile/ProfileConfigs').default);
Vue.component('homepage', require('./components/homepage/Homepage').default);

Vue.component('review', require('./components/listing/Review').default);
Vue.component('create-review', require('./components/listing/CreateReview').default);
Vue.component('voting', require('./components/listing/VoteComponent.vue').default);
Vue.component('profileFrame', require('./components/listing/Profile').default);

// Vue.component('filtered-listings', require('./components/FilteredListingContainer.vue').default);
//Vue.component('listing-profile-old', require('./Pages/ListingProfileComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent').default);
Vue.component('register-component', require('./components/RegisterComponent').default);
Vue.component('forgot-password-component', require('./components/ForgotPasswordComponent').default);
Vue.component('reset-password-component', require('./components/ResetPasswordComponent').default);
Vue.component('verify-account-component', require('./components/VerifyAccountComponent').default);
Vue.component('account-component', require('./components/AccountComponent').default);
Vue.component('account-details-component', require('./components/AccountDetailsComponent').default);
Vue.component('account-notification-component', require('./components/AccountNotificationComponent').default);
Vue.component('report-tool-component', require('./components/ReportToolComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    i18n,
});
