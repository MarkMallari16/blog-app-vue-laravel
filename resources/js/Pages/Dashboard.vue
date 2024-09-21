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
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-4xl font-medium">Latest Blogs</h1>
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search blogs..."
          class="w-1/2"
        />
      </div>
      <div v-if="filterBlogs && filterBlogs.length > 0">
        <div>
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 w-full bg-white">
            <div
              v-for="blog in filterBlogs"
              :key="blog.id"
              class="mb-4 px-5 py-6 rounded-xl shadow-sm w-full"
            >
              <BlogCard :blog="blog" :authUserId="authUserId" />
            </div>
          </div>
        </div>
      </div>
      <div v-else class="mt-10 text-center bg-white mx-48 p-5 rounded-lg">
        <p>No blogs available today.</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
