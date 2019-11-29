

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import storeData from "./store";
import {routes} from "./routes";
import App from "./components/App";
Vue.use(VueRouter);
Vue.use(Vuex);
const store = new Vuex.Store(storeData);
const router = new VueRouter({
    routes,
    mode: 'history'
});
router.beforeEach(( (to, from, next) => {
    if (to.matched.some(record => record.meta.AuthRequired)){
        if (!store.state.isAuth)
            return next("/login");
        else
            return next();
    }
}));
const app = new Vue({
    el: '#app',
    store,
    router,
    components : {
        App
    }
});

