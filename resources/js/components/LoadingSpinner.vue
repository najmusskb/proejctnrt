<template>
  <div class="inline-flex flex-col items-center justify-center">
    <div class="relative w-12 h-12 flex items-center justify-center">
      <!-- Bouncing Map Pin -->
      <svg class="animate-bounce text-[#d6a848] w-10 h-10 z-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
        <circle cx="12" cy="10" r="3"></circle>
      </svg>
      <!-- Shadow -->
      <div class="absolute bottom-0 w-6 h-1.5 bg-black/15 rounded-[50%] animate-pulse"></div>
    </div>
  </div>
</template>

<script setup>
</script>
