<script setup lang="ts">
import { defineProps } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const props = defineProps({
  imageSrc: {
    type: String,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  price: {
    type: String,
    required: true,
  },
  soldCount: {
    type: String,
    required: false,
  },
  altText: {
    type: String,
    required: true,
  },
  id: {
    type: Number,
    required: true,
  },
});

function onClick() {
  router.push("/products/" + props.id);
}
</script>
<template>
  <div
    class="w-full max-w-sm mx-auto overflow-hidden rounded-lg shadow-lg cursor-pointer"
    @click="onClick"
  >
    <div class="relative w-full aspect-square">
      <img
        :src="imageSrc || '/placeholder.svg'"
        :alt="altText"
        class="object-cover w-full h-full"
      />
    </div>
    <div class="p-4 bg-white">
      <h3 class="text-lg font-bold text-gray-800 mb-2">{{ name }}</h3>
      <div class="flex justify-between items-center">
        <span class="text-xl font-semibold text-gray-900">PHP {{ price }}</span>
        <span v-if="soldCount" class="text-sm text-gray-600">{{ soldCount }} sold</span>
      </div>
    </div>
  </div>
</template>
