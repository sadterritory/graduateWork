<template>
    <div class="w-96 mx-auto">
        <div class="mb-4">
            <div>
                <input v-model="title" class="w-96 p-2 mb-3 border-1 rounded-3xl border-slate-300" type="text"
                       placeholder="title">
            </div>
            <div>
                <textarea v-model="content" class="w-96 p-2 mb-3 border-1 rounded-3xl border-slate-300"
                          placeholder="content"></textarea>
            </div>
            <div class="flex mb-3">
                <div>
                    <input @change="storeImage" type="file" class="hidden" ref="file">
                    <a href="#" class="text-center block mb-5 w-32 p-2 bg-sky-400 text-white rounded-lg"
                       @click.prevent="selectFile">Image</a>
                </div>

            </div>
            <div class="mb-3" v-if="image">
                <img :src="image.url" alt="">
                <div>
                    <a href="#" class="text-center block ml-auto mt-2 mb-5 w-32 p-2 bg-sky-400 text-white rounded-lg"
                       @click.prevent="image = null">Cancel</a>
                </div>
            </div>
            <div>
                <a @click.prevent="store"
                   class="mb-5 d-block p-2 w-32 rounded-2xl text-white hover:text-white hover:bg-green-700 bg-sky-400 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500"
                   href="#">Publish</a>
            </div>
        </div>
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
    data() {
        return {
            title: '',
            content: '',
            image: null,
            posts: [],
        }
    },
    components:{
        Post,
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
        store() {
            const id = this.image ? this.image.id : null;
            axios.post('/api/posts', {title: this.title, content: this.content, image_id: id}, {
                withCredentials: true, // Передача куков с авторизацией
            })
                .then(res => {
                    this.title = ''
                    this.content = ''
                    this.image = null
                    this.posts.unshift(res.data.data)
                })
                .catch(error => {
                    console.error("Ошибка сохранения поста:", error.response?.data || error);
                    alert("Ошибка сохранения поста. Проверьте авторизацию!");
                });
        },
        selectFile() {
            this.$refs.file.click();
        },
        storeImage(e) {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            axios.post('/api/post_images', formData)
                .then(res => {
                    this.image = res.data.data
                })
                .catch(err => {
                    console.error('Upload error:', err);
                });
        }
    }
}
</script>
