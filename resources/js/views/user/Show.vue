<template>
    <div class="w-96 mx-auto">
        <div v-if="posts">
            <h1 class="mb-4 pb-4 border-b border-gray-400">Posts</h1>
            <Post v-for="post in posts" :post="post" />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Post from "../../components/Post.vue";

export default {
    name: "Personal",
    components: {Post},
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts() {
            axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data.data
                })
        },

    }
}
</script>
