<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useDate } from "@/Composables/date";
import { useAvatar } from "@/Composables/avatar";

const props = defineProps({
  blog: Object,
  required: true,
});

const { formattedDate } = useDate(props.blog.created_at);

const avatar = props?.blog?.user?.avatar;
const providerId = props?.blog?.user?.provider_id;

const { avatarUrl } = useAvatar(avatar, providerId);

</script>
<template>
  <AuthenticatedLayout>
    <div class="mt-10 mx-5 lg:mx-48 bg-white px-8 py-2 rounded-xl">
      <div>
        <div class="mt-6">
          <p class="text-orange-500">{{ blog.category }}</p>
        </div>
        <div class="mt-6 flex items-center gap-3">
          <img :src="avatarUrl" :alt="blog.title" class="w-12 h-12 rounded-full object-cover" />
          <p>{{ blog.user.name }}</p>
        </div>
        <div class="mt-2 mb-4 flex justify-between items-center">
          <div>
            <h1 class="text-4xl font-bold">{{ blog.title }}</h1>
            <p class="text-slate-500">{{ formattedDate }}</p>
          </div>
        </div>
        <img
          :src="`/storage/${blog.image}`"
          :alt="blog.title"
          class="w-full h-96 object-cover rounded-2xl"
        />
        <p class="indent-8 mt-8 text-lg text-slate-800 break-all whitespace-pre-line">
          {{ blog.content }}
        </p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
