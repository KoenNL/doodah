import Vue from 'vue'
import App from './App'
import router from './router'
import VueSession from 'vue-session'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

Vue.use(VueSession, {persist: true});

new Vue({
    el: '#app',
    router,
    components: {
        'app': App
    },
    template: '<App/>'
});