<script setup lang="ts">
import NormalSidebar from "@/components/NormalSidebar.vue";
import { ref, computed, onMounted } from "vue"; // Import computed
import {
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from "@/components/ui/form";
import { useForm } from "vee-validate";
import { toTypedSchema } from "@vee-validate/zod";
import * as z from "zod";
import { useRoute, useRouter } from "vue-router";
import {
  Card,
  CardContent,
  CardFooter,
  CardTitle,
  CardHeader,
} from "@/components/ui/card";
import axios from "axios";
import Input from "@/components/ui/input/Input.vue";
import Button from "@/components/ui/button/Button.vue";
import { ShoppingBasket } from "lucide-vue-next";
import { toast } from "vue-sonner";
const storageUrl = import.meta.env.VITE_API_STORAGE;
const product = ref<{
  id: number;
  name: string;
  image: string;
  price: number;
  quantity: number;
  description: string;
}>();

const formSchema = computed(() =>
  toTypedSchema(
    z.object({
      qty: z
        .number()
        .min(1, { message: "Quantity must be at least 1" })
        .max(product.value?.quantity ?? 0, {
          message: "Quantity must not exceed stock count",
        }),
    })
  )
);

const form = useForm({
  validationSchema: formSchema,
});

const quantity = computed(() => form.values.qty || 0);

const total = computed(() => {
  const price = product.value?.price ?? 0;
  return (quantity.value * price).toFixed(2); // Format to 2 decimal places
});
const route = useRoute();
const router = useRouter();
const submitOrder = form.handleSubmit(async (values) => {
  try {
    const token = localStorage.getItem("token");
    const userId = localStorage.getItem("userId");
    const url = import.meta.env.VITE_API_URL;
    await axios.post(
      url + "/api/cart",
      {
        user_id: userId,
        product_id: product.value?.id,
        order_qty: values.qty,
      },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    );
    toast("Successfully added to cart.");
    router.push("/products");
  } catch (error: any) {
    toast("Error adding to cart: " + error.toString());
  }
});

const fetchProductDetail = async () => {
  const productId = route.params.productId;
  const url = import.meta.env.VITE_API_URL;

  const token = localStorage.getItem("token");
  const response = await axios.get(url + "/api/products/" + productId, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  product.value = response.data;
};
const computedMaxQty = computed(() => {
  product.value?.quantity ?? 0;
});

onMounted(fetchProductDetail);
</script>

<template>
  <NormalSidebar header="Product Details" page-name="Products">
    <div class="w-full h-full grid grid-cols-1 md:grid-cols-2 gap-5">
      <div class="w-full">
        <img
          :src="storageUrl + '/' + product?.image"
          alt="Product Image"
          class="w-[80%] md:w-[500px] md:h-[500px] object-cover mx-auto rounded-lg shadow-lg"
        />
      </div>
      <div class="w-full">
        <Card>
          <CardHeader>
            <CardTitle class="text-center">{{ product?.name }}</CardTitle>
          </CardHeader>
          <form @submit.prevent="submitOrder">
            <CardContent>
              <p>{{ product?.description }}</p>
              <div class="flex justify-between items-center mt-5">
                <span class="text-xl font-semibold text-gray-900"
                  >PHP {{ product?.price }}</span
                >
                <span class="text-sm text-gray-600"
                  >{{ product?.quantity }} items available</span
                >
              </div>
              <div class="mt-5">
                <FormField v-slot="{ componentField }" name="qty">
                  <FormItem>
                    <FormLabel>Quantity</FormLabel>
                    <FormControl>
                      <Input
                        id="qty"
                        placeholder="1"
                        type="number"
                        v-bind="componentField"
                        class="w-full"
                        :max="computedMaxQty"
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                </FormField>
              </div>
              <div class="mt-5">
                <p class="text-lg font-semibold">Total: PHP {{ total }}</p>
              </div>
            </CardContent>
            <CardFooter>
              <Button class="w-full">
                <ShoppingBasket />
                Add to Cart</Button
              >
            </CardFooter>
          </form>
        </Card>
      </div>
    </div>
  </NormalSidebar>
</template>
