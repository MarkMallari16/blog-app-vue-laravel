<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps({
  post: {
    type: Object,
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

const deletePost = (postId) => {
  if (confirm("Are you sure you want to delete this post?")) {
    form.delete(route("post.delete", postId));
  }
};
</script>
<template>
  <div>
    <div>
      <span class="text-slate-400">Artificial Intelligence</span>
      <img
        class="mt-3 rounded-lg w-full object-cover"
        :src="`/storage/${post.image}`"
        :alt="post.title"
      />
    </div>

    <h1 class="text-2xl mt-4 font-bold">{{ post.title }}</h1>

    <p>
      {{ post.content }}
    </p>

    <div class="mt-5 justify-between flex items-center">
      <div class="flex items-center gap-3">
        <img :src="`/storage/avatars/${post.user.avatar}`" alt="avatar" class="w-8" />
        <p>{{ post.user.name }}</p>
      </div>
      <div>
        <button class="bg-primary text-white rounded-lg p-2 flex  items-center gap-2">
          Read Full Article
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="size-5"
          >
            <path
              fill-rule="evenodd"
              d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>
