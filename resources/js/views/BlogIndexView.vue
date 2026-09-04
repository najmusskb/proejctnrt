<template>
  <div class="blog-index-view">
    <section class="BlogId-hero">
      <div class="BlogId-hero-content">
        <h1 class="BlogId-title">Travel Stories &amp; Tips</h1>
        <p class="BlogId-subtitle">Insider guides, travel tips and stories from Rome's hidden corners.</p>
      </div>
    </section>

    <section class="BlogId-wrap">
      <div v-if="loading" class="text-center py-20">
        <LoadingSpinner />
      </div>

      <div v-else class="BlogId-grid">
        <router-link 
          v-for="blog in blogs" 
          :key="blog.id" 
          :to="'/blog/' + blog.slug" 
          class="BlogId-card"
        >
          <div class="BlogId-card-img">
            <img :src="getImgUrl(blog.image)" :alt="blog.title">
          </div>
          <div class="BlogId-card-body">
            <span class="BlogId-author">{{ blog.author || 'Journal' }}</span>
            <h3 class="BlogId-card-title">{{ blog.title }}</h3>
            <p class="BlogId-card-desc">{{ blog.short_description || blog.description }}</p>
            <p class="BlogId-meta">&#128197; {{ formatDate(blog.created_at) }} &nbsp;&middot;&nbsp; {{ blog.read_time || '5' }} min read</p>
            <span class="BlogId-read">Read More &rarr;</span>
          </div>
        </router-link>
      </div>

      <!-- Pagination -->
      <div v-if="totalPages > 1" class="BlogId-pag">
        <button 
          v-if="currentPage > 1" 
          @click="changePage(currentPage - 1)"
        >
          &laquo;
        </button>
        <button 
          v-for="p in totalPages" 
          :key="p" 
          :class="{ active: currentPage === p }"
          @click="changePage(p)"
        >
          {{ p }}
        </button>
        <button 
          v-if="currentPage < totalPages" 
          @click="changePage(currentPage + 1)"
        >
          &raquo;
        </button>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const blogs = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);
const loading = ref(true);

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Colosseum_of_Rome%2C_Italy.jpg/960px-Colosseum_of_Rome%2C_Italy.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const formatDate = (dateStr) => {
  if (!dateStr) return 'Sep 04, 2026';
  const d = new Date(dateStr);
  return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
};

const fetchBlogs = async (page = 1) => {
  loading.value = true;
  try {
    const res = await fetch(`/api/blogs?page=${page}`);
    const data = await res.json();
    blogs.value = data.blogs?.data || data.blogs || [];
    currentPage.value = data.blogs?.current_page || 1;
    totalPages.value = data.blogs?.last_page || 1;
  } catch (e) {
    console.error('Failed to load blogs', e);
  } finally {
    loading.value = false;
  }
};

const changePage = (p) => {
  currentPage.value = p;
  fetchBlogs(p);
  window.scrollTo({ top: 300, behavior: 'smooth' });
};

onMounted(() => {
  fetchBlogs(1);
});
</script>

<style scoped>
.BlogId-hero {
    position: relative;
    width: 100%;
    height: 420px;
    background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Colosseum_of_Rome%2C_Italy.jpg/960px-Colosseum_of_Rome%2C_Italy.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.BlogId-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.BlogId-hero-content { position: relative; z-index: 2; max-width: 620px; }
.BlogId-title { font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.1; }
.BlogId-subtitle { font-size: 18px; color: rgba(255,255,255,0.85); line-height: 1.6; font-family: 'Mulish', sans-serif; }
.BlogId-wrap { max-width: 1280px; margin: 0 auto; padding: 60px 24px 80px; }
.BlogId-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
@media (max-width: 1024px) { .BlogId-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) { .BlogId-grid { grid-template-columns: 1fr; } .BlogId-title { font-size: 40px; } .BlogId-hero { height: 320px; background-attachment: scroll; } }
@media (max-width: 480px) { .BlogId-hero { height: 240px; } .BlogId-title { font-size: 32px; } .BlogId-subtitle { font-size: 14px; } .BlogId-wrap { padding: 40px 16px 60px; } }
.BlogId-card {
    display: block; background: #fff; border-radius: 16px; overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,.06); text-decoration: none; transition: transform .3s, box-shadow .3s;
}
.BlogId-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.1); }
.BlogId-card-img { height: 194px; overflow: hidden; }
.BlogId-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
.BlogId-card:hover .BlogId-card-img img { transform: scale(1.05); }
.BlogId-card-body { padding: 18px; }
.BlogId-author { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; color: #a58530; text-transform: uppercase; margin-bottom: 7px; display: block; }
.BlogId-card-title { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #0b1623; margin-bottom: 7px; line-height: 1.4; }
.BlogId-card-desc { font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 11px; }
.BlogId-meta { font-size: 12px; color: #6b7280; margin-bottom: 12px; }
.BlogId-read { font-weight: 600; color: #a58530; font-size: 13px; }
.BlogId-pag { display: flex; justify-content: center; gap: 8px; margin-top: 40px; flex-wrap: wrap; }
.BlogId-pag a, .BlogId-pag button, .BlogId-pag span {
    min-width: 40px; height: 40px; padding: 0 12px; display: inline-flex; align-items: center; justify-content: center;
    border: 1.5px solid #e5ddd0; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none; color: #6b7280; background: #fff; cursor: pointer;
}
.BlogId-pag button:hover { border-color: #c8a84e; color: #a58530; }
.BlogId-pag .active { background: #c8a84e; border-color: #c8a84e; color: #0b1623; }
</style>
