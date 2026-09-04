<template>
  <div>
    <!-- PREMIUM NAVBAR -->
    <nav id="mainNav" :class="{ scrolled: isScrolled, 'nav-hidden': isHidden }">
      <div class="nav-inner">

        <!-- Logo -->
        <router-link to="/" class="nav-logo" :aria-label="(company?.com_name || 'Journey With Mr. J') + ' Home'">
          <img v-if="company?.logo" :src="'/' + company.logo.replace(/^\//, '')" :alt="company?.com_name" style="height: 30px; border-radius: 6px; object-fit: contain;">
          <div v-else class="nav-logo-badge">
            <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
              <circle cx="20" cy="20" r="18" stroke="rgba(255,255,255,0.7)" stroke-width="2"/>
              <text x="20" y="27" text-anchor="middle" font-family="Cormorant Garamond,serif" font-size="18" font-weight="800" fill="#fff">MJ</text>
            </svg>
          </div>
          <div class="nav-logo-text">
            <span class="nav-logo-title" style="text-transform: uppercase;">{{ company?.com_name || 'JOURNEY WITH MR. J' }}</span>
          </div>
        </router-link>

        <!-- Desktop Nav Links -->
        <ul class="nav-links" id="navLinks">
          <li><router-link to="/" active-class="nav-active" id="navHome">Home</router-link></li>
          <li><router-link to="/about" active-class="nav-active" id="navAbout">About Us</router-link></li>
          <li class="nav-dropdown">
            <router-link to="/all-destinations" id="navDestinations" style="display:flex; align-items:center; gap:4px;">
              Destinations
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
            </router-link>
            <div class="dropdown-menu mega-menu">
              <router-link 
                v-for="d in destinations" 
                :key="d.id" 
                :to="'/destination/' + d.slug" 
                class="mega-menu-item"
              >
                <img :src="d.image ? '/' + d.image.replace(/^\//, '') : 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg'" :alt="d.name" class="mega-img">
                <div class="mega-text">
                  <span class="mega-title">{{ d.name }}</span>
                  <span class="mega-subtitle">Explore Tours &rarr;</span>
                </div>
              </router-link>
            </div>
          </li>
          <li class="nav-dropdown">
            <router-link to="/tours" id="navTours" style="display:flex; align-items:center; gap:4px;">
              Tours
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
            </router-link>
            <div class="dropdown-menu mega-menu">
              <router-link 
                v-for="cat in categories" 
                :key="cat.id" 
                :to="'/category/' + cat.slug" 
                class="mega-menu-item"
              >
                <img :src="cat.image ? '/' + cat.image.replace(/^\//, '') : 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg'" :alt="cat.name" class="mega-img">
                <div class="mega-text">
                  <span class="mega-title" style="font-size: 14px; line-height: 1.3; margin-bottom: 6px;">{{ cat.name }}</span>
                  <span class="mega-subtitle" style="font-size: 11px;">Explore Tours &rarr;</span>
                </div>
              </router-link>
            </div>
          </li>
          <li><router-link to="/tickets" id="navTickets">Tickets</router-link></li>
          <li><router-link to="/our-services" id="navServices">Services</router-link></li>
          <li><router-link to="/contact-us" id="navContact">Contact Us</router-link></li>
        </ul>

        <!-- Right Side Actions -->
        <div class="nav-divider"></div>
        <div class="nav-actions">

          <!-- Search -->
          <button class="nav-search-btn" aria-label="Search tours" @click="toggleSearch">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          </button>

          <!-- Language -->
          <div class="nav-translate" id="navTranslate">
            <button class="nav-translate-btn" type="button" @click.stop="toggleLang" aria-haspopup="true" :aria-expanded="isLangOpen">
              <span class="nav-translate-label">{{ currentLangName }}</span>
              <svg class="lang-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="lang-menu" :class="{ open: isLangOpen }" @click.stop>
              <input type="text" v-model="langSearchQuery" class="lang-search" placeholder="Search language..." autocomplete="off"/>
              <div class="lang-list">
                <button 
                  v-for="l in filteredLanguages" 
                  :key="l[0]" 
                  type="button" 
                  class="lang-opt" 
                  :data-code="l[0]"
                  @click="selectLang(l[0], l[1])"
                >
                  {{ l[1] }}
                </button>
                <div v-if="filteredLanguages.length === 0" class="lang-empty">No language found</div>
              </div>
            </div>
            <div id="google_translate_element" class="gt-widget"></div>
          </div>

          <!-- Wishlist -->
          <router-link to="/tours" class="nav-action-btn nav-wishlist-btn" aria-label="Wishlist">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            <span class="nav-badge" style="background:#ef4444; color:#fff; border-color:#fff;">{{ appStore.wishlistCount }}</span>
          </router-link>

          <!-- Cart -->
          <button class="nav-action-btn nav-cart-btn" aria-label="Shopping cart" @click="goToCart()">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <circle cx="9" cy="21" r="1.5"></circle>
              <circle cx="20" cy="21" r="1.5"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="nav-badge" style="background:#d6a848; color:#111827; border-color:#1c1e27;">{{ appStore.cartCount }}</span>
          </button>
          <a href="#" @click.prevent="openChatWithMax" class="nav-action-btn nav-account-avatar" aria-label="My Account" style="display:flex; align-items:center; gap:6px; padding:0 12px; width:auto; border-radius:20px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span style="font-size:14px; font-weight:600;">Max</span>
          </a>

          <!-- Mobile Menu Toggle -->
          <button class="nav-ham" :class="{ open: isMobileMenuOpen }" id="navHam" aria-label="Open menu" @click="toggleMobileMenu">
            <svg class="ham-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="4" y1="7" x2="20" y2="7"></line>
              <line x1="10" y1="12" x2="20" y2="12"></line>
              <line x1="6" y1="17" x2="20" y2="17"></line>
            </svg>
            <svg class="close-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
      </div>
    </nav>

    <!-- Header Search Overlay & Dropdown -->
    <div class="nav-search-overlay" :class="{ open: isSearchOpen }" @click="toggleSearch"></div>
    <div class="nav-search-dropdown" :class="{ open: isSearchOpen }">
      <button class="nav-search-close" @click="toggleSearch" aria-label="Close search">&#10005;</button>
      <div class="nav-search-inner">
        <div class="nav-search-input-wrap">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          <input 
            type="text" 
            class="nav-search-input" 
            id="navSearchInput" 
            placeholder="Search tours, destinations, experiences..." 
            v-model="searchInput"
            @keydown.enter="handleSearchSubmit"
            autocomplete="off"
            ref="searchInputRef"
          />
        </div>
        <div class="nav-search-suggestions">
          <button class="nav-search-tag" @click="fillSearch('Colosseum')">Colosseum</button>
          <button class="nav-search-tag" @click="fillSearch('Vatican')">Vatican</button>
          <button class="nav-search-tag" @click="fillSearch('Roman Forum')">Roman Forum</button>
          <button class="nav-search-tag" @click="fillSearch('Trevi Fountain')">Trevi Fountain</button>
          <button class="nav-search-tag" @click="fillSearch('Golf Cart')">Golf Cart</button>
          <button class="nav-search-tag" @click="fillSearch('St. Peter\'s')">St. Peter's</button>
        </div>
      </div>
    </div>

    <!-- Mobile Drawer -->
    <div class="nav-mobile-drawer" :class="{ open: isMobileMenuOpen }" id="navMobileDrawer">
      <button class="nav-mobile-drawer-close" @click="closeMobileMenu" aria-label="Close menu">&#10005;</button>
      <router-link to="/" @click="closeMobileMenu">Home</router-link>
      <router-link to="/about" @click="closeMobileMenu">About Us</router-link>
      <router-link to="/all-destinations" @click="closeMobileMenu">Destinations</router-link>
      <router-link to="/tours" @click="closeMobileMenu">Tours</router-link>
      <router-link to="/tickets" @click="closeMobileMenu">Tickets</router-link>
      <router-link to="/our-services" @click="closeMobileMenu">Services</router-link>
      <router-link to="/contact-us" @click="closeMobileMenu">Contact Us</router-link>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();
