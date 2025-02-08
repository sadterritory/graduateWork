<template>
    <div class="w-96 mx-auto">
        <div>
            <input v-model="email" type="email" placeholder="email"
                   class="w-96 p-1 mb-2 border-inherit rounded-lg">
        </div>
        <div>
            <input v-model="password" type="password" placeholder="password"
                   class="w-96 p-1 mb-2 border-inherit rounded-lg"></div>
        <div>
            <input @click="login" type="submit" value="register"
                   class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg">
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router/router.js";

export default {
    name: "user.login",
    data() {
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        async login() {
            if (!this.email || !this.password) {
                alert("Email и пароль обязательны!");
                return;
            }

            await axios.get('/sanctum/csrf-cookie', { withCredentials: true })
                .then(() => {
                    return axios.post('/login', { email: this.email, password: this.password }, { withCredentials: true });
                })
                .then(response => {
                    localStorage.setItem('x_xsrf_token', document.cookie);
                    router.push({ name: 'user.personal' }); // Перенаправление в личный кабинет
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        console.error("Ошибка входа:", error.response.data.errors);
                        alert(error.response.data.message || "Ошибка входа. Проверьте данные.");
                    }
                });
        }

    }
}
</script>

<style scoped>

</style>
