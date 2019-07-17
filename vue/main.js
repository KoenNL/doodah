import Vue from 'vue'
import App from './App'
import router from './router'
import VueSession from 'vue-session'

Vue.config.productionTip = false;
Vue.use(VueSession, {persist: true});

new Vue({
    el: '#app',
    router,
    components: {
        'app': App
    },
    template: '<App/>'

});