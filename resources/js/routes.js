import {isAuthRequired} from "./helpers";
import Home from "./components/Home";

export const routes = [
    {
        path:"/",
        name:"home",
        meta: isAuthRequired(false),
        component: Home
    },
    {
        path:"/messages",
        name:"messages",
        meta : isAuthRequired(true),
    }
];
