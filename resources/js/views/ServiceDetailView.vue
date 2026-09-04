<template>
  <div class="service-detail-page">
    <div v-if="loading" class="text-center py-28">
      <LoadingSpinner />
    </div>

    <div v-else-if="service">
      <!-- HERO -->
      <section class="service-hero" :style="{ backgroundImage: 'url(' + getImgUrl(service.image) + ')' }">
        <div class="service-hero-content">
          <div class="service-breadcrumb">
            <router-link to="/">Home</router-link>
            <span class="dot"></span>
            <router-link to="/our-services">Services</router-link>
            <span class="dot"></span>
            <span>{{ service.name || service.title }}</span>
          </div>
          <div class="service-hero-icon" v-html="service.icon || '&#10024;'"></div>
          <h1 class="service-hero-title">{{ service.name || service.title }}</h1>
          <p class="service-hero-desc">{{ service.short_description || service.description }}</p>
        </div>
      </section>

      <!-- BODY -->
      <div class="service-wrap service-body">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
          
          <!-- LEFT CONTENT -->
          <div class="lg:col-span-8">
            <div class="service-card">
              <div class="service-content w-full">
                <div class="service-label">Premium Concierge</div>
                <h2>{{ service.name || service.title }}</h2>
                <div class="gold-line"></div>
                <div class="rich" v-html="service.description || service.long_description"></div>

                <!-- Benefits -->
                <div class="service-benefits">
                  <div class="service-benefit">
                    <span class="tick">&#10003;</span>
                    <span>24/7 WhatsApp Support</span>
                  </div>
                  <div class="service-benefit">
                    <span class="tick">&#10003;</span>
                    <span>English-Speaking Team</span>
                  </div>
                  <div class="service-benefit">
                    <span class="tick">&#10003;</span>
                    <span>Transparent Pricing</span>
                  </div>
                  <div class="service-benefit">
                    <span class="tick">&#10003;</span>
                    <span>Instant Confirmation</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- RIGHT SIDEBAR -->
          <div class="lg:col-span-4">
            <div class="service-cta">
              <h3>Book This Service</h3>
              <p>Contact our concierge team directly via WhatsApp for instant booking and custom quotes.</p>
              <a :href="appStore.waLink('Hi! I would like to book the ' + (service.name || service.title) + ' service.')" target="_blank" class="wa-btn">
                <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                Inquire on WhatsApp
              </a>
            </div>

            <div class="service-contact">
              <h4>Contact Concierge</h4>
              <div class="service-contact-item">
                <div class="ic">&#128222;</div>
                <div>
                  <div class="t">Phone</div>
                  <div class="v">{{ appStore.company?.phone || '+39 06 1234 5678' }}</div>
                </div>
              </div>
              <div class="service-contact-item">
                <div class="ic">&#9993;</div>
                <div>
                  <div class="t">Email</div>
                  <div class="v">{{ appStore.company?.email || 'hello@niceinrometour.com' }}</div>
                </div>
              </div>
              <div class="service-contact-item">
                <div class="ic">&#128172;</div>
                <div>
                  <div class="t">WhatsApp</div>
                  <div class="v">{{ appStore.company?.whatsapp || '+39 333 123 4567' }}</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- OTHER SERVICES -->
      <section v-if="otherServices.length > 0" class="other-services">
        <div class="service-wrap">
          <div class="other-services-head">
            <p>More Concierge Services</p>
            <h2>Explore Other Experiences</h2>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <router-link 
              v-for="os in otherServices" 
              :key="os.id" 
              :to="'/service/' + os.slug" 
              class="other-card"
            >
              <div class="other-card-img">
                <img :src="getImgUrl(os.image)" :alt="os.name || os.title">
                <div class="other-card-ic" v-html="os.icon || '&#10024;'"></div>
              </div>
              <div class="other-card-body">
                <h3>{{ os.name || os.title }}</h3>
                <p>{{ os.short_description || os.description }}</p>
                <span class="more">Learn More &rarr;</span>
              </div>
            </router-link>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();
const route = useRoute();

