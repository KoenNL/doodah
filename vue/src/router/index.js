import Vue from 'vue'
import Router from 'vue-router'
import Predictor from '../components/Predictor.vue';

Vue.use(Router);

const router = new Router({
  routes: [
      {
            path: '/',
            name: 'predictor',
            component: Predictor,
            meta: {
                title: 'Predictor'
            }
        }
  ]
});

router.beforeEach((to, from, next) => {
  next();
});

router.beforeEach((to, from, next) => {
    document.title = 'Doodah';
    if (to.meta.title) {
        document.title += ' | ' + to.meta.title;
    }
    next();
});

export default router