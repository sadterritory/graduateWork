<template>
    <div class="w-96 mx-auto">

        <div>
            <input v-model="name" type="name" placeholder="name"
                   class="w-96 p-1 mb-2 border-inherit rounded-lg"></div>
        <div>
            <input v-model="email" type="email" placeholder="email"
                   class="w-96 p-1 mb-2 border-inherit rounded-lg">
        </div>
        <div>
            <input v-model="password" type="password" placeholder="password"
                    class="w-96 p-1 mb-2 border-inherit rounded-lg"></div>
        <div>
            <input v-model="password_confirmation" type="password" placeholder="password_confirmation"
                    class="w-96 p-1 mb-2 border-inherit rounded-lg"></div>

        <input @click="register" type="submit" value="register"
               class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg">
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router/router.js";

export default {
    name: "user.registration",

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        }
    },
    methods: {
        async register() {
            await axios.get('/sanctum/csrf-cookie', {
                withCredentials: true,
                headers: {'Accept': 'application/json'},
            }).then(response => {
                axios.post('/register', {
                    email: this.email,
                    name: this.name,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }, {withCredentials: true})
                    .then(response => {
                        localStorage.setItem('x_xsrf_token', document.cookie)
                        router.push({name: 'user.index'})
                    })
            })
        }
    }
}

</script>

<style scoped>

</style>
