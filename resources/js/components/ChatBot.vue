<template>
  <div>
    <!-- PROJECT CHATBOT -->
    <div class="chatbot-window" :class="{ open: isOpen }" id="cbWindow">
      
      <div class="cb-header">
        <div class="cb-avatar">
          <svg viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 22.7 456.5 22 458c-1.4 2.8-2 5.8-2 8.8 0 11 9 20 20 20 5.4 0 10.6-2.1 14.6-5.8 47.9-43.9 83-60.5 106.8-68 30.1 11.2 62.7 17.5 96.6 17.5 141.4 0 256-93.1 256-208S397.4 32 256 32zm0 352c-29.3 0-57.9-5.3-84.5-15.1l-14.7-5.4-14 5.3c-24.8 9.5-60.2 24.5-98.8 45.4 12.1-23.7 25.4-53.5 32.8-82.6l4-15.8-11.2-12C36.8 271.7 16 230 16 184c0-99.3 107.5-180 240-180s240 80.7 240 180-107.5 180-240 180z"/></svg>
        </div>
        <div class="cb-title-wrap">
          <div class="cb-title">Aura (Rome Guide)</div>
          <div class="cb-status">Always ready to help!</div>
        </div>
        <button class="cb-header-close" @click="toggleChatbot" aria-label="Close Chat">&times;</button>
      </div>

      <div class="cb-body" id="cbBody">
        <!-- Home View -->
        <div class="cb-body-inner" :class="{ active: currentTab === 'home' }" id="cbHomeView">
          <div class="cb-card">
            <div class="cb-card-title"><span style="font-size:16px">&#9889;</span> Quick Actions</div>
            <button class="cb-action-btn" @click="startChat('I want to buy tickets')"><span class="icon">&#127915;</span> Buy Tickets <span class="arr">&rarr;</span></button>
            <button class="cb-action-btn" @click="startChat('I want to check my booking')"><span class="icon">&#128203;</span> My Booking <span class="arr">&rarr;</span></button>
            <button class="cb-action-btn" @click="startChat('I want to chat with Max')"><span class="icon">&#128172;</span> Chat with Max <span class="arr">&rarr;</span></button>
            <a :href="appStore.waLink('Hi, I would like to inquire about Rome tours.')" target="_blank" class="cb-action-btn"><span class="icon">&#128241;</span> WhatsApp <span class="arr">&rarr;</span></a>
          </div>

          <div class="cb-card">
            <div class="cb-card-title"><span style="font-size:16px">&#128161;</span> Popular Questions</div>
            <button class="cb-action-btn" @click="startChat('How do I book?')"><span class="icon">&#128467;&#65039;</span> How do I book? <span class="arr">&rarr;</span></button>
            <button class="cb-action-btn" @click="startChat('What\'s included in the tour?')"><span class="icon">&#9989;</span> What's included? <span class="arr">&rarr;</span></button>
            <button class="cb-action-btn" @click="startChat('What\'s the cancellation policy?')"><span class="icon">&#8617;&#65039;</span> Cancellation policy? <span class="arr">&rarr;</span></button>
          </div>
        </div>

        <!-- Messages View -->
        <div class="cb-body-inner" :class="{ active: currentTab === 'messages' }" id="cbMessagesView" ref="messagesContainer">
          <div v-for="(msg, idx) in messages" :key="idx" class="cb-msg-wrapper" :class="msg.sender">
            <div class="cb-msg" :class="msg.sender" v-html="msg.text"></div>
          </div>
          <div v-if="isTyping" class="cb-msg-wrapper bot">
            <div class="cb-typing"><div class="cb-dot"></div><div class="cb-dot"></div><div class="cb-dot"></div></div>
          </div>
        </div>
      </div>

      <div class="cb-footer" v-show="currentTab === 'messages'">
        <form class="cb-input-wrap" @submit.prevent="handleSend">
          <input type="text" v-model="userInput" class="cb-input" id="cbInput" ref="inputRef" placeholder="Ask Aura about Rome..." autocomplete="off">
          <button type="submit" class="cb-send" aria-label="Send Message">
            <svg viewBox="0 0 512 512"><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
          </button>
        </form>
      </div>

      <!-- Bottom Nav -->
      <div class="cb-bottom-nav">
        <button class="cb-nav-btn" :class="{ active: currentTab === 'home' }" @click="currentTab = 'home'">
          <svg viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
          Home
        </button>
        <button class="cb-nav-btn" :class="{ active: currentTab === 'messages' }" @click="openMessagesTab">
          <svg viewBox="0 0 512 512"><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>
          Messages
        </button>
        <a :href="appStore.waLink('Hi, I need help with my Rome trip!')" target="_blank" class="cb-nav-btn">
          <svg viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 .1-.4 .3-.6 .5V288c0 13.3-10.7 24-24 24s-24-10.7-24-24V256c0-7 3.5-13.6 9.4-17.4l32.1-20.6c11.6-7.4 18.7-20 18.7-33.8c0-21.7-17.6-39.2-39.2-39.2H194.7c-9 0-17 5.7-20 14.2l-14 39.5c-4.4 12.5-18.4 19-30.8 14.6s-19-18.4-14.6-30.8l14.4-41zM256 352a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
          Help
        </a>
      </div>
    </div>

    <!-- Floating Chatbot Toggler Button -->
    <button class="chatbot-toggler" :class="{ open: isOpen }" id="cbToggler" aria-label="Toggle Chatbot" @click="toggleChatbot">
      <svg viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 22.7 456.5 22 458c-1.4 2.8-2 5.8-2 8.8 0 11 9 20 20 20 5.4 0 10.6-2.1 14.6-5.8 47.9-43.9 83-60.5 106.8-68 30.1 11.2 62.7 17.5 96.6 17.5 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>
      <span class="cb-close">&times;</span>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();

