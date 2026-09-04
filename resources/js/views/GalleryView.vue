<template>
  <div class="gallery-page">
    <section class="Gal-hero">
      <div class="Gal-hero-content">
        <h1 class="Gal-title">Photo Gallery</h1>
        <p class="Gal-subtitle">Sneak a peek at Rome's most photogenic corners &mdash; straight from our travellers.</p>
      </div>
    </section>

    <section class="Gal-wrap">
      <div v-if="loading" class="text-center py-20">
        <LoadingSpinner />
      </div>

      <div v-else class="Gal-grid">
        <a 
          v-for="(s, i) in gallery" 
          :key="s.id || i" 
          class="Gal-item" 
          :style="{ gridRow: (i % 6) === 0 ? 'span 2' : 'span 1' }"
          @click.prevent="openLightbox(i)"
        >
          <img :src="getImgUrl(s.image)" :alt="s.title || 'Rome Tour Photo'">
          <div class="ovl">
            <span class="t">{{ s.title || 'Rome Experience' }}</span>
            <span class="m">&#10084; {{ Number(s.likes || 120).toLocaleString() }} &middot; &#128172; {{ Number(s.comments || 15).toLocaleString() }}</span>
          </div>
        </a>
      </div>
    </section>

    <!-- Lightbox -->
    <div class="Gal-lightbox" :style="{ display: isLightboxOpen ? 'flex' : 'none' }" @click.self="isLightboxOpen = false">
      <button class="Gal-close" @click="isLightboxOpen = false">&times;</button>
      <button class="Gal-prev" @click="prevImage">&#10094;</button>
      <img v-if="currentImage" :src="getImgUrl(currentImage.image)" :alt="currentImage.title">
      <button class="Gal-next" @click="nextImage">&#10095;</button>
      <div class="Gal-lb-title" v-if="currentImage">{{ currentImage.title }} ({{ currentIndex + 1 }} / {{ gallery.length }})</div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const gallery = ref([]);
const loading = ref(true);
const isLightboxOpen = ref(false);
const currentIndex = ref(0);

const currentImage = computed(() => gallery.value[currentIndex.value] || null);

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const openLightbox = (i) => {
  currentIndex.value = i;
  isLightboxOpen.value = true;
};

const prevImage = () => {
  currentIndex.value = (currentIndex.value - 1 + gallery.value.length) % gallery.value.length;
};

const nextImage = () => {
  currentIndex.value = (currentIndex.value + 1) % gallery.value.length;
};

const handleKeydown = (e) => {
  if (!isLightboxOpen.value) return;
  if (e.key === 'Escape') isLightboxOpen.value = false;
  if (e.key === 'ArrowRight') nextImage();
  if (e.key === 'ArrowLeft') prevImage();
};

onMounted(async () => {
  document.addEventListener('keydown', handleKeydown);
  try {
    const res = await fetch('/api/gallery');
    const data = await res.json();
    gallery.value = data.gallery || [];
  } catch (e) {
    console.error('Failed to load gallery', e);
  } finally {
    loading.value = false;
  }
});

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown);
});
</script>

<style scoped>
.Gal-hero {
    position: relative;
    width: 100%;
    height: 420px;
    background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.Gal-hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%); z-index: 1; }
.Gal-hero-content { position: relative; z-index: 2; max-width: 620px; }
.Gal-title { font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.1; }
.Gal-subtitle { font-size: 18px; color: rgba(255,255,255,0.85); line-height: 1.6; font-family: 'Mulish', sans-serif; }
.Gal-wrap { max-width: 1280px; margin: 0 auto; padding: 60px 24px 80px; }
.Gal-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 180px; gap: 12px; }
@media (max-width: 1024px) { .Gal-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 200px; } }
@media (max-width: 768px) { .Gal-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 170px; } .Gal-title { font-size: 40px; } .Gal-hero { height: 320px; background-attachment: scroll; } .Gal-wrap { padding: 40px 16px 50px; } }
@media (max-width: 480px) { .Gal-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 140px; gap: 8px; } .Gal-title { font-size: 30px; } .Gal-subtitle { font-size: 15px; } .Gal-hero { height: 280px; padding: 0 4%; } .Gal-wrap { padding: 30px 12px 40px; } .Gal-prev, .Gal-next { width: 40px; height: 40px; font-size: 16px; } .Gal-close { width: 38px; height: 38px; font-size: 18px; top: 14px; right: 16px; } }
.Gal-item { position: relative; border-radius: 12px; overflow: hidden; cursor: pointer; display: block; }
.Gal-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s; }
.Gal-item:hover img { transform: scale(1.1); }
.Gal-item .ovl { position: absolute; inset: 0; background: linear-gradient(to top, rgba(11,22,35,.8), transparent 70%); opacity: 0; transition: opacity .3s; display: flex; flex-direction: column; justify-content: flex-end; padding: 12px; }
.Gal-item:hover .ovl { opacity: 1; }
.Gal-item .ovl .t { color: #fff; font-weight: 700; font-size: 13px; }
.Gal-item .ovl .m { color: #fff; font-size: 11px; margin-top: 3px; opacity: .8; }
.Gal-lightbox { position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; background: rgba(5,10,20,.95); backdrop-filter: blur(6px); }
.Gal-lightbox img { max-height: 76vh; max-width: 92%; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,.6); }
.Gal-lb-title { position: absolute; bottom: 30px; left: 0; right: 0; color: #fff; font-weight: 600; font-size: 14px; text-align: center; }
.Gal-close, .Gal-prev, .Gal-next { position: absolute; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.25); color: #fff; border-radius: 50%; cursor: pointer; }
.Gal-close { top: 20px; right: 24px; width: 44px; height: 44px; font-size: 20px; }
.Gal-prev, .Gal-next { top: 50%; transform: translateY(-50%); width: 48px; height: 48px; font-size: 18px; }
.Gal-prev { left: 16px; } .Gal-next { right: 16px; }
.Gal-close:hover, .Gal-prev:hover, .Gal-next:hover { background: #c8a84e; color: #0b1623; }
</style>
