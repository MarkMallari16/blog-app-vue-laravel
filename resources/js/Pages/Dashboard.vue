<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

defineProps({
  posts: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  title: "",
  content: "",
  image: null,
});

const submit = () => {
  form.post(route("post.store"));
  form.reset();
};
const deletePost = (postId) => {
  if (confirm("Are you sure you want to delete this post?")) {
    form.delete(route("post.delete", postId))
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>
    <div class="py-12 mx-5">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>
      </div>
    </div>

    <div class="mt-5 mx-5 lg:mx-48 mb-5">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input
            v-model="form.title"
            type="text"
            id="title"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <div class="mt-2 text-red-500" v-if="form.errors.title">
            {{ form.errors.title }}
          </div>
        </div>

        <div class="mb-4">
          <label for="content" class="block text-sm font-medium text-gray-700"
            >Content</label
          >
          <textarea
            v-model="form.content"
            id="content"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          ></textarea>
          <div class="mt-2 text-red-500" v-if="form.errors.title">
            {{ form.errors.content }}
          </div>
        </div>
        <div>
          <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
          <input
            ref="imageInput"
            type="file"
            id="image"
            @input="form.image = $refs.imageInput.files[0]"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          />
          <div class="mt-2 text-red-500" v-if="form.errors.image">
            {{ form.errors.image }}
          </div>
        </div>
        <button
          type="submit"
          class="mt-8 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          :disabled="form.processing"
        >
          Create Post
        </button>
      </form>
    </div>
    <div class="mx-5 lg:mx-48" v-if="posts && posts.length > 0">
      <div v-for="post in posts" :key="post.id" class="bg-white mb-4 p-5 rounded-lg">
        <div class="flex justify-between items-center">
          <h3 class="text-xl font-medium">{{ post.user.name }}</h3>
          <button @click="deletePost(post.id)" class="bg-red-500 text-white p-2 rounded-lg">Delete</button>
        </div>
        <h1 class="text-4xl mt-4 font-bold">{{ post.title }}</h1>
        <img
          class="mt-4 rounded-lg w-96"
          :src="`/storage/${post.image}`"
          :alt="post.title"
        />
      </div>
    </div>
    <div v-else class="text-center">
      <p>No posts available.</p>
    </div>
  </AuthenticatedLayout>
</template>