const service = ref(null);
const otherServices = ref([]);
const loading = ref(true);

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const fetchData = async () => {
  loading.value = true;
  try {
    const slug = route.params.slug;
    const res = await fetch(`/api/service/${slug}`);
    const data = await res.json();
    service.value = data.service;
    otherServices.value = data.services || [];
  } catch (e) {
    console.error('Failed to load service detail', e);
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
.service-hero {
    position: relative;
    width: 100%;
    min-height: 420px;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    padding: 110px 6% 60px;
}
.service-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(5,12,25,.92) 0%, rgba(5,12,25,.6) 45%, rgba(5,12,25,.35) 100%);
    z-index: 1;
}
.service-hero-content { position: relative; z-index: 2; max-width: 720px; }
.service-breadcrumb {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12.5px; font-weight: 600; letter-spacing: .5px;
    color: rgba(255,255,255,.7); text-transform: uppercase; margin-bottom: 20px;
}
.service-breadcrumb a { color: #c8a84e; text-decoration: none; }
.service-breadcrumb span.dot { width: 5px; height: 5px; border-radius: 50%; background: #c8a84e; display: inline-block; }
.service-hero-icon {
    width: 64px; height: 64px; border-radius: 16px;
    background: linear-gradient(135deg,#c8a84e,#a58530);
    display: flex; align-items: center; justify-content: center;
    font-size: 30px; margin-bottom: 20px;
    box-shadow: 0 8px 28px rgba(200,168,78,.45);
}
.service-hero-title {
    font-family:'Cormorant Garamond',serif; font-size: clamp(40px,6vw,60px);
    font-weight: 700; color: #fff; line-height: 1.05; margin-bottom: 16px;
    text-shadow: 0 2px 24px rgba(0,0,0,.5);
}
.service-hero-desc { font-size: 16px; color: rgba(255,255,255,.88); line-height: 1.7; max-width: 560px; }
.service-wrap { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
.service-body { padding: 70px 0 40px; }
.service-card {
    background: #fff; border: 1px solid #eef0f3; border-radius: 22px;
    padding: 28px; display: flex; gap: 28px;
    box-shadow: 0 10px 40px rgba(0,0,0,.06);
}
.service-content { flex: 1; }
.service-label {
    font-size: 11px; font-weight: 800; letter-spacing: 3px; color: #c8a84e;
    text-transform: uppercase; margin-bottom: 12px;
}
.service-content h2 {
    font-family:'Cormorant Garamond',serif; font-size: clamp(24px,3vw,34px);
    font-weight: 700; color: #0b1623; margin: 0 0 4px; line-height: 1.15;
}
.service-content .gold-line { width: 50px; height: 3px; background: #c8a84e; border-radius: 3px; margin-bottom: 20px; }
.service-content .rich { font-size: 15px; color: #4b5563; line-height: 1.85; }
.service-benefits {
    display: grid; grid-template-columns: repeat(2,1fr); gap: 12px; margin-top: 26px;
}
.service-benefit {
    display: flex; align-items: center; gap: 11px;
    background: #f4efe6; border: 1px solid #ecdfc8;
    border-radius: 12px; padding: 12px 15px; font-size: 14px; font-weight: 600; color: #0b1623;
}
.service-benefit .tick {
    width: 24px; height: 24px; border-radius: 50%; background: #c8a84e;
    color: #0b1623; display: flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0;
}
.service-cta {
    background: linear-gradient(135deg,#0b1623,#1a2d45);
    border-radius: 22px; padding: 34px; color: #fff;
    box-shadow: 0 16px 50px rgba(11,22,35,.35); position: relative; overflow: hidden; margin-bottom: 24px;
}
.service-cta h3 { font-family:'Cormorant Garamond',serif; font-size: 30px; margin: 0 0 8px; position: relative; z-index: 2; }
.service-cta p { font-size: 14.5px; color: rgba(255,255,255,.75); line-height: 1.7; margin: 0 0 22px; position: relative; z-index: 2; }
.service-cta .wa-btn {
    display: inline-flex; align-items: center; gap: 10px;
    background: #25d366; color: #fff; text-decoration: none; font-weight: 700; font-size: 14px;
    padding: 15px 28px; border-radius: 12px; transition: all .3s; position: relative; z-index: 2;
    box-shadow: 0 6px 20px rgba(37,211,102,.35);
}
.service-cta .wa-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(37,211,102,.5); }
.service-contact {
    background: #fff; border: 1px solid #eef0f3; border-radius: 22px; padding: 26px;
    box-shadow: 0 10px 40px rgba(0,0,0,.04);
}
.service-contact h4 { font-family:'Cormorant Garamond',serif; font-size: 20px; color: #0b1623; margin: 0 0 18px; }
.service-contact-item { display: flex; align-items: center; gap: 13px; padding: 11px 0; border-bottom: 1px dashed #eef0f3; }
.service-contact-item:last-child { border-bottom: none; }
.service-contact-item .ic {
    width: 40px; height: 40px; border-radius: 11px; background: #f4efe6;
    color: #a58530; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.service-contact-item .t { font-size: 12px; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.service-contact-item .v { font-size: 14px; font-weight: 700; color: #0b1623; text-decoration: none; }
.other-services { padding: 70px 0; background: #fcfaf5; border-top: 1px solid #efe7d5; }
.other-services-head { text-align: center; max-width: 640px; margin: 0 auto 40px; }
.other-services-head p { font-size: 11px; font-weight: 800; letter-spacing: 3px; color: #c8a84e; text-transform: uppercase; margin: 0 0 10px; }
.other-services-head h2 { font-family:'Cormorant Garamond',serif; font-size: clamp(28px,4vw,40px); color: #0b1623; font-weight: 700; margin: 0; }
.other-card {
    background: #fff; border: 1px solid #eef0f3; border-radius: 18px; overflow: hidden; cursor: pointer;
    text-decoration: none; display: block; transition: all .35s;
    box-shadow: 0 6px 24px rgba(0,0,0,.05);
}
.other-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.12); }
.other-card-img { height: 170px; overflow: hidden; position: relative; }
.other-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s; }
.other-card:hover .other-card-img img { transform: scale(1.08); }
.other-card-img::after { content:''; position:absolute; inset:0; background: linear-gradient(to top, rgba(11,22,35,.55), transparent); }
.other-card-ic {
    position: absolute; left: 14px; bottom: -18px; width: 42px; height: 42px; border-radius: 12px;
    background: linear-gradient(135deg,#c8a84e,#a58530); display: flex; align-items: center; justify-content: center;
    font-size: 20px; z-index: 2; box-shadow: 0 6px 18px rgba(200,168,78,.45);
}
.other-card-body { padding: 26px 18px 20px; }
.other-card-body h3 { font-family:'Cormorant Garamond',serif; font-size: 19px; color: #0b1623; font-weight: 700; margin: 0 0 7px; }
.other-card-body p { font-size: 13px; color: #6b7280; line-height: 1.6; margin: 0 0 12px; min-height: 40px; }
.other-card-body .more { font-size: 13px; font-weight: 700; color: #a58530; }
@media (max-width: 768px) {
    .service-hero { min-height: 360px; padding: 80px 5% 40px; background-attachment: scroll; }
    .service-hero-icon { width: 50px; height: 50px; font-size: 24px; }
    .service-body { padding: 40px 0 24px; }
    .service-card { padding: 20px; gap: 20px; border-radius: 16px; }
    .service-cta { padding: 26px; border-radius: 16px; }
    .service-contact { padding: 20px; border-radius: 16px; }
    .other-services { padding: 40px 0; }
    .other-card-img { height: 150px; }
    .other-card-body { padding: 20px 16px 16px; }
}
@media (max-width: 480px) {
    .service-hero { min-height: 300px; padding: 70px 4% 30px; }
    .service-breadcrumb { font-size: 11px; flex-wrap: wrap; }
    .service-hero-icon { width: 44px; height: 44px; font-size: 20px; border-radius: 12px; }
    .service-hero-desc { font-size: 14px; }
    .service-body { padding: 28px 0 16px; }
    .service-card { padding: 16px; gap: 14px; }
    .service-content h2 { font-size: 22px; }
    .service-content .rich { font-size: 14px; }
    .service-benefits { grid-template-columns: 1fr; gap: 8px; }
    .service-cta { padding: 22px; }
    .service-cta h3 { font-size: 24px; }
    .service-cta .wa-btn { padding: 13px 22px; font-size: 13px; width: 100%; justify-content: center; }
    .service-contact { padding: 18px; }
    .other-services { padding: 28px 0; }
    .other-card-img { height: 130px; }
    .other-card-body h3 { font-size: 17px; }
    .other-card-body p { min-height: auto; }
}
</style>
