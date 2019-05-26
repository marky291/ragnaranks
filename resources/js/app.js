/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import * as axios from "axios";
import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles

AOS.init();

// You can also pass an optional settings object
// below listed default settings
AOS.init({
    // Global settings:
    disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 120, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 400, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});

window.Vue = require('vue');

window.Event = new Vue();

// Carousel Element.
import Vue from 'vue';
import AtComponents from 'at-ui'

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
Vue.component('listing-profile-old', require('./Pages/ListingProfileComponent.vue').default);
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
            } else if (name === '/') {
                window.location = '/'
            } else {
                window.location = '/' + name;
            }
        }
    }
});
