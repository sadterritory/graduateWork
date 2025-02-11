<template>
    <div class="w-96 mx-auto">
        <div v-if="users">
            <div class="flex mb-8 pd-8 border-b border-gray-400" v-for="user in users">
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
        }
    }
}
</script>

<style scoped>

</style>
