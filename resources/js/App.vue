<template>
    <div class="flex justify-between p-8 w-96 mx-auto">
        <router-link v-if="!token" :to="{name:'user.login'}">Login</router-link>
        <router-link v-if="!token" :to="{name:'user.registration'}">Registration</router-link>
        <router-link v-if="token" :to="{name:'user.personal'}">Personal</router-link>
        <router-link v-if="token" :to="{name:'user.index'}">User</router-link>
        <a v-if="token" @click.prevent="logout" href="#">Logout</a>
    </div>
    <router-view :key="$route.fullPath"></router-view>
</template>

<script>
import axios from "axios";
import router from "./router/router.js";

export default {
    name: "app",
    data() {
        return {
            token: localStorage.getItem('x_xsrf_token') // загружаем токен при старте
        };
    },

    watch: {
        $route(to, from) {
            this.getToken(); // вызываем обновление токена при смене маршрута
        }
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token'); // обновляем реактивное значение
        },

        logout() {
            axios.post('/logout', {}, { withCredentials: true })
                .then(() => {
                    localStorage.removeItem('x_xsrf_token'); // удаляем токен из хранилища
                    this.token = null; // обновляем реактивную переменную
                    router.push({ name: 'user.login' }); // редиректим на логин
                });
        }
    }
}
</script>
