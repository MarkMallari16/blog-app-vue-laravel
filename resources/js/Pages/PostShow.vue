<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
  post: Object,
  required: true,
});
</script>
<template>
  <AuthenticatedLayout>
    <div class="mt-10 mx-5 lg:mx-48 bg-white px-8 py-2 rounded-xl">
      <div>
        <h1 class="mt-4 mb-6 text-4xl font-bold">{{post.title}}</h1>
        <img :src="`/storage/${post.image}`" :alt="post.title" class="w-full rounded-2xl"/>
        <p class="mt-8 text-xl">{{post.content}}</p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
