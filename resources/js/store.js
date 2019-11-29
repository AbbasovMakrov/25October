const API_URL = "";
import axios from "axios";
import {getLocalUser} from "./helpers";
var user = getLocalUser();
export default {
    state:{
        user:user,
        isAuth:!!user,
        messages:[]
    },
    mutations:{
        set_messages(state , payload) {
            state.messages = payload;
        },
        set_user(state , payload){
            localStorage.setItem("user",payload);
            state.user = getLocalUser();
            state.isAuth = true;
        }
    },
    actions:{
        attemptLogin({state , commit} , payload){
            return new Promise((resolve, reject) => {
               axios.post('/dashboard/login',payload).then(response => {
                   if (response.data.errors)
                       reject(response.data.errors);
                   else {
                       commit("set_user",response.data.user);
                       resolve(response);
                   }
               }).catch(err => reject(err));
            });
        }
    },
    getters:{}
}
