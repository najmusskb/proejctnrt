<template>
  <div class="app-root">
    <SiteHeader />
    <main>
      <router-view />
    </main>
    <SiteFooter />
    <ChatBot />
    <FloatingSocials />
    <ToastNotification />
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useAppStore } from './stores/app';
import SiteHeader from './components/SiteHeader.vue';
import SiteFooter from './components/SiteFooter.vue';
import ChatBot from './components/ChatBot.vue';
import FloatingSocials from './components/FloatingSocials.vue';
import ToastNotification from './components/ToastNotification.vue';

const appStore = useAppStore();

onMounted(() => {
  appStore.loadCompany();
  appStore.loadHome();
});
</script>

<style>
/* Global scoped transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.25s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Global Click Feedback for all buttons & action links */
button, 
a[class*="bg-"], 
a[class*="border-"], 
.nav-action-btn,
.btn {
  transition: transform 0.15s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.15s ease !important;
  will-change: transform;
}

button:active, 
a[class*="bg-"]:active, 
a[class*="border-"]:active,
.nav-action-btn:active,
.btn:active {
  transform: scale(0.95) !important;
  opacity: 0.85 !important;
}

/* Exclude header nav links from scaling, just color change is enough */
.nav-links a:active {
  transform: none !important;
}
</style>
