<script setup>
import BlogCard from "@/Components/BlogCard.vue";
import NavLink from "@/Components/NavLink.vue";
import { useDate } from "@/Composables/date";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

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
  latestBlogs: {
    type: Array,
    required: true,
  },

});
const isMenuOpen = ref(false);

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
  <Head title="Welcome" />
  <div class="relative lg:flex lg:items-center lg:justify-between p-8">
    <div class="flex justify-between">
      <h1 class="text-2xl font-black uppercase">
        Tambayan<span class="text-orange-500 font-extrabold">Thoughts</span>
      </h1>
      <div @click="toggleMenu" class="relative lg:hidden cursor-pointer">
        <div v-if="isMenuOpen">
          <button>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="size-8"
            >
              <path
                fill-rule="evenodd"
                d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </div>
        <div v-else>
          <button>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="size-8"
            >
              <path
                fill-rule="evenodd"
                d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>
    <div v-if="isMenuOpen" class="flex flex-col lg:flex-row mt-10 lg:mt-0 gap-5 lg:gap-5">
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase transition ease-in-out"
      >
        Home
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase transition ease-in-out"
      >
        Blogs
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase transition ease-in-out"
      >
        About Us
      </Link>
      <Link
        :href="route('login')"
        class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm uppercase transition ease-in-out"
      >
        Contact us
      </Link>
    </div>

    <div v-if="canLogin">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm transition ease-in-out"
      >
        Dashboard
      </Link>

      <template v-else>
        <div
          v-if="isMenuOpen"
          class="flex flex-col mt-4 lg:mt-0 lg:flex-row gap-2 lg:gap-5"
        >
          <Link
            :href="route('login')"
            class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm transition ease-in-out"
          >
            Log in
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="font-semibold text-gray-600 hover:text-orange-500 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm transition ease-in-out"
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
  <div class="p-8">
    <h1 class="text-center text-3xl mt-20">Latest Blogs</h1>
    <div class="mt-8 flex flex-wrap lg:flex-nowrap gap-6">
      <div v-for="latestBlog in latestBlogs" :key="latestBlog.id" class="w-full">
        <BlogCard :blog="latestBlog"/>
      </div>
    </div>
  </div>
</template>
