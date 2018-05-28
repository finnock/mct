
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// import SortingFunctions from './helperFunctions'

// const firstBy = require('thenby');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store'

window.store = store

window.Vue = require('vue');

import cardList from './components/CardList.vue'
import cardListRemote from './components/CardListRemote.vue'
import JSONFormatter from 'json-formatter-js'

window.JSONFormatter = JSONFormatter

const app = new Vue({
    el: '#app',
    store,
    components: {
        cardList,
        cardListRemote,
    }
});