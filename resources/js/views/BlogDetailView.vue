<template>
  <div class="blog-detail-view">
    <div v-if="loading" class="text-center py-28">
      <LoadingSpinner />
    </div>

    <div v-else-if="blog">
      <!-- HERO -->
      <section class="blog-hero" :style="{ backgroundImage: 'url(' + getImgUrl(blog.image) + ')' }">
        <div class="blog-hero-content">
          <nav class="blog-crumb">
            <router-link to="/">Home</router-link>
            <span class="dot"></span>
            <router-link to="/blogs">Blog</router-link>
            <span class="dot"></span>
            <span>Article</span>
          </nav>
          <h1>{{ blog.title }}</h1>
          <div class="blog-hero-meta">
            <span class="badge">{{ blog.author || 'Journal' }}</span>
            <span class="m">&#128197; {{ formatDate(blog.created_at) }}</span>
            <span class="m">&#128336; {{ blog.read_time || '5' }} min read</span>
          </div>
        </div>
      </section>

      <!-- MAIN BODY -->
      <div class="blog-body">
        <div class="blog-wrap">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
            <!-- LEFT: Article -->
            <div class="lg:col-span-8">
              <article class="blog-main">
                <p class="blog-lead">{{ blog.short_description }}</p>
                <div class="blog-content" v-html="blog.description"></div>

                <!-- Author -->
                <div class="blog-author">
                  <div class="av">{{ (blog.author || 'N').charAt(0).toUpperCase() }}</div>
                  <div>
                    <div style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Written by</div>
                    <div style="font-size:16px;font-weight:800;color:#0b1623;">{{ blog.author || 'Nice in Rome Tour' }}</div>
                  </div>
                </div>

                <!-- Share -->
                <div class="blog-share">
                  <span>Share</span>
                  <a class="share-btn share-fb" target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl)">
                    <svg width="18" height="18" viewBox="0 0 320 512" fill="currentColor"><path d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"/></svg>
                  </a>
                  <a class="share-btn share-wa" target="_blank" :href="'https://wa.me/?text=' + encodeURIComponent(blog.title + ' ' + currentUrl)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                  </a>
                </div>
              </article>
            </div>

            <!-- RIGHT: Sidebar -->
            <div class="lg:col-span-4">
              <div v-if="recentBlogs.length > 0" class="side-box">
                <h4 class="side-head">Recent Stories</h4>
                <router-link 
                  v-for="r in recentBlogs" 
                  :key="r.id" 
                  :to="'/blog/' + r.slug" 
                  class="recent-item"
                >
                  <img :src="getImgUrl(r.image)" :alt="r.title">
                  <div>
                    <p class="rt">{{ r.title }}</p>
                    <span class="rm">&#128197; {{ formatDate(r.created_at) }}</span>
                  </div>
                </router-link>
              </div>

              <!-- Promo CTA -->
              <div class="cta-box">
                <h3>Explore Rome With Us</h3>
                <p>Book VIP skip-the-line tours with authorized local Roman guides today.</p>
                <router-link to="/tours">Browse Tours &rarr;</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const blog = ref(null);
const recentBlogs = ref([]);
const loading = ref(true);
const currentUrl = ref('');

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

