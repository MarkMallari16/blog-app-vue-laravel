<script setup>
import BlogCard from "@/Components/BlogCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";

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
const searchQuery = ref(usePage().props.search || "");

const filterBlogs = computed(() => {
  if (!searchQuery.value) {
    return props.blogs;
  }
  return props.blogs.filter(
    (blog) =>
      blog.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      blog.content.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>

    <div class="mt-10 mx-5 lg:mx-32">
     
      <div class="flex justify-between mb-4">
   
        <h1 class="text-4xl font-medium">Latest Blogs</h1>
        <div class="flex justify-end relative w-1/2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="inset-2 size-6 absolute z-10"
          >
            <path
              fill-rule="evenodd"
              d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
              clip-rule="evenodd"
            />
          </svg>
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search blogs..."
            class="absolute w-full rounded-lg pl-10"
          />
        </div>
      </div>
      <div v-if="filterBlogs && filterBlogs.length > 0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 w-full">
          <div
            v-for="blog in filterBlogs"
            :key="blog.id"
            class="mb-4 px-5 py-6 rounded-xl shadow-sm w-full"
          >
            <BlogCard :blog="blog" :authUserId="authUserId" />
          </div>
        </div>
      </div>
      <div v-else class="mt-10 text-center bg-white mx-48 p-5 rounded-lg ">
        <p>No blogs found.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
