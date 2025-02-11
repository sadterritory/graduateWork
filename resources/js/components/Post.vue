<template>
        <div class="mb-8 pd-8 border-b border-gray-400">
            <h1 class="text-xl">{{ post.title }}</h1>
            <img class="mx-auto my-4" v-if="post.image_url" :src="post.image_url" :alt="post.title">
            <p>{{ post.content }}</p>
            <p class="text-right text-sm text-salte-500">{{ post.date }}</p>
        </div>
</template>

<script>
export default {
    name: "Post",
    props: [
        'post'
    ]
}
</script>

<style scoped>

</style>
