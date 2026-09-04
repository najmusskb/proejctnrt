<template>
  <transition name="toast">
    <div v-if="appStore.toast" class="toast-notification" :class="appStore.toast.type">
      <span class="toast-icon" v-html="icon"></span>
      <span class="toast-msg">{{ appStore.toast.message }}</span>
      <button class="toast-close" @click="appStore.toast = null" aria-label="Close">&#10005;</button>
    </div>
  </transition>
</template>

<script setup>
import { computed } from 'vue';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();

const icon = computed(() => {
  const t = appStore.toast?.type;
  if (t === 'success') return '&#9989;';
  if (t === 'error') return '&#9888;&#65039;';
  if (t === 'exists') return '&#127381;';
  return '&#8505;&#65039;';
});
</script>

<style scoped>
.toast-notification {
  position: fixed;
  top: 90px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 3000;
  display: flex;
  align-items: center;
  gap: 10px;
  background: #0b1623;
  color: #fff;
  padding: 13px 20px;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(0,0,0,.35);
  font-size: 14px;
  font-weight: 600;
  max-width: 92vw;
  border: 1px solid rgba(255,255,255,.12);
}
.toast-notification.success { border-left: 4px solid #25D366; }
.toast-notification.exists { border-left: 4px solid #c8a84e; }
.toast-notification.error { border-left: 4px solid #ef4444; }
.toast-icon { font-size: 16px; flex-shrink: 0; }
.toast-msg { flex: 1; }
.toast-close { background: none; border: none; color: rgba(255,255,255,.6); font-size: 13px; cursor: pointer; padding: 2px 4px; flex-shrink: 0; }
.toast-close:hover { color: #fff; }

.toast-enter-active, .toast-leave-active { transition: all .3s ease; }
.toast-enter-from, .toast-leave-to { opacity: 0; transform: translateX(-50%) translateY(-12px); }
</style>
