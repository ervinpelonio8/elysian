<script setup lang="ts">
import { ref, onMounted } from "vue";
import ImageCard from "@/components/ImageCard.vue";
import NormalSidebar from "@/components/NormalSidebar.vue";
import axios from "axios";
import { toast } from "vue-sonner";

const products = ref<
  Array<{ id: number; name: string; image: string; price: number; sold_count: number }>
>([]);

const storageUrl = import.meta.env.VITE_API_STORAGE;
const fetchProducts = async () => {
  try {
    const url = import.meta.env.VITE_API_URL;

    const token = localStorage.getItem("token");
    const response = await axios.get(url + "/api/products", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    products.value = response.data;
  } catch (error: any) {
    toast("Error fetching products:" + error.toString());
  }
};

onMounted(fetchProducts);
</script>

<template>
  <div>
    <NormalSidebar header="Products" page-name="Products">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <ImageCard
          v-for="product in products"
          :key="product.id"
          :imageSrc="`${storageUrl}/${product.image}`"
          :name="product.name"
          :altText="`${product.name} Item`"
          :price="product.price.toFixed(2).toString()"
          :soldCount="product.sold_count.toString()"
          :id="product.id"
        />
      </div>
    </NormalSidebar>
  </div>
</template>
