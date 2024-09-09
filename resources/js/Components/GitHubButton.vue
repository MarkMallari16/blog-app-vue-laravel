<script setup>
import GithubIcon from "../../css/assets/github.svg";
</script>
<template>
  <a href="/auth/github/redirect" class="flex items-center gap-3 bg-black w-full text-white p-4 rounded-lg">
    <img :src="GithubIcon" alt="icon" class="bg-white p-1 rounded-lg" />
    Sign in with GitHub
  </a>
</template>
