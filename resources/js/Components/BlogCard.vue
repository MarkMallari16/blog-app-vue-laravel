<script setup>
import NavLink from "./NavLink.vue";
import { useDate } from "@/Composables/date";
import { useAvatar } from "@/Composables/avatar";

const props = defineProps({
  blog: {
    type: Object,
    required: true,
  },
});

const avatar = props?.blog?.user?.avatar;
const { avatarUrl } = useAvatar(avatar);
</script>
<template>
  <div class="w-full ring-1 ring-inset rounded-lg  ring-gray-300  overflow-hidden">
    <div class="mb-4 overflow-hidden">
      <img
        class="rounded-t-lg w-full object-cover h-52 hover:scale-110  transition-all ease-out "
        :src="`/storage/${blog.image}`"
        :alt="blog.title"
      />
    </div>
    <div class="p-5">
      <p class="text-orange-500">{{ blog.category }}</p>
      <h1 class="mt-1 text-2xl font-bold">{{ blog.title }}</h1>

      <p class="text-slate-700">
        {{ `${blog.content.slice(0, 40)}...` }}
      </p>
      <div class="mt-6 justify-between flex items-center">
        <div class="flex items-center gap-3">
          <img
            :src="avatarUrl"
            alt="avatar"
            class="w-10 h-10 object-cover rounded-full"
          />
          <div>
            <p class="font-medium">{{ blog.user.name }}</p>
            <p class="text-sm text-slate-400">
              {{ useDate(blog.created_at).formattedDate }}
            </p>
          </div>
        </div>
        <div>
          <NavLink :href="route('blogs.show', blog.id)" class="flex gap-2">
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
  </div>
</template>
