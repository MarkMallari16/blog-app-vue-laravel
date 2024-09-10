<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <Head title="Welcome" />
  <div class="relative sm:flex sm:items-center sm:justify-between p-8">
    <h1 class="text-2xl font-black uppercase">
      Tambayan<span class="text-orange-500">Thoughts</span>
    </h1>

    <div v-if="canLogin">
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm"
        >
          Dashboard
        </Link>

        <template v-else>
          <div class="flex gap-5">
            <Link
              :href="route('login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm"
            >
              Blogs
            </Link>
            <Link
              :href="route('login')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm"
            >
              Log in
            </Link>

            <Link
              v-if="canRegister"
              :href="route('register')"
              class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm"
            >
              Register
            </Link>
          </div>
        </template>
      </div>
  </div>
  
  <div class="flex items-center flex-wrap lg:flex-nowrap gap-4 p-8 ">
    <h1 class="text-4xl font-bold">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam, alias quisquam
      aliquam tempora
    </h1>
    <img
      src="https://img.freepik.com/free-photo/teamwork-meeting-with-business-people_23-2148825936.jpg?t=st=1726004089~exp=1726007689~hmac=f85fec63a6b5c07d31a038a20dab01a2a7c6efb907bfc01958a93b53f1276fc0&w=900"
      alt="blog-picture"
      class="rounded-sm"
    />
  </div>
</template>
