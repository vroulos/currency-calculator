/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';


import Vue from 'vue'
import App from './js/App.vue'

new Vue({
    el: "#app",
    components: {App},
    data:{
        message: 'trela edo pera',
        form: {
            value:null,
            from:null,
            to:null
        }
    }, 

    mounted(){
        alert("aera");
    }
});

console.log('Hello Webpack Encore! Edit me in assets/app.js');
