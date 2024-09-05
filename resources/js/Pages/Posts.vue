<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
  title: "",
  content: "",
  image: null,
});

const submit = () => {
  form.post(route("post.store"));
};

</script>

<template>
  <AuthenticatedLayout>
    <Head title="Add new post" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add new post</h2>
    </template>

    <div class="mt-5 mx-5 lg:mx-48 mb-5 bg-white p-8 rounded-lg">
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
  </AuthenticatedLayout>
</template>