const router = useRouter();
const route = useRoute();

const isScrolled = ref(false);
const isHidden = ref(false);
const isMobileMenuOpen = ref(false);
const isSearchOpen = ref(false);
const isLangOpen = ref(false);
const searchInput = ref('');
const langSearchQuery = ref('');
const searchInputRef = ref(null);
const currentLangName = ref('Select Language');

let lastScrollY = 0;

const company = computed(() => appStore.company);
const destinations = computed(() => appStore.home?.destinations || []);
const categories = computed(() => appStore.home?.homeCategories?.slice(0, 6) || []);

const LANG_LIST = [
  ['en','English'],['af','Afrikaans'],['sq','Shqip (Albanian)'],['am','አማርኛ (Amharic)'],['ar','العربية (Arabic)'],
  ['hy','Հայերեն (Armenian)'],['az','Azərbaycan (Azerbaijani)'],['eu','Euskara (Basque)'],['be','Беларуская (Belarusian)'],
  ['bn','বাংলা (Bengali)'],['bs','Bosanski (Bosnian)'],['bg','Български (Bulgarian)'],['ca','Català (Catalan)'],
  ['zh-CN','中文 (Chinese Simplified)'],['zh-TW','中文 (Chinese Traditional)'],['co','Corsican'],['hr','Hrvatski (Croatian)'],
  ['cs','Čeština (Czech)'],['da','Dansk (Danish)'],['nl','Nederlands (Dutch)'],['eo','Esperanto'],['et','Eesti (Estonian)'],
  ['tl','Filipino'],['fi','Suomi (Finnish)'],['fr','Français (French)'],['fy','Frisian'],['gl','Galego (Galician)'],
  ['ka','ქართული (Georgian)'],['de','Deutsch (German)'],['el','Ελληνικά (Greek)'],['gu','ગુજરાતી (Gujarati)'],
  ['ht','Kreyòl (Haitian Creole)'],['ha','Hausa'],['he','עברית (Hebrew)'],['hi','हिन्दी (Hindi)'],['hu','Magyar (Hungarian)'],
  ['is','Íslenska (Icelandic)'],['ig','Igbo'],['id','Bahasa Indonesia'],['ga','Gaeilge (Irish)'],['it','Italiano (Italian)'],
  ['ja','日本語 (Japanese)'],['jv','Javanese'],['kn','ಕನ್ನಡ (Kannada)'],['kk','Қазақ (Kazakh)'],['km','ខ្មែរ (Khmer)'],
  ['rw','Kinyarwanda'],['ko','한국어 (Korean)'],['ku','Kurdish'],['ky','Kyrgyz'],['lo','ລາວ (Lao)'],['lv','Latviešu (Latvian)'],
  ['lt','Lietuvių (Lithuanian)'],['lb','Lëtzebuergesch (Luxembourgish)'],['mk','Македонски (Macedonian)'],['mg','Malagasy'],
  ['ms','Bahasa Melayu'],['ml','മലയാളം (Malayalam)'],['mt','Malti (Maltese)'],['mi','Māori'],['mr','मराठी (Marathi)'],
  ['mn','Mongolian'],['my','မြန်မာ (Myanmar)'],['ne','नेपाली (Nepali)'],['no','Norsk (Norwegian)'],['or','ଓଡ଼ିଆ (Odia)'],
  ['ps','Pashto'],['fa','فارسی (Persian)'],['pl','Polski (Polish)'],['pt','Português (Portuguese)'],['pa','ਪੰਜਾਬੀ (Punjabi)'],
  ['ro','Română (Romanian)'],['ru','Русский (Russian)'],['sm','Samoan'],['gd','Gàidhlig (Scottish Gaelic)'],['sr','Srpski (Serbian)'],
  ['st','Sesotho'],['sn','Shona'],['sd','Sindhi'],['si','සිංහල (Sinhala)'],['sk','Slovenčina (Slovak)'],
  ['sl','Slovenščina (Slovenian)'],['so','Somali'],['es','Español (Spanish)'],['su','Sundanese'],['sw','Kiswahili (Swahili)'],
  ['sv','Svenska (Swedish)'],['tg','Tajik'],['ta','தமிழ் (Tamil)'],['tt','Tatar'],['te','తెలుగు (Telugu)'],['th','ไทย (Thai)'],
  ['tr','Türkçe (Turkish)'],['tk','Turkmen'],['uk','Українська (Ukrainian)'],['ur','اردو (Urdu)'],['ug','Uyghur'],
  ['uz','O‘zbek (Uzbek)'],['vi','Tiếng Việt (Vietnamese)'],['cy','Cymraeg (Welsh)'],['xh','Xhosa'],['yi','ייִדיש (Yiddish)'],
  ['yo','Yoruba'],['zu','Zulu']
];

