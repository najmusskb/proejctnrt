<template>
  <div class="tours-view">
    <!-- Hero Section -->
    <section class="Tours-hero">
      <div class="Tours-hero-content">
        <h1 class="Tours-hero-title">Tours</h1>
        <p class="Tours-hero-subtitle">Skip the lines and explore Rome's top attractions at your own pace with our fast-track entry Tours.</p>
      </div>
    </section>

    <!-- Filter Bar -->
    <div class="Tours-filter-bar">
      <span class="filter-label">Filter By</span>
      <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        <select v-model="selectedAttraction" class="filter-select" @change="applyFilters">
          <option value="">Select Attraction</option>
          <option v-for="d in destinations" :key="d.id" :value="d.slug">{{ d.name }}</option>
        </select>
        <select v-model="selectedType" class="filter-select" @change="applyFilters">
          <option value="">Select Type</option>
          <option v-for="c in categories" :key="c.id" :value="c.slug">{{ c.name }}</option>
        </select>
        <input 
          type="text" 
          v-model="searchQuery" 
          placeholder="Search tours..." 
          class="filter-select" 
          style="min-width: 180px; background-image: none;"
          @input="applyFilters"
        />
        <button 
          v-if="selectedAttraction || selectedType || searchQuery" 
          @click="resetFilters" 
          class="filter-select" 
          style="text-align:center;text-decoration:none;color:#a58530;font-weight:700;width:auto;padding:10px 16px;border-color:#a58530;background:#fff;"
        >
          &#10006; Reset
        </button>
      </div>
    </div>

    <!-- Tours Grid -->
    <section class="Tours-container">
      <div v-if="loading" class="text-center py-20">
        <LoadingSpinner />
        <p class="text-gray-500 mt-4 text-sm font-semibold">Loading Rome tours...</p>
      </div>

      <div v-else class="Tours-grid">
        <router-link 
          v-for="tour in tours" 
          :key="tour.id" 
          :to="'/tour/' + tour.slug" 
          class="tour-card"
        >
          <img :src="getImgUrl(tour.image)" :alt="tour.name" class="tour-bg">
          <div class="tour-overlay"></div>
          
          <div class="tour-top">
            <h3 class="tour-title">{{ tour.name }}</h3>
            <div v-if="tour.duration" style="color: #c8a84e; font-size: 13px; font-weight: 600;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right:4px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              {{ tour.duration }}
            </div>
          </div>
          
          <div class="tour-bottom">
            <div class="tour-price-box">
              <div class="tour-price-label">From</div>
              <div class="tour-price-val">€{{ Math.round(tour.price || 45) }}</div>
            </div>
            <div class="tour-btn">Book Now</div>
          </div>
        </router-link>

        <div v-if="!loading && tours.length === 0" style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
          <h3 style="font-size: 24px; color: #6b7280;">No Tours found.</h3>
          <p style="color:#9ca3af;margin-top:8px;">
            Try a different filter or <button @click="resetFilters" style="color:#a58530;font-weight:700;text-decoration:underline;">view all tours</button>.
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const tours = ref([]);
const destinations = ref([]);
const categories = ref([]);
const loading = ref(true);

const selectedAttraction = ref(route.query.attraction || '');
const selectedType = ref(route.query.type || '');
const searchQuery = ref(route.query.search || '');

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const fetchTours = async () => {
  loading.value = true;
  try {
    const params = new URLSearchParams();
    if (selectedAttraction.value) params.append('attraction', selectedAttraction.value);
    if (selectedType.value) params.append('type', selectedType.value);
    if (searchQuery.value) params.append('search', searchQuery.value);

    const res = await fetch(`/api/tours?${params.toString()}`);
    const data = await res.json();
    tours.value = data.tours || [];
    destinations.value = data.destinations || [];
    categories.value = data.categories || [];
  } catch (e) {
    console.error('Failed to fetch tours', e);
  } finally {
    loading.value = false;
  }
};

const applyFilters = () => {
  const query = {};
  if (selectedAttraction.value) query.attraction = selectedAttraction.value;
  if (selectedType.value) query.type = selectedType.value;
  if (searchQuery.value) query.search = searchQuery.value;

  router.replace({ query });
  fetchTours();
};

const resetFilters = () => {
  selectedAttraction.value = '';
  selectedType.value = '';
  searchQuery.value = '';
  router.replace({ query: {} });
  fetchTours();
};

watch(() => route.query, (newQ) => {
  selectedAttraction.value = newQ.attraction || '';
  selectedType.value = newQ.type || '';
  searchQuery.value = newQ.search || '';
  fetchTours();
});

onMounted(() => {
  fetchTours();
});
</script>

<style scoped>
.Tours-hero {
    position: relative;
    width: 100%;
    height: 420px;
    background-image: url('/uploads/slider/Rome_6a9132df7e458.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.Tours-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.Tours-hero-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
}
.Tours-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.1;
}
.Tours-hero-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.5;
}
.Tours-filter-bar {
    background: #fff;
    box-shadow: 0 4px 25px rgba(0,0,0,0.06);
    padding: 16px 5%;
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    z-index: 10;
    border-bottom: 1px solid #f1f1f1;
}
.filter-label {
    font-size: 13px;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.filter-select {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px 36px 10px 16px;
    font-size: 14px;
    font-weight: 600;
    color: #1f2937;
    background: #fff url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>') no-repeat right 12px center;
    background-size: 16px;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
    min-width: 200px;
    transition: all 0.2s;
}
.filter-select:focus {
    border-color: #c8a84e;
    box-shadow: 0 0 0 3px rgba(200,168,78,0.1);
}
.Tours-container {
    padding: 60px 5%;
    background: #fcfcfc;
}
.Tours-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 24px;
}
@media (min-width: 640px) {
    .Tours-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (min-width: 1024px) {
    .Tours-grid { grid-template-columns: repeat(4, 1fr); }
}
.tour-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    height: 380px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-decoration: none !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.3s;
}
.tour-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.tour-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    transition: transform 0.5s ease;
}
.tour-card:hover .tour-bg {
    transform: scale(1.05);
}
.tour-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.85) 100%);
    z-index: 2;
}
.tour-top {
    position: relative;
    z-index: 3;
    padding: 24px;
}
.tour-title {
    color: #fff;
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 8px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.tour-bottom {
    position: relative;
    z-index: 3;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.tour-price-box {
    color: #fff;
}
.tour-price-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
    margin-bottom: 2px;
}
.tour-price-val {
    font-size: 20px;
    font-weight: 700;
}
.tour-btn {
    background: #c8a84e;
    color: #0b1623;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 10px 20px;
    border-radius: 30px;
    transition: background 0.2s;
}
.tour-card:hover .tour-btn {
    background: #ddb94e;
}
@media (max-width: 768px) {
    .Tours-hero { height: 320px; background-attachment: scroll; }
    .Tours-hero-title { font-size: 36px; }
    .Tours-hero-subtitle { font-size: 14px; }
    .Tours-filter-bar { flex-wrap: wrap; gap: 12px; }
    .Tours-container { padding: 40px 4%; }
}
@media (max-width: 480px) {
    .Tours-hero { height: 260px; }
    .Tours-hero-title { font-size: 28px; }
    .Tours-hero-subtitle { font-size: 13px; }
    .filter-select { min-width: 0 !important; width: 100%; box-sizing: border-box; padding: 8px 30px 8px 12px; font-size: 13px; }
    .Tours-container { padding: 30px 4%; }
    .tour-card { height: 320px; }
    .tour-top { padding: 16px; }
    .tour-bottom { padding: 16px; }
    .tour-title { font-size: 22px; }
}
</style>
