<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Sheet, SheetContent, SheetTrigger } from "@/components/ui/sheet";
import { CircleUser, Menu, Package, Package2, Shirt } from "lucide-vue-next";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps({
  header: {
    type: String,
    required: false,
  },
  pageName: {
    type: String,
    required: true,
  },
});

const router = useRouter();

async function logout() {
  const url = import.meta.env.VITE_API_URL;
  await axios.post(
    url + "/api/logout",
    {},
    {
      headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    }
  );
  localStorage.removeItem("token");
  localStorage.removeItem("first_name");
  localStorage.removeItem("token");
  localStorage.removeItem("userId");
  localStorage.removeItem("firstName");
  localStorage.removeItem("lastName");
  localStorage.removeItem("role");

  router.push("/login");
}
</script>

<template>
  <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
    <div class="hidden border-r bg-muted/40 md:block sticky top-0 h-screen">
      <div class="flex h-full max-h-screen flex-col gap-2">
        <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
          <div class="flex items-center gap-3">
            <Shirt class="h-6 w-6" />
            <div class="flex-col">
              <p>Elysian</p>
              <p class="text-sm font-semibold">Administrator</p>
            </div>
          </div>
        </div>
        <div class="flex-1 overflow-y-auto">
          <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
            <a
              href="/add-product"
              :class="[
                'flex items-center gap-3 rounded-lg px-3 py-2 text-primary transition-all hover:text-primary',
                pageName === 'Add Product' ? 'bg-muted' : '',
              ]"
            >
              <Package class="h-4 w-4" />
              Add Product
            </a>
          </nav>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <header
        class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6 sticky top-0 z-10 bg-white"
      >
        <Sheet>
          <SheetTrigger as-child>
            <Button variant="outline" size="icon" class="shrink-0 md:hidden">
              <Menu class="h-5 w-5" />
              <span class="sr-only">Toggle navigation menu</span>
            </Button>
          </SheetTrigger>
          <SheetContent side="left" class="flex flex-col">
            <nav class="grid gap-2 text-lg font-medium">
              <a
                href="/add-product"
                class="flex items-center gap-2 text-lg font-semibold"
              >
                <Package2 class="h-6 w-6" />
                <span class="sr-only">My Store Administrator</span>
              </a>
              <a
                href="/add-product"
                :class="[
                  'mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-foreground hover:text-foreground',
                  pageName === 'Add Product' ? 'bg-muted' : '',
                ]"
              >
                <Package class="h-5 w-5" />
                Add Product
              </a>
            </nav>
          </SheetContent>
        </Sheet>
        <div class="w-full flex-1">
          <h2 class="text-lg font-semibold">{{ header }}</h2>
        </div>
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
              <CircleUser class="h-5 w-5" />
              <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>My Account</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem @click="logout">Logout</DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </header>
      <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 overflow-y-auto">
        <slot></slot>
      </main>
    </div>
  </div>
</template>
