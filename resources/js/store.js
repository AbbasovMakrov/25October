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
    },
    getters:{}
}
