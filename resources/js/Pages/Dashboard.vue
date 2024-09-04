<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
  posts: {
    type: Array,
    required: true,
  },
  authUserId: {
    type: Number,
    required: true,
  },
});
const form = useForm({
  title: "",
  content: "",
  image: null,
});
const deletePost = (postId) => {
  if (confirm("Are you sure you want to delete this post?")) {
    form.delete(route("post.delete", postId));
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="mt-10 mx-5 lg:mx-48" v-if="posts && posts.length > 0">
      <div v-for="post in posts" :key="post.id" class="bg-white mb-4 p-5 rounded-lg">
        <div class="flex justify-between items-center">
          <h3 class="text-xl font-medium">{{ post.user.name }}</h3>
          <button
            v-if="post.user_id === authUserId"
            @click="deletePost(post.id)"
            class="bg-red-500 text-white p-2 rounded-lg"
          >
            Delete
          </button>
        </div>
        <h1 class="text-4xl mt-4 font-bold">{{ post.title }}</h1>
        <img
          class="mt-4 rounded-lg w-96"
          :src="`/storage/${post.image}`"
          :alt="post.title"
        />
      </div>
    </div>
    <div v-else class="mt-10 text-center">
      <p>No posts available.</p>
    </div>
  </AuthenticatedLayout>
</template>
