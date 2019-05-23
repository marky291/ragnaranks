/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import * as axios from "axios";

window.Vue = require('vue');

window.Event = new Vue();

// Carousel Element.
import Vue from 'vue';
import AtComponents from 'at-ui'
// import 'at-ui-style'    // Import CSS

Vue.use(AtComponents);
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

Vue.component('filtered-search', require('./components/FilteredListingSearch.vue').default);
Vue.component('filtered-listings', require('./components/FilteredListingContainer.vue').default);
Vue.component('listing-profile', require('./Pages/ListingProfileComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent').default);
Vue.component('register-component', require('./components/RegisterComponent').default);
Vue.component('forgot-password-component', require('./components/ForgotPasswordComponent').default);
Vue.component('reset-password-component', require('./components/ResetPasswordComponent').default);
Vue.component('verify-account-component', require('./components/VerifyAccountComponent').default);
Vue.component('account-component', require('./components/AccountComponent').default);
Vue.component('account-details-component', require('./components/AccountDetailsComponent').default);
Vue.component('account-notification-component', require('./components/AccountNotificationComponent').default);
Vue.component('listing-profile', require('./components/ListingProfile').default);
Vue.component('listing-configurator', require('./components/ListingConfigurator').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    methods: {
        navigate: function(name) {
            if (name === 'logout') {
                axios.post('/logout').then((response) => {
                    window.location = '/';
                });
            } else {
                window.location = '/' + name;
            }
        }
    }
});
