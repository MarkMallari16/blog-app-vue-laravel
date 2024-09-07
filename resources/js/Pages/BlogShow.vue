<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
  blog: Object,
  required: true,
});
</script>
<template>
  <AuthenticatedLayout>
    <div class="mt-10 mx-5 lg:mx-48 bg-white px-8 py-2 rounded-xl">
      <p class="mt-4 text-slate-400">{{blog.category}}</p>
      <div>
        <div class="flex justify-between items-center">
          <h1 class="mt-4 mb-6 text-4xl font-bold">{{ blog.title }}</h1>
          <p>{{new Date(blog.created_at)}}</p>
        </div>
        <img
          :src="`/storage/${blog.image}`"
          :alt="blog.title"
          class="w-full rounded-2xl"
        />
        <p class="mt-8 text-xl">{{ blog.content }}</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
