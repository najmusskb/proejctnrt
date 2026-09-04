<template>
  <div class="tickets-view">
    <!-- Hero Section -->
    <section class="tickets-hero">
      <div class="tickets-hero-content">
        <h1 class="tickets-hero-title">Tickets</h1>
        <p class="tickets-hero-subtitle">Skip the lines and explore Rome's top attractions at your own pace with our fast-track entry tickets.</p>
      </div>
    </section>

    <!-- Filter Bar -->
    <div class="tickets-filter-bar">
      <span class="filter-label">Filter By</span>
      <select v-model="selectedCategory" class="filter-select">
        <option value="">All Categories</option>
        <option v-for="c in categories" :key="c.id" :value="c.slug">{{ c.name }}</option>
      </select>
      <input 
        type="text" 
        v-model="searchQuery" 
        placeholder="Search tickets..." 
        class="filter-select" 
        style="min-width: 180px; background-image: none;"
      />
    </div>

    <!-- Tickets Grid -->
    <section class="tickets-container">
      <div v-if="loading" class="text-center py-20">
        <LoadingSpinner />
        <p class="text-gray-500 mt-4 text-sm font-semibold">Loading Rome tickets & passes...</p>
      </div>

      <div v-else class="tickets-grid">
        <router-link 
          v-for="tour in filteredTickets" 
          :key="tour.id" 
          :to="'/tour/' + tour.slug" 
          class="ticket-card"
        >
          <img :src="getImgUrl(tour.image)" :alt="tour.name" class="ticket-bg">
          <div class="ticket-overlay"></div>
          
          <div class="ticket-top">
            <h3 class="ticket-title">{{ tour.name }}</h3>
            <div v-if="tour.duration" style="color: #c8a84e; font-size: 13px; font-weight: 600;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right:4px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              {{ tour.duration }}
            </div>
          </div>
          
          <div class="ticket-bottom">
            <div class="tour-price-box">
              <div class="ticket-price-label">From</div>
              <div class="ticket-price-val">€{{ Math.round(tour.price || 35) }}</div>
            </div>
            <div class="ticket-btn">Book Now</div>
          </div>
        </router-link>

        <div v-if="!loading && filteredTickets.length === 0" style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
          <h3 style="font-size: 24px; color: #6b7280;">No tickets found.</h3>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const tours = ref([]);
const categories = ref([]);
const loading = ref(true);
const selectedCategory = ref('');
const searchQuery = ref('');

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const fetchTickets = async () => {
  loading.value = true;
  try {
    const res = await fetch('/api/tickets');
    const data = await res.json();
    tours.value = data.tours || [];
    categories.value = data.categories || [];
  } catch (e) {
    console.error('Failed to fetch tickets', e);
  } finally {
    loading.value = false;
  }
};

const filteredTickets = computed(() => {
  let list = tours.value;
  if (selectedCategory.value) {
    list = list.filter(t => t.category?.slug === selectedCategory.value);
  }
  if (searchQuery.value.trim()) {
    const q = searchQuery.value.trim().toLowerCase();
    list = list.filter(t => t.name.toLowerCase().includes(q) || (t.description && t.description.toLowerCase().includes(q)));
  }
  return list;
});

onMounted(() => {
  fetchTickets();
});
</script>

<style scoped>
.tickets-hero {
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
.tickets-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.tickets-hero-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
}
.tickets-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.1;
}
.tickets-hero-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.5;
}
.tickets-filter-bar {
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
.tickets-container {
    padding: 60px 5%;
    background: #fcfcfc;
}
.tickets-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 24px;
}
@media (min-width: 640px) {
    .tickets-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (min-width: 1024px) {
    .tickets-grid { grid-template-columns: repeat(4, 1fr); }
}
.ticket-card {
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
.ticket-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.ticket-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    transition: transform 0.5s ease;
}
.ticket-card:hover .ticket-bg {
    transform: scale(1.05);
}
.ticket-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.85) 100%);
    z-index: 2;
}
.ticket-top {
    position: relative;
    z-index: 3;
    padding: 24px;
}
.ticket-title {
    color: #fff;
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 8px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.ticket-bottom {
    position: relative;
    z-index: 3;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.ticket-price-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
    margin-bottom: 2px;
}
.ticket-price-val {
    font-size: 20px;
    font-weight: 700;
}
.ticket-btn {
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
.ticket-card:hover .ticket-btn {
    background: #ddb94e;
}
@media (max-width: 768px) {
    .tickets-hero { height: 320px; background-attachment: scroll; }
    .tickets-hero-title { font-size: 36px; }
    .tickets-hero-subtitle { font-size: 14px; }
    .tickets-filter-bar { flex-wrap: wrap; gap: 12px; }
    .tickets-container { padding: 40px 4%; }
}
@media (max-width: 480px) {
    .tickets-hero { height: 260px; }
    .tickets-hero-title { font-size: 28px; }
    .tickets-hero-subtitle { font-size: 13px; }
    .filter-select { min-width: 0 !important; width: 100%; box-sizing: border-box; padding: 8px 30px 8px 12px; font-size: 13px; }
    .tickets-container { padding: 30px 4%; }
    .ticket-card { height: 320px; }
    .ticket-top { padding: 16px; }
    .ticket-bottom { padding: 16px; }
    .ticket-title { font-size: 22px; }
}
</style>
