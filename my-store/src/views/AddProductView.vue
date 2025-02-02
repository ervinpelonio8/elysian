<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
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
import { Input } from "@/components/ui/input";
import AdminSidebar from "@/components/AdminSidebar.vue";
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { ref } from "vue";
import axios from "axios";
import { toast } from "vue-sonner";

const formSchema = toTypedSchema(
  z.object({
    name: z.string().min(1, { message: "Name is required" }),
    description: z.string().min(1, { message: "Description is required" }),
    price: z.number().min(0.01, { message: "Price must be greater than 0" }),
    qty: z.number().min(1, { message: "Quantity must be greater than 0" }),
    file: z.instanceof(File).optional(),
  })
);

const { handleSubmit, setFieldValue, resetForm, errors } = useForm({
  validationSchema: formSchema,
});

const fileInputRef = ref<HTMLInputElement | null>(null);
const nameKey = ref<number>(0);
const descriptionKey = ref<number>(0);
const priceKey = ref<number>(0);
const qtyKey = ref<number>(0);
const fileKey = ref<number>(0);

const imagePreview = ref<string | undefined>(undefined);

const handleImageChange = (event: Event) => {
  const input = event.target as HTMLInputElement;
  const file = input.files?.[0];

  if (file) {
    setFieldValue("file", file);
    const reader = new FileReader();
    reader.onload = () => {
      imagePreview.value = reader.result as string;
    };
    reader.readAsDataURL(file);
  } else {
    setFieldValue("file", undefined);
    imagePreview.value = undefined;
  }
};

const submitProduct = handleSubmit(async (values) => {
  try {
    const formData = new FormData();

    formData.append("name", values.name);
    formData.append("description", values.description);
    formData.append("price", values.price.toString());
    formData.append("quantity", values.qty.toString());

    if (values.file) {
      formData.append("image", values.file);
    }
    const url = import.meta.env.VITE_API_URL;
    await axios.post(url + "/api/products", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    });

    toast("Product Created Successfully!");
    resetForm();
    imagePreview.value = undefined;
    nameKey.value++;
    descriptionKey.value++;
    priceKey.value++;
    qtyKey.value++;
    fileKey.value++;
  } catch (error: any) {
    toast("Error in creating the product: " + error.toString());
  }
});
</script>

<template>
  <AdminSidebar header="Add Product" page-name="Add Product">
    <div class="w-full h-full flex flex-wrap justify-center">
      <Card class="w-[80%] md:w-[500px] h-fit">
        <CardHeader>
          <CardTitle class="text-center">Product Details</CardTitle>
        </CardHeader>
        <form @submit.prevent="submitProduct">
          <CardContent>
            <!-- Product name field -->
            <FormField v-slot="{ componentField }" name="name">
              <FormItem>
                <FormLabel>Name</FormLabel>
                <FormControl>
                  <Input
                    :key="nameKey"
                    id="name"
                    placeholder="Shorts for Male"
                    v-bind="componentField"
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>

            <!-- Product description field -->
            <FormField v-slot="{ componentField }" name="description">
              <FormItem>
                <FormLabel>Description</FormLabel>
                <FormControl>
                  <Textarea
                    :key="descriptionKey"
                    id="description"
                    placeholder="Type in the product description"
                    v-bind="componentField"
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>

            <!-- Product price field -->
            <FormField v-slot="{ componentField }" name="price">
              <FormItem>
                <FormLabel>Price (PHP)</FormLabel>
                <FormControl>
                  <Input
                    :key="priceKey"
                    id="price"
                    type="number"
                    placeholder="1.00"
                    v-bind="componentField"
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>

            <!-- Product quantity field -->
            <FormField v-slot="{ componentField }" name="qty">
              <FormItem>
                <FormLabel>Quantity</FormLabel>
                <FormControl>
                  <Input
                    :key="qtyKey"
                    id="qty"
                    type="number"
                    placeholder="1"
                    v-bind="componentField"
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>

            <!-- Product image field -->
            <FormField name="file">
              <FormItem>
                <FormLabel>Image</FormLabel>
                <FormControl>
                  <Input
                    :key="fileKey"
                    id="file"
                    type="file"
                    accept="image/*"
                    @change="handleImageChange"
                    class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90 border-0 h-fit cursor-pointer"
                  />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>

            <!-- Image preview -->
            <div v-if="imagePreview" class="mt-4">
              <label class="block text-sm font-medium text-gray-700">
                Image Preview
              </label>
              <div class="relative w-full h-64 mt-2 rounded-lg overflow-hidden">
                <img
                  :src="imagePreview"
                  alt="Product preview"
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
          </CardContent>

          <!-- Submit button -->
          <CardFooter class="flex justify-center px-6 pb-6 w-full">
            <Button type="submit" class="w-full">Save</Button>
          </CardFooter>
        </form>
      </Card>
    </div>
  </AdminSidebar>
</template>
