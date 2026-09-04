<template>
  <div class="about-view bg-gray-50 pb-10 md:pb-16">
    <!-- HERO SECTION -->
    <section class="about-hero">
      <div class="about-hero-content">
        <p class="about-hero-kicker">Welcome to Journey With Mr. J</p>
        <h1 class="about-hero-title">About Us</h1>
        <p class="about-hero-subtitle">Discover our story and how we make your Rome experience extraordinary.</p>
      </div>
    </section>

    <!-- CONTENT SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
      <div v-if="loading" class="text-center py-20">
        <LoadingSpinner />
        <p class="text-gray-500 mt-4 text-sm font-semibold">Loading About Data...</p>
      </div>
      
      <div v-else-if="aboutData" class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
        <!-- Image & Stats -->
        <div class="relative">
          <div class="relative rounded-2xl overflow-hidden shadow-2xl">
            <img :src="getImgUrl(aboutData?.image)" alt="About Us" class="w-full h-64 sm:h-[450px] object-cover"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/60 to-transparent"></div>
            
            <div class="absolute bottom-6 left-6 right-6 flex flex-wrap items-center justify-between gap-3">
              <div class="bg-white/90 backdrop-blur rounded-2xl px-4 sm:px-6 py-3 sm:py-4 text-center shadow-lg flex-1 min-w-[120px]">
                <div class="text-2xl sm:text-3xl font-extrabold text-navy leading-none">{{ aboutData?.counter1_number || '35K+' }}</div>
                <div class="text-[10px] sm:text-[11px] font-semibold text-gray-500 tracking-wide uppercase mt-1">{{ aboutData?.counter1_label || 'Happy Travellers' }}</div>
              </div>
              <div class="bg-gold/95 rounded-2xl px-4 sm:px-6 py-3 sm:py-4 text-center shadow-lg flex-1 min-w-[120px]">
                <div class="text-2xl sm:text-3xl font-extrabold text-navy leading-none">{{ aboutData?.counter2_number || '4.8★' }}</div>
                <div class="text-[10px] sm:text-[11px] font-semibold text-navy/70 tracking-wide uppercase mt-1">{{ aboutData?.counter2_label || 'Avg. Rating' }}</div>
              </div>
            </div>
          </div>
          
          <div class="absolute top-4 sm:-top-6 right-2 sm:-right-5 bg-navy text-gold rounded-[16px] px-5 py-4 text-center shadow-2xl rotate-3">
            <div class="text-2xl font-extrabold leading-none">{{ aboutData?.badge_number || '12' }}</div>
            <div class="text-[10px] font-semibold tracking-widest uppercase mt-1">{{ aboutData?.badge_label || 'Years Exp.' }}</div>
          </div>
        </div>

        <!-- Text Details -->
        <div>
          <p class="text-[12px] font-bold tracking-[3px] text-[#c69c27] uppercase mb-3">{{ aboutData?.subtitle || 'Experience Rome' }}</p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-6" style="font-family: 'Cormorant Garamond', serif;">
            {{ aboutData?.title || 'See Rome Through The Eyes Of A Local' }}
          </h2>
          <div class="w-16 h-1 bg-[#c69c27] rounded-sm mb-6"></div>
          
          <div class="prose prose-lg text-gray-600 leading-relaxed mb-8" v-html="aboutData?.description || 'Nice in Rome Tour is more than a booking service — we are a family of passionate Roman guides who have spent a decade uncovering the Eternal City secrets.'"></div>
          
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
            <li v-for="(check, cIdx) in checkmarks" :key="cIdx" class="flex items-start gap-3">
              <span class="w-7 h-7 rounded-full bg-[#c69c27]/15 text-[#c69c27] flex items-center justify-center text-sm shrink-0 mt-0.5">&#10003;</span>
              <span class="text-[15px] font-medium text-gray-800">{{ check }}</span>
            </li>
          </ul>

          <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <router-link to="/tours" class="w-full sm:w-auto text-center bg-[#c69c27] hover:bg-[#b08820] text-white px-8 py-3.5 rounded-xl font-bold transition-all hover:-translate-y-1 shadow-lg shadow-[#c69c27]/30">
              {{ aboutData?.button2_text || 'Browse All Tours' }}
            </router-link>
            <router-link to="/contact-us" class="w-full sm:w-auto text-center bg-white border-2 border-gray-200 text-gray-800 px-8 py-3.5 rounded-xl font-bold transition-all hover:bg-gray-50 hover:border-gray-300">
              Contact Us
            </router-link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const aboutData = ref(null);
const loading = ref(true);

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const checkmarks = computed(() => {
  if (!aboutData.value?.checkmarks) return ['Licensed local guides', 'Skip-the-line access', 'Small group experiences', '24/7 customer support'];
  try {
    return JSON.parse(aboutData.value.checkmarks);
  } catch (e) {
    return [aboutData.value.checkmarks];
  }
});

const fetchAbout = async () => {
  loading.value = true;
  try {
    const res = await fetch('/api/company');
    const data = await res.json();
    aboutData.value = data.about;
  } catch (err) {
    console.error('Failed to fetch about data', err);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchAbout();
});
</script>

<style scoped>
.about-hero {
  position: relative;
  width: 100%;
  height: 420px;
  background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg/960px-Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 0 5%;
}
.about-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(0,0,0,.85) 0%, rgba(0,0,0,.4) 100%);
  z-index: 1;
}
.about-hero-content { position: relative; z-index: 2; max-width: 640px; }
.about-hero-kicker { color: #ddb94e; font-size: 13px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 8px; }
.about-hero-title { font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700; color: #fff; line-height: 1.1; margin-bottom: 12px; }
.about-hero-subtitle { font-size: 16px; color: rgba(255,255,255,.85); line-height: 1.7; max-width: 600px; }

@media (max-width: 768px) {
  .about-hero-content { max-width: 100%; }
}
@media (max-width: 640px) {
  .about-hero { padding: 0 6%; }
  .about-hero-title { font-size: 40px; }
}
@media (max-width: 480px) {
  .about-hero { height: 360px; padding: 0 24px; background-attachment: scroll; }
  .about-hero-kicker { font-size: 11px; letter-spacing: 1.5px; margin-bottom: 6px; }
  .about-hero-title { font-size: 32px; line-height: 1.15; margin-bottom: 10px; }
  .about-hero-subtitle { font-size: 14.5px; line-height: 1.6; }
}
.prose p {
  margin-bottom: 1em;
}
</style>
