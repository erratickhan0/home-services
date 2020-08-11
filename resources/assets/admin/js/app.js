/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


window.Vue = require('vue');
window.moment = require('moment');

//require('adminlte-vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import axios from 'axios';
import router from './routes';
import Vuex from 'vuex';
import VueAuthenticate from 'vue-authenticate';
import VeeValidate from 'vee-validate'
import VueAxios from 'vue-axios';





let veeCustomMessage = {
    en: {
        custom: {
            agree: {
                required: 'You must agree to the terms and conditions before registering!',
                digits: (field, params) => `length must be ${params[0]}`
            },
            privacypolicy: {
                required: 'You must agree the privacy policy before registering!',
                digits: (field, params) => `length must be ${params[0]}`
            },
            password_confirmation: {
                confirmed: 'Password does not match.'
            }
        }
    }
};

const config = {
    errorBagName: 'errorBag', // change if property conflicts.
    dictionary: veeCustomMessage,
    events: 'input'
};

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(Vuex);
Vue.use(VueAxios, axios);
// Vue.component('multiselect', Multiselect);
// Vue.component('MaterialIcons', MaterialIcons);

// require('./filters');

const options = {
    color: '#792c35',
    failedColor: '#792c35',
    thickness: '3px',
    transition: {
        speed: '2s',
        opacity: '0.6s',
        termination: 600
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};

// Require components tags
require('./components-tags');
// require('./directives');
Vue.mixin({
    data: function () {
        return {
            globalReadOnlyProperty() {
                return $route.name;
            }
        }
    }
});
// Create and mount the root instance.
Vue.use(VueAuthenticate, {
    tokenName: 'access_token',
    baseUrl: '/',
    loginUrl: '/login',
    registerUrl: 'auth/register',
    logoutUrl: '/logout',
    storageType: 'cookieStorage',
    providers: {
        // Define OAuth providers config
        oauth2: {
            name: 'oauth2',
            url: 'Token/Exchange',
        }
    }, bindRequestInterceptor: function () {

        this.$http.interceptors.request.use((config) => {
            if (this.isAuthenticated()) {
                config.headers['Authorization'] = 'Bearer ' + this.getToken();
            }
            return config
        })
    }
});
Vue.use(VeeValidate, config);
const app = new Vue({
    el: '#app',
    router: router,
    methods: {
        //if scroll exist add class else remove class
        checkscroll() {
            setTimeout(function () {
                if (jQuery('body').height() > jQuery(window).height()) {
                    jQuery('body').addClass('handle-scroll');
                } else {
                    jQuery('body').removeClass('handle-scroll');
                }
            }, 1500);
        },
        //add differnt classes acording to browser
        browserfunction() {
            if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
                jQuery('body').addClass('opera-browser')
            } else if (navigator.userAgent.indexOf("Chrome") != -1) {
                jQuery('body').addClass('chrome-browser')
            } else if (navigator.userAgent.indexOf("Safari") != -1) {
                jQuery('body').addClass('safari-browser')
            } else if (navigator.userAgent.indexOf("Firefox") != -1) {
                jQuery('body').addClass('firefox-browser')
            } else if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) //IF IE > 10
            {
                jQuery('body').addClass('IE-browser')
            } else {
                jQuery('body').addClass('New-browser')
            }
        }
    },
    mounted() {
        console.log('mounted called');
        //this.$Progress.finish();
        // this.checkscroll();
        // this.browserfunction();
        /*this.checkscroll();*/
        this.browserfunction();
    },
    created() {
        // this.$Progress.start()
        this.$router.beforeEach((to, from, next) => {
            console.log('before each');
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress
                //this.$Progress.parseMeta(meta)
            }
            // this.$Progress.start()
            next()
        })
        this.$router.afterEach((to, from) => {
            // this.$Progress.finish()
            console.log('after each');
        })
    },
    watch: {
        '$route': function (from, to) {
            this.checkscroll();
        }
    }
});

Vue.axios.interceptors.response.use((response) => { // intercept the global error
    return response
}, function (error) {
    let originalRequest = error.config
    if (error.response.status === 401 && !originalRequest._retry) { // if the error is 401 and hasent already been retried
        app.$auth.logout().then(function (Vue) {
            app.$store.commit('setAuthAdminUser', '')
            router.push({name: 'login'})
        })
    }
    if (error.response.status === 406 || error.response.status === 422) {
        return Promise.reject(error);
    }
});

/*const app = new Vue({
    router
}).$mount('#app')*/

// sections animation

$('[section-target]').on('click', function(){
    var getTargetValue = $(this).attr('section-target');
    var parentSection = $(this).parents('.section');
    parentSection.addClass('fadeOut');
    $(parentSection).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
        //alert(getTargetValue);
        parentSection.removeClass('show fadeOut');
        $(getTargetValue).addClass('show fadeIn');
    });
});
