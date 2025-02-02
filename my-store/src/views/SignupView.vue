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
import { useRouter } from "vue-router";
import axios from "axios";
import { toast } from "vue-sonner";
import { Shirt } from "lucide-vue-next";
const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

const formSchema = toTypedSchema(
  z.object({
    firstName: z
      .string()
      .min(2, { message: "First Name must be at least 2 characters" })
      .max(50, "First Name must be at most 50 characters"),
    lastName: z
      .string()
      .min(2, "Last Name must be at least 2 characters")
      .max(50, "First Name must be at most 50 characters"),
    email: z.string().email({ message: "Invalid email format" }),
    password: z
      .string()
      .min(8, { message: "Password must be at least 8 characters" })
      .max(20, { message: "Password must not exceed 20 characters" })
      .regex(strongPasswordRegex, {
        message:
          "Password must include uppercase, lowercase, number, and special character",
      }),
  })
);
const form = useForm({
  validationSchema: formSchema,
});
const router = useRouter();

const submitSignup = form.handleSubmit(async (values) => {
  try {
    const url = import.meta.env.VITE_API_URL;
    await axios.post(url + "/api/register", {
      first_name: values.firstName,
      last_name: values.lastName,
      email: values.email,
      password: values.password,
    });
    router.push("/login");
    toast("Account successfully created. Please login");
  } catch (error: any) {
    toast("Sign up failed: " + error.toString());
  }
});

function goToLogin() {
  router.push("/login");
}
</script>

<template>
  <div class="w-screen h-screen flex flex-wrap justify-center content-center">
    <Card class="w-[80%] md:w-[500px] h-fit">
      <CardHeader>
        <CardTitle class="text-center"
          ><div class="flex justify-center gap-5 mb-5">
            <Shirt />
            Elysian
          </div></CardTitle
        >
      </CardHeader>
      <form @submit="submitSignup">
        <CardContent>
          <FormField v-slot="{ componentField }" name="firstName">
            <FormItem>
              <FormLabel>First Name</FormLabel>
              <FormControl>
                <Input id="firstName" placeholder="John" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="lastName">
            <FormItem>
              <FormLabel>Last Name</FormLabel>
              <FormControl>
                <Input id="lastName" placeholder="Doe" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="email">
            <FormItem>
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input
                  id="email"
                  placeholder="someone@email.com"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="password">
            <FormItem>
              <FormLabel>Password</FormLabel>
              <FormControl>
                <Input
                  id="password"
                  placeholder="Password"
                  type="password"
                  v-bind="componentField"
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
        </CardContent>
        <CardFooter class="flex justify-between px-6 pb-6">
          <Button type="submit">Signup</Button>
          <Button @click="goToLogin" variant="link">Login</Button>
        </CardFooter>
      </form>
    </Card>
  </div>
</template>
