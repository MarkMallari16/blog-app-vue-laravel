<script setup>
import BlogCard from "@/Components/BlogCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  blogs: {
    type: Array,
    required: true,
  },
  authUserId: {
    type: Number,
    required: true,
  },
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="" v-if="blogs && blogs.length > 0">
      <div class="mt-10 mx-5 lg:mx-32">
        <h1 class="text-4xl font-medium mb-4">Latest Blogs</h1>
        <div class="flex flex-wrap lg:flex-nowrap gap-5 w-full bg-whit">
          <div
            v-for="blog in blogs"
            :key="blog.id"
            class="mb-4  px-5 py-6 rounded-xl shadow-sm  w-full"
          >
            <BlogCard :blog="blog" :authUserId="authUserId" />
          </div>
        </div>
      </div>
    </div>
    <div v-else class="mt-10 text-center bg-white mx-48 p-5 rounded-lg">
      <p>No blogs available today.</p>
    </div>
  </AuthenticatedLayout>
</template>
