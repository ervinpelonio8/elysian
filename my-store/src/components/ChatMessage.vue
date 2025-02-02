<script setup lang="ts">
import ImageCard from "./ImageCard.vue";
import VueMarkdownIt from "vue3-markdown-it";

interface Product {
  id: number;
  name: string;
  image: string;
  price: number;
}
interface MessageContent {
  text: string;
  products: Array<Product>;
}
interface Message {
  type: string;
  message: MessageContent;
}
const props = defineProps<{ message: Message }>();

const storageUrl = import.meta.env.VITE_API_STORAGE;
</script>

<template>
  <div
    :class="[
      'flex items-start space-x-2',
      message.type === 'sent' ? 'justify-end' : 'justify-start',
    ]"
  >
    <div class="flex flex-col max-w-[70%]">
      <div
        :class="[
          'rounded-lg p-3 shadow',
          message.type === 'sent' ? 'bg-blue-500 text-white' : 'bg-white text-black',
        ]"
      >
        <VueMarkdownIt :source="message.message.text" />
        <!-- <p>{{ message.message.text }}</p> -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mt-5">
          <ImageCard
            v-for="product in message.message.products"
            :key="product.id"
            :imageSrc="`${storageUrl}/${product.image}`"
            :name="product.name"
            :altText="`${product.name} Item`"
            :price="product.price.toFixed(2).toString()"
            :id="product.id"
          />
        </div>
      </div>
    </div>
  </div>
</template>
