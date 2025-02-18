<template>
    <div class="w-96 mx-auto">
        <div v-if="users">
            <div class="flex mb-8 pd-8 border-b border-gray-400" v-for="user in users">
                <router-link :to="{name: 'user.show',params:{id: user.id}}">
                    <div class="mr-3 pt-1 text-small">
                        {{ user.id }}
                    </div>
                    <div>
                        <div class="text-xl">
                            {{ user.name }}
                        </div>
                        <div class="text-sm text-small">
                            {{ user.email }}
                        </div>
                    </div>
                </router-link>
                <div>
                    <a @click="toggleFollowing()" class="block float-right mx-auto w-32 p-1 bg-sky-400 text-white rounded-lg" href="#">Follow</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Index",
    data() {
        return {
            users: []
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            axios.get('/api/users/')
                .then(res => {
                    console.log(res.data.data)
                    this.users = res.data.data
                })
        },
        toggleFollowing(){
            axios.get(`/api/users/${this.user.id}/toggle_following`)
                .then(res => {
                    console.log(res)
                    this.posts = res.data.data
                })
        }
    }
}
</script>

<style scoped>

</style>