const isOpen = ref(false);
const currentTab = ref('home');
const userInput = ref('');
const isTyping = ref(false);
const inputRef = ref(null);
const messagesContainer = ref(null);

const messages = ref([
  {
    sender: 'bot',
    text: 'Benvenuto! &#127470;&#127481; I\'m Aura, your AI travel concierge. How can I assist you today?',
  },
]);

const toggleChatbot = () => {
  isOpen.value = !isOpen.value;
  if (isOpen.value && currentTab.value === 'messages') {
    nextTick(() => {
      inputRef.value?.focus();
      scrollToBottom();
    });
  }
};

const openMessagesTab = () => {
  currentTab.value = 'messages';
  nextTick(() => {
    inputRef.value?.focus();
    scrollToBottom();
  });
};

const startChat = (text) => {
  currentTab.value = 'messages';
  if (text) {
    handleProcess(text);
  }
  nextTick(() => {
    scrollToBottom();
  });
};

const handleSend = () => {
  const txt = userInput.value.trim();
  if (!txt) return;
  userInput.value = '';
  handleProcess(txt);
};

const handleProcess = (txt) => {
  messages.value.push({ sender: 'user', text: txt });
  scrollToBottom();

  isTyping.value = true;
  setTimeout(() => {
    isTyping.value = false;
    let reply = "That sounds wonderful! Our most popular experience is the <b>Colosseum Skip-the-Line</b> tour. <br><br>Would you like to see the available time slots for this week?";
    const tLower = txt.toLowerCase();

    if (tLower.includes('vatican')) {
      reply = "Ah, the Vatican! &#127984; We offer VIP early access to the Sistine Chapel so you can beat the crowds. Highly recommended! Check out our packages.";
    } else if (tLower.includes('price') || tLower.includes('cost') || tLower.includes('deal')) {
      reply = "Our experiences range from €18 for basic entry to €109 for full VIP packages. <br><br>&#127881; <b>Secret tip:</b> Use code <b>ROME15</b> at checkout for 15% off!";
    } else if (tLower.includes('how do i book') || tLower.includes('book')) {
      reply = "Booking is easy! Just choose a tour from our website and click 'Book Now', or we can handle the booking right here in this chat or over WhatsApp.";
    } else if (tLower.includes('included')) {
      reply = "Our tours typically include skip-the-line tickets, an expert guide, and headsets. You can check the specific tour details for exact inclusions!";
    } else if (tLower.includes('cancellation') || tLower.includes('cancel')) {
      reply = "We offer a 100% free cancellation policy up to 24 hours before your tour starts. Peace of mind guaranteed! &#9989;";
    } else if (tLower.includes('hi') || tLower.includes('hello') || tLower.includes('hey')) {
      reply = "Ciao! How can I make your Rome trip unforgettable today?";
    } else if (tLower.includes('max')) {
      reply = "Max is ready to help you directly on WhatsApp with customized packages and instant bookings!";
    }

    messages.value.push({ sender: 'bot', text: reply });
    scrollToBottom();
  }, 900);
};

const scrollToBottom = () => {
  nextTick(() => {
    if (messagesContainer.value) {
      messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
    }
  });
};

onMounted(() => {
  window.toggleChatbot = toggleChatbot;
  window.startChat = startChat;
});
</script>
