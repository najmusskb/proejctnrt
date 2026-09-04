<template>
  <div class="destination-tours-view">
    <!-- HEADER / BREADCRUMB -->
    <div class="relative bg-navy pt-[120px] pb-16 px-6 overflow-hidden">
      <div class="absolute inset-0 opacity-25" :style="{ background: 'url(' + getImgUrl(destination?.image) + ') center/cover no-repeat' }"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/80 to-navy/40"></div>
      <div class="relative max-w-[1280px] mx-auto text-center">
        <nav class="text-[12px] tracking-wide text-gold mb-4 justify-center flex">
          <router-link to="/" class="text-white/60 no-underline hover:text-gold transition-colors">Home</router-link>
          <span class="mx-2 text-white/40">/</span>
          <router-link to="/all-destinations" class="text-white/60 no-underline hover:text-gold transition-colors">Destinations</router-link>
          <span class="mx-2 text-white/40">/</span>
          <span class="text-gold">{{ destination?.name }}</span>
        </nav>
        <h1 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,5vw,52px)] mb-3">{{ destination?.name }}</h1>
        <p class="text-[15px] text-white/70 max-w-[600px] mx-auto leading-relaxed" v-html="destination?.description"></p>
      </div>
    </div>

    <!-- TOURS SECTION -->
    <section class="py-20 px-6 bg-cream min-h-[500px]">
      <div class="max-w-[1280px] mx-auto">
        <div class="mb-10 text-center">
          <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-2">Explore Experiences</p>
          <h2 class="font-playfair text-navy font-bold leading-tight text-[clamp(24px,3.5vw,36px)]">Tours in {{ destination?.name }}</h2>
          <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
        </div>

        <div v-if="loading" class="text-center py-20">
          <LoadingSpinner />
        </div>
        
        <div v-else-if="tours.length > 0" class="tour-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[17px]">
          <div 
            v-for="tour in tours" 
            :key="tour.id" 
            class="tour-card bg-[#161821] rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)] flex flex-col"
          >
            <div class="tour-card-img relative h-[220px] overflow-hidden shrink-0">
              <router-link :to="'/tour/' + tour.slug" class="block w-full h-full">
                <img :src="getImgUrl(tour.image)" :alt="tour.name" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" style="background:#161821;"/>
              </router-link>
              <span class="absolute bottom-4 left-4 bg-[#059669] text-white text-[12px] font-bold py-1.5 px-3 rounded-full flex items-center gap-1.5 shadow-md">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Free cancellation
              </span>
              <span 
                v-if="tour.badge_type" 
                class="absolute top-4 left-4 text-[11px] font-extrabold py-1.5 px-3.5 rounded-full tracking-wide uppercase shadow-md max-w-[65%] truncate bg-[#d6a848] text-[#111827]"
              >
                {{ tour.badge_type }}
              </span>
              <button 
                class="absolute top-4 right-4 w-9 h-9 bg-[#1f2937]/70 backdrop-blur-md border-none rounded-full flex items-center justify-center cursor-pointer text-white transition-colors hover:bg-[#1f2937]/90 shadow-md"
                @click.stop="appStore.toggleWishlist(tour.id)"
                :aria-label="appStore.isWishlisted(tour.id) ? 'Remove wishlist' : 'Add wishlist'"
              >
                <svg width="16" height="16" viewBox="0 0 24 24" :fill="appStore.isWishlisted(tour.id) ? '#ef4444' : 'none'" :stroke="appStore.isWishlisted(tour.id) ? '#ef4444' : 'currentColor'" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              </button>
            </div>
            <div class="p-5 flex-1 flex flex-col bg-[#161821]">
              <router-link :to="'/tour/' + tour.slug" class="no-underline block mb-2">
                <h3 class="text-[17px] font-bold text-white leading-tight hover:text-[#d6a848] transition-colors line-clamp-2">{{ tour.name }}</h3>
              </router-link>
              
              <div class="flex items-center gap-1.5 mb-4">
                <span class="text-[#eab308] text-[15px]">&#9733;</span>
                <span class="text-white text-[15px] font-bold">{{ tour.rating || '4.8' }}</span>
                <span class="text-gray-400 text-[13px] font-medium">({{ tour.reviews_count || '2,841' }})</span>
              </div>
              
              <div class="grid grid-cols-2 gap-3 mb-5">
                <div class="flex items-start gap-1.5 text-[13px] text-gray-400 font-medium leading-snug">
                  <svg class="shrink-0 mt-[2px]" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span class="line-clamp-2">{{ tour.duration }}</span>
                </div>
                <div class="flex items-start gap-1.5 text-[13px] text-gray-400 font-medium leading-snug">
                  <svg class="shrink-0 mt-[2px]" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <span class="line-clamp-2">{{ tour.group_size || 'Small group' }}</span>
                </div>
              </div>

              <div class="h-px bg-white/10 mb-4 mt-auto"></div>
              
              <div class="flex items-center justify-between gap-2 mb-5">
                <div class="flex flex-col min-w-0">
                  <div class="flex items-end gap-1.5 leading-none flex-wrap">
                    <span class="text-[14px] text-gray-500 font-bold line-through">€{{ Math.round((tour.price || 35) * 1.15) }}</span>
                    <span class="text-[24px] font-extrabold text-[#d6a848] leading-none">€{{ tour.price || '35' }}</span>
                    <span class="text-[11px] font-bold text-[#059669] mb-1">-13%</span>
                  </div>
                  <span class="text-[12px] text-gray-500 mt-1.5 font-medium">per person</span>
                </div>
                <router-link :to="'/tour/' + tour.slug" class="bg-[#d6a848] text-[#111827] border-none py-2.5 px-5 rounded-xl text-[14px] font-extrabold cursor-pointer transition-all hover:bg-[#c69a38] no-underline shrink-0 text-center">
                  Book Now
                </router-link>
              </div>

              <button @click="handleAddToCart(tour)" class="flex items-center justify-center gap-2 w-full bg-transparent text-white border border-white/20 py-2.5 rounded-xl text-[14px] font-bold transition-all hover:bg-white/10">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"></circle><circle cx="20" cy="21" r="1.5"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <div v-else class="text-center py-10 bg-white rounded-2xl border border-cream-dark shadow-sm">
          <div class="text-[40px] mb-3">&#128681;</div>
          <h3 class="text-[18px] font-bold text-navy mb-2">No tours found</h3>
          <p class="text-[#6b7280] text-[14px]">We currently do not have any tours available for this destination.</p>
          <router-link to="/tours" class="inline-block mt-4 bg-navy text-white py-2.5 px-6 rounded-lg text-[13px] font-bold no-underline hover:bg-navy-light transition-colors">Browse all tours</router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useAppStore } from '../stores/app';

const route = useRoute();
const appStore = useAppStore();
const destination = ref(null);
const tours = ref([]);
const loading = ref(true);

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const handleAddToCart = (tour) => {
  const status = appStore.addToCart(tour);
  if (status === 'added') {
    appStore.notify(`"${tour.name}" added to cart`, 'success');
  } else {
    appStore.notify('This tour is already in your cart.', 'exists');
  }
};

const fetchData = async () => {
  loading.value = true;
  try {
    const slug = route.params.slug;
    const res = await fetch(`/api/destination/${slug}`);
    const data = await res.json();
    destination.value = data.destination;
    tours.value = data.tours || [];
  } catch (e) {
    console.error('Failed to load destination tours', e);
  } finally {
    loading.value = false;
  }
};

watch(() => route.params.slug, () => {
  fetchData();
});

onMounted(() => {
  fetchData();
});
</script>

<style scoped>
@media (max-width: 480px) {
  .tour-card-img { height: 170px; }
  .tour-card .p-5 { padding: 14px; }
  .destination-tours-view section { padding-top: 48px; padding-bottom: 48px; }
}
</style>
