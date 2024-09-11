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
    <div class="flex gap-5">
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase"
      >
        Home
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase"
      >
        Blogs
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase"
      >
        About Us
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase"
      >
        Contact us
      </Link>
    </div>
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

  <div class="flex items-center flex-wrap lg:flex-nowrap gap-4 p-8">
    <div class="lg:w-1/2 mb-5">
      <h1 class="text-4xl font-bold">
        Share Your Voice with the World – Start Writing Today
      </h1>
      <p class="mt-4 text-lg text-gray-600">
        Join our community of bloggers and readers. Whether you have a story to tell,
        insights to share, or knowledge to spread, our platform is the place to let your
        creativity thrive.
      </p>
      <a
        href="/dashboard"
        class="mt-6 inline-block px-6 py-3 bg-orange-500 text-white font-bold rounded-lg hover:bg-orange-700"
      >
        Explore Blogs
      </a>
    </div>
    <div>
      <img
        src="https://img.freepik.com/free-photo/hands-typing-laptop-computer-coffee-shop_9975-24499.jpg?t=st=1726059989~exp=1726063589~hmac=4e2d422f832bec4353d68c728253e412a64b77b34f80d3e485cf5ea7676cfef2&w=1060"
        class="rounded-sm"
        alt="Person typing on a laptop"
      />
    </div>
  </div>
</template>
