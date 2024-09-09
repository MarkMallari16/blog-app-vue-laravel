<script setup>
import NavLink from "@/Components/NavLink.vue";
import { useDate } from "@/Composables/date";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
  blogs: {
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

const deleteBlog = (blogId) => {
  if (confirm("Are you sure you want to delete this blog?")) {
    form.delete(route("blog.delete", blogId));
  }
};
</script>
<template>
  <AuthenticatedLayout>
    <div class="mt-10 lg:mx-40">
      <h1 class="text-4xl mb-4 font-bold text-orange-500">Your Blogs</h1>
      <div v-for="blog in blogs" :key="blog.id" class="bg-white mb-4 rounded-lg p-2">
        <div class="flex justify-between flex-wrap gap-5 mt-10 p-5">
          <img :src="`/storage/${blog.image}`" alt="" class="w-60 rounded-xl" />
          <div>
            <p class="text-gray-500 mb-1">{{blog.category}}</p>
            <h1 class="text-start text-5xl font-bold">{{ blog.title }}</h1>
            <p class="mt-2 text-lg text-gray-800">{{blog.content.slice(0,40)}}</p>
            <p class="mt-2 ext-sm text-gray-500">{{ useDate(blog.created_at).formattedDate  }}</p>
          </div>
          <div class="flex items-start gap-2 ms-auto">
            <a :href="route('blog.update.view',blog.id)" class="bg-blue-500 px-4 py-2 rounded-lg">Edit</a>
            <button @click="deleteBlog(blog.id)" class="bg-red-500 px-4 py-2 rounded-lg">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
