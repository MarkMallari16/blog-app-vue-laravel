<script setup>
import InputError from "@/Components/InputError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  title: "",
  content: "",
  category: "",
  image: null,
});

const submit = () => {
  form.post(route("blog.store"));
};

const imageUrl = computed(() => {
  return URL.createObjectURL(form.image);
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Add new blog article" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add new blog</h2>
    </template>

    <div class="mt-5 mx-5 lg:mx-48 mb-5 bg-white p-8 rounded-lg">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input
            v-model="form.title"
            type="text"
            id="title"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm"
          />
          <InputError :message="form.errors.title" class="mt-2" />
        </div>

        <div class="mb-4">
          <label for="content" class="block text-sm font-medium text-gray-700"
            >Content</label
          >
          <textarea
            v-model="form.content"
            id="content"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm"
          ></textarea>
          <InputError :message="form.errors.content" class="mt-2" />
        </div>
        <div class="mt-4">
          <label for="category" class="block text-sm font-medium text-gray-700"
            >Select category</label
          >
          <select
            id="category"
            v-model="form.category"
            class="mt-1 rounded-lg border-gray-400 focus:border-orange-500 focus:outline-orange-500"
          >
            <option value="">Select category</option>
            <option value="Technology">Technology</option>
            <option value="Health ">Health</option>
            <option value="Education">Education</option>
            <option value="Lifestyle">Lifestyle</option>
          </select>
          <InputError :message="form.errors.category" class="mt-2" />
        </div>
        <div class="mt-4">
          <div v-if="!form.image">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="size-28 bg-gray-200 p-4 rounded-lg"
            >
              <path
                fill-rule="evenodd"
                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                clip-rule="evenodd"
              />
            </svg>
          </div>
          <div v-else>
            <img :src="imageUrl" alt="image" class="w-52 rounded-lg">
          </div>
        </div>
        <div class="mt-4">
          <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
          <input
            id="image"
            ref="imageInput"
            type="file"
            @change="form.image = $refs.imageInput.files[0]"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm"
          />
          <InputError :message="form.errors.image" class="mt-2" />
        </div>

        <button
          type="submit"
          class="mt-6 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
          :disabled="form.processing"
        >
          Create Blog
        </button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
