import axios from 'axios';
import router from "./router/router.js";
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

window.axios.interceptors.response.use({},err=>{
    if(err.response.status === 401 || err.response.status === 419){
        const token = localStorage.getItem('x_xsrf_token')
        if (token){
            localStorage.removeItem('x_xsrf_token')
        }

        router.push({name:'login'})
    }
})