const fetchData = async () => {
  loading.value = true;
  try {
    const slug = route.params.slug;
    const res = await fetch(`/api/blog/${slug}`);
    const data = await res.json();
    blog.value = data.blog;
    recentBlogs.value = data.recent || [];
    currentUrl.value = window.location.href;
  } catch (e) {
    console.error('Failed to load blog post', e);
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
.blog-hero {
    position: relative; width: 100%; min-height: 420px;
    background-size: cover; background-position: center; background-attachment: fixed;
    display: flex; align-items: flex-end; padding: 120px 6% 56px;
}
.blog-hero::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(180deg, rgba(5,12,25,.35) 0%, rgba(5,12,25,.55) 60%, rgba(5,12,25,.9) 100%);
    z-index: 1;
}
.blog-hero-content { position: relative; z-index: 2; max-width: 860px; width: 100%; }
.blog-crumb {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
    color: #c8a84e; text-transform: uppercase; margin-bottom: 18px;
}
.blog-crumb a { color: rgba(255,255,255,.75); text-decoration: none; }
.blog-crumb a:hover { color: #c8a84e; }
.blog-crumb span.dot { width: 5px; height: 5px; border-radius: 50%; background: #c8a84e; display: inline-block; }
.blog-hero h1 {
    font-family:'Cormorant Garamond',serif; font-size: clamp(34px,5.5vw,58px);
    font-weight: 700; color: #fff; line-height: 1.08; margin: 0 0 18px; text-shadow: 0 2px 20px rgba(0,0,0,.5);
}
.blog-hero-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 16px; color: rgba(255,255,255,.85); font-size: 13.5px; }
.blog-hero-meta .m { display: inline-flex; align-items: center; gap: 7px; }
.blog-hero-meta .badge { background: rgba(200,168,78,.16); border: 1px solid rgba(200,168,78,.4); color: #c8a84e; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
.blog-wrap { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.blog-body { padding: 60px 0 80px; }
.blog-main {
    background: #fff; border: 1px solid #eef0f3; border-radius: 24px; padding: 44px 48px;
    box-shadow: 0 10px 40px rgba(0,0,0,.05);
}
.blog-lead { font-size: 18px; color: #1a2d45; font-weight: 500; line-height: 1.8; margin-bottom: 28px; }
.blog-content { font-size: 16px; color: #444c58; line-height: 1.9; }
.blog-content h1,.blog-content h2,.blog-content h3,.blog-content h4 {
    font-family:'Cormorant Garamond',serif; color: #0b1623; font-weight: 700; line-height: 1.25; margin: 34px 0 14px;
}
.blog-content h2 { font-size: 30px; }
.blog-content h3 { font-size: 24px; }
.blog-content p { margin: 0 0 20px; }
.blog-content img { max-width: 100%; border-radius: 16px; margin: 22px 0; }
.blog-content ul,.blog-content ol { margin: 0 0 22px; padding-left: 24px; }
.blog-content li { margin-bottom: 9px; }
.blog-content a { color: #a58530; text-decoration: underline; }
.blog-author {
    display: flex; align-items: center; gap: 16px; margin-top: 40px; padding-top: 30px;
    border-top: 1px solid #f0f1f3;
}
.blog-author .av {
    width: 56px; height: 56px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg,#c8a84e,#a58530); color: #fff;
    display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;
}
.blog-share { display: flex; align-items: center; gap: 10px; margin-top: 30px; padding-top: 24px; border-top: 1px solid #f0f1f3; flex-wrap: wrap; }
.blog-share span { font-size: 13px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 1px; margin-right: 6px; }
.share-btn {
    width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; transition: all .3s; text-decoration: none;
}
.share-btn:hover { transform: translateY(-3px); }
.share-fb { background: #1877F2; } .share-wa { background: #25D366; }
.side-head { font-family:'Cormorant Garamond',serif; font-size: 22px; font-weight: 700; color: #0b1623; margin: 0 0 18px; }
.side-box { background: #fff; border: 1px solid #eef0f3; border-radius: 18px; padding: 24px; box-shadow: 0 6px 24px rgba(0,0,0,.05); margin-bottom: 24px; }
.recent-item { display: flex; gap: 14px; padding: 11px 0; border-bottom: 1px dashed #eef0f3; text-decoration: none; }
.recent-item:last-child { border-bottom: none; }
.recent-item img { width: 74px; height: 60px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
.recent-item .rt { font-size: 14px; font-weight: 700; color: #0b1623; line-height: 1.4; margin: 0 0 4px; transition: color .2s; }
.recent-item:hover .rt { color: #a58530; }
.recent-item .rm { font-size: 12px; color: #9ca3af; }
.cta-box {
    background: linear-gradient(135deg,#0b1623,#1a2d45); border-radius: 20px; padding: 32px; color: #fff;
    box-shadow: 0 16px 50px rgba(11,22,35,.3); position: relative; overflow: hidden;
}
.cta-box h3 { font-family:'Cormorant Garamond',serif; font-size: 26px; margin: 0 0 8px; position: relative; z-index: 2; }
.cta-box p { font-size: 14px; color: rgba(255,255,255,.75); margin: 0 0 18px; position: relative; z-index: 2; }
.cta-box a { position: relative; z-index: 2; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg,#c8a84e,#a58530); color: #0b1623; font-weight: 800; font-size: 14px; text-decoration: none; padding: 13px 24px; border-radius: 11px; transition: all .3s; }

@media (max-width: 768px) {
    .blog-hero { background-attachment: scroll; padding: 96px 5% 44px; }
    .blog-body { padding: 44px 0 64px; }
    .blog-wrap { padding: 0 18px; }
    .blog-hero-meta { gap: 10px; font-size: 12.5px; }
}
@media (max-width: 480px) {
    .blog-hero { min-height: 360px; padding: 84px 5% 36px; }
    .blog-hero h1 { font-size: 30px; line-height: 1.15; margin-bottom: 14px; }
    .blog-crumb { flex-wrap: wrap; gap: 6px; font-size: 11px; margin-bottom: 14px; }
    .blog-wrap { padding: 0 16px; }
    .blog-body { padding: 32px 0 52px; }
    .blog-main { padding: 28px 20px; }
    .blog-lead { font-size: 16px; line-height: 1.7; }
    .blog-content { font-size: 15.5px; line-height: 1.85; }
    .blog-content h1,.blog-content h2,.blog-content h3,.blog-content h4 { margin: 26px 0 12px; }
    .blog-content h2 { font-size: 25px; }
    .blog-content h3 { font-size: 21px; }
    .blog-author { margin-top: 28px; padding-top: 24px; gap: 14px; }
    .blog-share { margin-top: 24px; padding-top: 20px; }
    .side-box { padding: 20px; }
    .recent-item { gap: 12px; }
    .recent-item img { width: 64px; height: 52px; }
    .cta-box { padding: 24px; }
    .cta-box a { width: 100%; justify-content: center; text-align: center; }
}
</style>
