import {createApp} from 'vue'
import router from "./router/router.js";
import App from './App.vue'
import './bootstrap'
const app =createApp(App)
app.use(router)
app.mount("#app")
