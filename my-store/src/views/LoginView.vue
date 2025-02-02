<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import Checkbox from "@/components/ui/checkbox/Checkbox.vue";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import { Shirt } from "lucide-vue-next";

const email = ref("");
const password = ref("");
const isAdmin = ref(false);
const invalidLogin = ref(false);
const router = useRouter();
async function submitLogin() {
  try {
    const url = import.meta.env.VITE_API_URL;
    const response = await axios.post(url + "/api/login", {
      email: email.value,
      password: password.value,
      is_admin: isAdmin.value,
    });
    invalidLogin.value = false;
    localStorage.setItem("token", response.data.access_token);
    localStorage.setItem("userId", response.data.user.id);
    localStorage.setItem("firstName", response.data.user.first_name);
    localStorage.setItem("lastName", response.data.user.last_name);
    localStorage.setItem("role", response.data.user.is_admin ? "admin" : "user");

    if (isAdmin.value) {
      router.push("/add-product");
    } else {
      router.push("/products");
    }
  } catch (error: any) {
    invalidLogin.value = true;
  }
}

function goToSignUp() {
  router.push("/signup");
}
</script>

<template>
  <div class="w-screen h-screen flex flex-wrap justify-center content-center">
    <Card class="w-[80%] md:w-[500px] h-fit">
      <CardHeader>
        <CardTitle class="text-center">
          <div class="flex justify-center gap-5 mb-5">
            <Shirt />
            Elysian
          </div>
        </CardTitle>
      </CardHeader>
      <CardContent>
        <p v-if="invalidLogin" class="text-red-600 text-center font-semibold mb-2">
          Invalid Login Credentials
        </p>
        <form>
          <div class="grid items-center w-full gap-4">
            <div class="flex flex-col space-y-1.5">
              <Label for="email">Email</Label>
              <Input
                id="email"
                type="email"
                placeholder="someone@email.com"
                v-model:model-value="email"
              />
            </div>
            <div class="flex flex-col space-y-1.5">
              <Label for="password">Password</Label>
              <Input
                id="password"
                type="password"
                placeholder="Password"
                v-model:model-value="password"
              />
            </div>
            <div class="flex items-center space-x-2">
              <Checkbox id="isAdmin" v-model:checked="isAdmin" />
              <label
                for="isAdmin"
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
              >
                Login as Administrator
              </label>
            </div>
          </div>
        </form>
      </CardContent>
      <CardFooter class="flex justify-between px-6 pb-6">
        <Button @click="submitLogin">Login</Button>
        <Button @click="goToSignUp" variant="link">Signup</Button>
      </CardFooter>
    </Card>
  </div>
</template>
