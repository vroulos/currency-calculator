
import '../css/app.css';
import Vue from 'vue';
import App from './App.vue';

new Vue({
    el: "#app",
    components: {App},
    data:{
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