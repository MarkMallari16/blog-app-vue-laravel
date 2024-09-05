<script setup>
import BlogCard from "@/Components/BlogCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

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

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class=" mt-10 mx-5 lg:mx-48 gap-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3" v-if="posts && posts.length > 0">
      <div
        v-for="post in posts"
        :key="post.id"
        class="mb-4 bg-white px-5 py-6 rounded-xl "
      >
        <BlogCard :post="post" :authUserId="authUserId" />
      </div>
    </div>
    <div v-else class="mt-10 text-center">
      <p>No posts available.</p>
    </div>
  </AuthenticatedLayout>
</template>
