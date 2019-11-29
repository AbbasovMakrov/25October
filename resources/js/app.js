

require('./bootstrap');
import Echo from "laravel-echo";
window.io = require('socket.io-client');

export const echo = new Echo({
    broadcaster: 'socket.io',
    host: "http://192.168.1.108" + ':6001',
    auth: {
        headers: {
            Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTFkZTg2YmE5MTJkZTQ4MGEwYmVhMGQ3YjNlYTMxMzVlMzQwNWMwMDY0ZTdmNjljMTA3MjEwNzc0YTIyMDJjMGFhM2I3NDlmMzg0NzkyYTYiLCJpYXQiOjE1NzM4NDMyMzMsIm5iZiI6MTU3Mzg0MzIzMywiZXhwIjoxNjA1NDY1NjMzLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.I5OqRyuVy0tfvhdNwALaiXZQAbpHmO7Gum_RfzdKPsURAsbrmSds6Th6nF7fkN_rpRxjJhl-4eJg2c2XIBlanuxcvN__R6m1aNhzIOPFdwhYdZdrRgWD-OC8tkGDkLROXlADyuk3E5Nurbrq0dLocaBqscI5youxckscJtL8PDRCACUDthyRuw8vqDq4sciVfwbiTQnY8D_efs8-l-xyULgpxoYcvJ8wXKui14ee_EtR6Lpmu8iSPyMg8QY5eo3SrrU42xrxgHSXo3IDrfQ5RqlvHJPriLqvx08PZ8oN-_R84IIiUdwb8RtklkEHnh0AOeio03x3i4d4CTCXkB3uGU4nZQaTyvieVg_hG8SHk9qw-XPKEcgKdKNap6CoQFLtAeX8Ze5R1XVIqKN4g7BbU2PWwx2PEwmfjj0tL0RuOsryi1UwSjixmhmsI9jWjXQvXW3pf83rShuq655hhyFs6x5gU-TkRM_29iK_Xo0A0pPzNeMH9E0yu3FRwP_hNIKJkkQzyRdSJoo8VN319PyXNJnSQRbQjVsmGbbVCARohoEktSVZ5hlE2qpyuDrBczOkvkwlTlEBjFXNqpAhHTQcTwdx_wGCatWjwAp82FabNYskvM40Tgmy7Fmbg8NQuomYEOJpLJn1CgVwBV2rEuBK0OREYLErDjAXz2ogiKdiWU4"
        }
    }
});
echo.connect();
echo.listen("private-messages-channel","newMessage",e => console.log(e));
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
// const app = new Vue({
//     el: '#app',
//     store,
//     router,
//     components : {
//         App
//     }
// });

