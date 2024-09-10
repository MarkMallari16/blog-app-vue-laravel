<script setup>
import InputError from "@/Components/InputError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
  blog: {
    type: Object,
    required: true,
  },
  message: {
    type: String,
  },
});
const form = useForm({
  title: props.blog.title,
  content: props.blog.content,
  category: props.blog.category,
  image: props.blog.image
});

const submit = () => {
  form.post(route("blog.update", props.blog.id));
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Update blog" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update blog</h2>
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
            <option value="Health">Health</option>
            <option value="Education">Education</option>
            <option value="Lifestyle">Lifestyle</option>
          </select>
          <InputError :message="form.errors.category" class="mt-2" />
        </div>
        <div class="mt-4">
          <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
          <input
            id="image"
            ref="imageInput"
            type="file"
            @input="form.image = $refs.imageInput.files[0]"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm"
          />
          <InputError :message="form.errors.image" class="mt-2" />
        </div>
        <button
          type="submit"
          class="mt-6 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500"
          :disabled="form.processing"
        >
          Update Blog
        </button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
