<script setup>
import { useDate } from "@/Composables/date";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
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


</script>
<template>
  <AuthenticatedLayout>
    <div class="mt-20 lg:mx-40">
      <div v-for="blog in blogs" :key="blog.id">
        <div class="flex  gap-5 mt-10">
          <img :src="`/storage/${blog.image}`" alt="" class="w-60 rounded-lg" />
          <div>
            <p class="text-start text-5xl font-bold">{{ blog.title }}</p>
            <p class="mt-1 ext-sm text-gray-500">{{ useDate(blog.created_at).formattedDate  }}</p>
          </div>
          <div class="flex gap-2 ms-auto">
            <p>Edit</p>
            <p>Delete</p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
