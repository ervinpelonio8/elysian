<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from "@/components/ui/alert-dialog";

const storageUrl = import.meta.env.VITE_API_STORAGE;
const props = defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(["update-quantity", "remove-item"]);
// Remove item
const removeItem = () => {
  emit("remove-item", props.item.id);
};

const updateQuantity = (value: Number) => {
  emit("update-quantity", props.item.id, Number(value));
};
</script>

<template>
  <div class="flex items-center justify-between p-4 border-b">
    <!-- Image -->
    <div class="w-20 h-20">
      <img
        :src="storageUrl + '/' + item.image"
        alt="Product Image"
        class="w-full h-full object-cover rounded-lg"
      />
    </div>

    <!-- Details -->
    <div class="flex-1 ml-4">
      <p class="font-semibold">{{ item.name }}</p>
      <p class="text-sm text-gray-600">PHP {{ item.price }}</p>
      <p class="text-sm text-gray-600">{{ item.quantity }} items remaining</p>
    </div>

    <Input
      type="number"
      name="qty"
      @input="updateQuantity($event.target.value)"
      :modelValue="item.order_qty"
      :max="item.stock"
      min="1"
      class="w-16 p-2 border rounded mr-2"
    />

    <div class="text-right">
      <p class="font-semibold">PHP {{ (item.price * item.order_qty).toFixed(2) }}</p>
    </div>

    <AlertDialog>
      <AlertDialogTrigger asChild>
        <Button variant="ghost" class="text-red-500 hover:text-red-700">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </Button>
      </AlertDialogTrigger>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>Are you sure?</AlertDialogTitle>
          <AlertDialogDescription>
            This action cannot be undone. This will remove the item from your cart.
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel>Cancel</AlertDialogCancel>
          <AlertDialogAction @click="removeItem">Remove</AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  </div>
</template>
