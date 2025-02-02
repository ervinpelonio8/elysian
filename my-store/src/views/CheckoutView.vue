<script setup lang="ts">
import { ref, computed, onMounted } from "vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardFooter } from "@/components/ui/card";
import CheckoutItem from "@/components/CheckoutItem.vue";
import NormalSidebar from "@/components/NormalSidebar.vue";
import axios from "axios";
import { toast } from "vue-sonner";
import { useRouter } from "vue-router";
const userId = localStorage.getItem("userId");
const token = localStorage.getItem("token");
const url = import.meta.env.VITE_API_URL;
const router = useRouter();
const cartItems = ref<
  Array<{
    id: number;
    name: string;
    image: string;
    price: number;
    order_qty: number;
    stock: number;
  }>
>([]);

const updateQuantity = (itemId: number, newQty: number) => {
  const item = cartItems.value.find((item) => item.id === itemId);
  if (item) {
    item.order_qty = newQty;
  }
};

const removeItem = async (itemId: number) => {
  try {
    const response = await axios.delete(url + "/api/cart", {
      data: {
        user_id: userId, // You need to pass the user ID here
        product_id: itemId,
      },
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    cartItems.value = cartItems.value.filter((item) => item.id !== itemId);
    toast("Product removed from cart");
  } catch (error: any) {
    toast("Failed to remove item from cart: " + error.toString());
  }
};

const totalAmount = computed(() => {
  return cartItems.value
    .reduce((total, item) => total + item.price * item.order_qty, 0)
    .toFixed(2);
});

const checkout = async () => {
  const orderData = cartItems.value.map((item) => ({
    product_id: item.id,
    user_id: userId,
    quantity: item.order_qty,
  }));

  try {
    const response = await axios.post(
      url + "/api/order",
      { orders: orderData },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    );

    toast(`Checkout successful! Total amount: PHP ${totalAmount.value}`);
    router.push("/products");
  } catch (error: any) {
    if (error.response && error.response.data) {
      const errorMessage = error.response.data.message || "Something went wrong!";
      toast(errorMessage);
    } else {
      toast("An error occurred. Please try again.");
    }
  }
};

const fetchCartItems = async () => {
  try {
    const response = await axios.get(url + "/api/cart/" + userId, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    cartItems.value = response.data;
  } catch (error: any) {
    toast("Error fetching cart items: " + error.toString());
  }
};

onMounted(fetchCartItems);
</script>

<template>
  <NormalSidebar header="Checkout" page-name="Checkout">
    <div class="p-6">
      <Card>
        <CardContent>
          <div class="space-y-4">
            <CheckoutItem
              v-for="item in cartItems"
              :key="item.id"
              :item="item"
              @update-quantity="updateQuantity"
              @remove-item="removeItem"
            />
          </div>

          <div class="mt-6 p-4 border-t">
            <p class="text-xl font-semibold text-right">
              Total Amount: PHP {{ totalAmount }}
            </p>
          </div>
        </CardContent>
        <CardFooter>
          <Button @click="checkout" class="w-full"> Checkout </Button>
        </CardFooter>
      </Card>
    </div>
  </NormalSidebar>
</template>
