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
    <div class=" mt-10 mx-5 lg:mx-48 gap-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3" v-if="blogs && blogs.length > 0">
      <div
        v-for="blog in blogs"
        :key="blog.id"
        class="mb-4 bg-white px-5 py-6 rounded-xl "
      >
        <BlogCard :blog="blog" :authUserId="authUserId" />
      </div>
    </div>
    <div v-else class="mt-10 text-center bg-white mx-48 p-5 rounded-lg">
      <p>No blogs available today.</p>
    </div>
  </AuthenticatedLayout>
</template>
