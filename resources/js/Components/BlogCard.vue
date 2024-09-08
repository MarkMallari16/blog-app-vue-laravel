<script setup>
import { useForm } from "@inertiajs/vue3";
import NavLink from "./NavLink.vue";
import SecondaryButton from "./SecondaryButton.vue";
import { useDate } from "@/Composables/date";

const props = defineProps({
  blog: {
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

const deleteBlog = (blogId) => {
  if (confirm("Are you sure you want to delete this blog?")) {
    form.delete(route("blog.delete", blogId));
  }
};
const { formattedDate } = useDate(props.blog.created_at);
</script>
<template>
  <div class="w-full">
    <div class="mb-4">
      <img
        class="rounded-lg w-full object-cover h-60"
        :src="`/storage/${blog.image}`"
        :alt="blog.title"
      />
    </div>
    <p class="text-slate-400">{{ blog.category }}</p>
    <h1 class="mt-1 text-2xl font-bold">{{ blog.title }}</h1>

    <p class="text-slate-700">
      {{ `${blog.content.slice(0, 40)}...` }}
    </p>

    <div class="mt-6 justify-between flex items-center">
      <div class="flex items-center gap-3">
        <img :src="`${blog.user.avatar}`" alt="avatar" class="w-10 rounded-lg" />
        <div>
          <p class="font-medium">{{ blog.user.name }}</p>
          <p class="text-sm text-slate-400">{{ formattedDate }}</p>
        </div>
      </div>
      <div>
        <NavLink :href="route('blogs.show', blog.id)" class="flex gap-2 text-orange-500">
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
        </NavLink>
      </div>
    </div>
  </div>
</template>
