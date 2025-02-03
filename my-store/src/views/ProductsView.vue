<script setup lang="ts">
import { ref } from "vue";
import ImageCard from "@/components/ImageCard.vue";
import NormalSidebar from "@/components/NormalSidebar.vue";
import axios from "axios";
import { toast } from "vue-sonner";

const products = ref<
  Array<{ id: number; name: string; image: string; price: number; sold_count: number }>
>([]);
const currentPage = ref(1);
const lastPage = ref(1);
const isLoading = ref(false);
const storageUrl = import.meta.env.VITE_API_STORAGE;
const apiUrl = import.meta.env.VITE_API_URL;

const fetchProducts = async (page: number) => {
  try {
    isLoading.value = true;
    const token = localStorage.getItem("token");
    const response = await axios.get(`${apiUrl}/api/products`, {
      headers: { Authorization: `Bearer ${token}` },
      params: { page },
    });
    products.value.push(...response.data.data);
    currentPage.value = response.data.current_page;
    lastPage.value = response.data.last_page;
  } catch (error: any) {
    toast("Error fetching products: " + error.toString());
  } finally {
    isLoading.value = false;
  }
};

const loadMoreProducts = () => {
  if (!isLoading.value && currentPage.value < lastPage.value) {
    fetchProducts(currentPage.value + 1);
  }
};

fetchProducts(1);
</script>

<template>
  <div>
    <NormalSidebar
      header="Products"
      page-name="Products"
      @scrolled-bottom="loadMoreProducts"
    >
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
      <div v-if="isLoading" class="text-center p-4">Loading more products...</div>
    </NormalSidebar>
  </div>
</template>
