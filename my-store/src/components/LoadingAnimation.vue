<template>
  <div class="flex space-x-2 p-1 rounded-lg">
    <div
      v-for="(delay, index) in delays"
      :key="index"
      class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"
      :style="{ animationDelay: delay }"
    ></div>
  </div>
</template>

<script setup lang="ts">
const delays = ["0s", "0.2s", "0.4s"];
</script>
