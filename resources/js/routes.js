import {isAuthRequired} from "./helpers";
import Home from "./components/Home";
import Login from "./components/Login";
export const routes = [
    {
        path:"/",
        name:"home",
        meta: isAuthRequired(false),
        component: Home
    },
    {
        path:"/login",
        name:"login",
        meta: isAuthRequired(false),
        component : Login
    }
];
