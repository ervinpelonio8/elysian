<script setup lang="ts">
import NormalSidebar from "@/components/NormalSidebar.vue";
import ChatMessage from "@/components/ChatMessage.vue";
import { reactive, ref, watch } from "vue";
import LoadingAnimation from "@/components/LoadingAnimation.vue";
import Textarea from "@/components/ui/textarea/Textarea.vue";
import Button from "@/components/ui/button/Button.vue";
import { Send } from "lucide-vue-next";
import axios from "axios";
import { toast } from "vue-sonner";
import { nextTick } from "vue";
const messages = reactive([
  {
    type: "received",
    message: {
      text: "Hi, I'm your shopping assistant. How can I help you today? ",
      products: [],
    },
  },
]);

const isLoading = ref(false);
const message = ref("");
// Reference for the scrollable chat container
const chatContainer = ref<HTMLDivElement | null>(null);

// A method to scroll the chat container to the bottom
const scrollToBottom = () => {
  nextTick(() => {
    if (chatContainer.value) {
      chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
  });
};

// Watch for changes in messages to trigger scrollToBottom
watch(messages, () => {
  scrollToBottom();
});

const handleSendChat = async () => {
  if (!message.value.toString().trim()) return; // Don't send empty messages
  messages.push({ message: { text: message.value, products: [] }, type: "sent" });
  const currentMessage = message.value;
  message.value = "";
  const url = import.meta.env.VITE_API_URL;
  isLoading.value = true;
  try {
    const response = await axios.post(
      url + "/api/chat",
      { query: currentMessage },
      {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      }
    );
    let parsedResponse;
    parsedResponse = JSON.parse(response.data.replace(/```json\n|\n```/g, ""));
    messages.push({
      message: { text: parsedResponse.message, products: parsedResponse.products },
      type: "received",
    });
    console.log("Parsed Response: ", parsedResponse);
    isLoading.value = false;
  } catch (error: any) {
    toast("An error occured: " + error.toString());
  }
};
</script>
<template>
  <NormalSidebar header="Chat" page-name="Chat">
    <div class="flex flex-col h-full w-full">
      <div class="flex-1 overflow-hidden">
        <div class="relative h-full">
          <div ref="chatContainer" class="overflow-y-auto w-full h-full">
            <div class="p-4 space-y-4">
              <ChatMessage v-for="(msg, index) in messages" :key="index" :message="msg" />
              <LoadingAnimation v-if="isLoading" />
            </div>
          </div>
        </div>
      </div>

      <div class="border-t bg-white p-4">
        <div class="flex items-center space-x-2">
          <Textarea
            placeholder="Ask me anything..."
            class="flex-1 bg-gray-100"
            v-model:model-value="message"
            @keypress.enter="handleSendChat"
            autoFocus
          />
          <Button @click="handleSendChat" size="icon" :disabled="isLoading">
            <Send class="h-4 w-4" />
            <span class="sr-only">Send</span>
          </Button>
        </div>
      </div>
    </div>
  </NormalSidebar>
</template>
