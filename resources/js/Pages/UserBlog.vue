<script setup>
import NavLink from "@/Components/NavLink.vue";
import { useDate } from "@/Composables/date";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
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
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Your blog" />
    <div class="mt-10 lg:mx-40 mx-5">
      <h1 class="text-4xl mb-4 font-bold">Your Blogs</h1>
      <div v-for="blog in blogs" :key="blog.id" class="bg-white mb-4 rounded-lg p-2">
        <div class="flex justify-between flex-wrap gap-5 mt-10 p-5">
          <img :src="`/storage/${blog.image}`" alt="" class="w-full lg:w-60 rounded-xl" />
          <div>
            <p class="text-orange-500 mb-2">{{ blog.category }}</p>
            <h1 class="text-start text-5xl font-bold">{{ blog.title }}</h1>
            <p class="mt-2 text-lg text-gray-800">{{ blog.content.slice(0, 40) }}</p>
            <p class="mt-2 ext-sm text-gray-500">
              {{ useDate(blog.created_at).formattedDate }}
            </p>
          </div>
          <div class="flex items-start gap-2 ms-auto">
            <a
              :href="route('blog.update.view', blog.id)"
              class="bg-blue-500 px-4 py-3 rounded-lg"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="size-5"
              >
                <path
                  d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z"
                />
              </svg>
            </a>
            <button @click="deleteBlog(blog.id)" class="bg-red-500 px-4 py-3 rounded-lg">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="size-5"
              >
                <path
                  fill-rule="evenodd"
                  d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