const filteredLanguages = computed(() => {
  const q = langSearchQuery.value.trim().toLowerCase();
  if (!q) return LANG_LIST;
  return LANG_LIST.filter(l => l[1].toLowerCase().includes(q) || l[0].toLowerCase().includes(q));
});

const handleScroll = () => {
  const currentY = window.scrollY;
  isScrolled.value = currentY > 30;
  if (currentY > 200 && currentY > lastScrollY) {
    isHidden.value = true;
  } else {
    isHidden.value = false;
  }
  lastScrollY = currentY;
};

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  document.body.style.overflow = isMobileMenuOpen.value ? 'hidden' : '';
};

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false;
  document.body.style.overflow = '';
};

const toggleSearch = () => {
  isSearchOpen.value = !isSearchOpen.value;
  if (isSearchOpen.value) {
    document.body.style.overflow = 'hidden';
    nextTick(() => {
      searchInputRef.value?.focus();
    });
  } else {
    document.body.style.overflow = '';
  }
};

const toggleLang = () => {
  isLangOpen.value = !isLangOpen.value;
};

const selectLang = (code, name) => {
  currentLangName.value = name;
  appStore.setLang(code);
  isLangOpen.value = false;
};

const fillSearch = (tag) => {
  searchInput.value = tag;
  handleSearchSubmit();
};

const handleSearchSubmit = () => {
  const q = searchInput.value.trim();
  isSearchOpen.value = false;
  document.body.style.overflow = '';
  if (q) {
    router.push({ path: '/tours', query: { search: q } });
  }
};

const scrollToSection = (sectionId) => {
  if (route.path !== '/') {
    router.push({ path: '/', hash: '#' + sectionId });
  } else {
    const el = document.getElementById(sectionId);
    if (el) {
      el.scrollIntoView({ behavior: 'smooth' });
    }
  }
};

const openChatWithMax = () => {
  if (window.toggleChatbot) {
    window.toggleChatbot();
  }
};

const goToCart = () => {
  router.push('/cart');
};

watch(() => route.fullPath, () => {
  closeMobileMenu();
  isSearchOpen.value = false;
  isLangOpen.value = false;
  appStore.closeCart();
  document.body.style.overflow = '';
});

const handleClickOutside = (e) => {
  if (!e.target.closest('.nav-translate')) {
    isLangOpen.value = false;
  }
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true });
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  document.removeEventListener('click', handleClickOutside);
});
</script>
