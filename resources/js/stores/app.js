import { defineStore } from 'pinia';

const loadCart = () => {
  try {
    return JSON.parse(localStorage.getItem('nirt_cart') || '[]');
  } catch (e) {
    return [];
  }
};

export const PRICE_RULE = {
  adult: 1,
  youth: 0.89,
  child: 0.70,
  infant: 0,
};

export const CATEGORY_KEYS = ['adult', 'youth', 'child', 'infant'];

const catValue = (item, key) => Number(item?.travelers?.[key]) || 0;

export const useAppStore = defineStore('app', {
  state: () => ({
    company: window.__NIRT__?.company || null,
    home: null,
    loading: false,
    loaded: false,
    wishlist: JSON.parse(localStorage.getItem('nirt_wishlist') || '[]'),
    cart: loadCart(),
    cartOpen: false,
    toast: null,
    toastTimer: null,
    searchQuery: '',
    currentLang: localStorage.getItem('nirt_lang') || 'en',
  }),
  getters: {
    whatsappNumber: (state) => {
      const num = state.company?.whatsapp || '1234567890';
      return String(num).replace(/[^0-9]/g, '');
    },
    companyName: (state) => {
      return state.company?.com_name || 'JOURNEY WITH MR. J';
    },
    companyLogo: (state) => {
      return state.company?.logo ? '/' + state.company.logo.replace(/^\//, '') : '';
    },
    wishlistCount: (state) => state.wishlist.length,
    cartCount: (state) => state.cart.length,
    cartTotal: (state) => {
      const base = (item) => Number(item.price) || 0;
      return state.cart.reduce((sum, item) => {
        let total = 0;
        CATEGORY_KEYS.forEach((key) => {
          total += base(item) * (PRICE_RULE[key] || 0) * catValue(item, key);
        });
        return sum + (Math.round(total * 100) / 100);
      }, 0);
    },
    titleCount: (state) => {
      const rows = state.cart.reduce((sum, item) => {
        return sum + catValue(item, 'adult') + catValue(item, 'youth') + catValue(item, 'child') + catValue(item, 'infant');
      }, 0);
      return rows || state.cart.reduce((s, i) => s + 1, 0) || 1;
    },
  },
  actions: {
    async loadCompany() {
      if (this.company) return this.company;
      try {
        const res = await fetch('/api/company');
        const data = await res.json();
        this.company = data.company;
      } catch (e) {
        console.error('Failed to load company info', e);
      }
      return this.company;
    },
    async loadHome(force = false) {
      if (this.home && !force) return this.home;
      this.loading = true;
      try {
        const res = await fetch('/api/home');
        this.home = await res.json();
        if (this.home.company) {
          this.company = this.home.company;
        }
        this.loaded = true;
      } catch (e) {
        console.error('Failed to load home data', e);
      } finally {
        this.loading = false;
      }
      return this.home;
    },
    persistCart() {
      localStorage.setItem('nirt_cart', JSON.stringify(this.cart));
    },
    itemTotal(item) {
      const base = Number(item.price) || 0;
      let total = 0;
      CATEGORY_KEYS.forEach((key) => {
        total += base * (PRICE_RULE[key] || 0) * catValue(item, key);
      });
      return Math.round(total * 100) / 100;
    },
    cartLine(item) {
      const base = Number(item.price) || 0;
      const parts = CATEGORY_KEYS.map((key, i) => {
        const n = catValue(item, key);
        if (!n) return null;
        const price = Math.round(base * (PRICE_RULE[key] || 0) * 100) / 100;
        const name = ['Adults', 'Youth', 'Children', 'Infants'][i];
        return `${name}: ${n} ×€${price}`;
      }).filter(Boolean);
      return parts.join(' · ');
    },
    addToCart(tour, options = {}) {
      const id = String(tour.id);
      const base = Number(tour.price) || 0;
      const existing = this.cart.find(item => String(item.id) === id);
      const travelers = options.travelers || { adult: 1, youth: 0, child: 0, infant: 0 };
      if (existing) {
        if (options.update) {
          if (options.date !== undefined) existing.date = options.date;
          if (options.time !== undefined) existing.time = options.time;
          if (options.language !== undefined) existing.language = options.language;
          if (options.travelers) existing.travelers = { adult: 1, youth: 0, child: 0, infant: 0, ...options.travelers };
          this.persistCart();
          return 'updated';
        }
        return 'exists';
      } else {
        this.cart.push({
          id: id,
          slug: tour.slug,
          name: tour.name,
          price: base,
          image: tour.image || '',
          badge: tour.badge_type || '',
          duration: tour.duration || '',
          language: options.language || 'English',
          date: options.date || '',
          time: options.time || '',
          travelers: { adult: 1, youth: 0, child: 0, infant: 0, ...travelers },
        });
      }
      this.persistCart();
      this.cartOpen = true;
      return 'added';
    },
    notify(message, type = 'success') {
      if (this.toastTimer) clearTimeout(this.toastTimer);
      this.toast = { message, type };
      this.toastTimer = setTimeout(() => {
        this.toast = null;
      }, 3000);
    },
    removeFromCart(tourId) {
      const id = String(tourId);
      this.cart = this.cart.filter(item => String(item.id) !== id);
      this.persistCart();
    },
    setTraveler(tourId, key, value) {
      const item = this.cart.find(i => String(i.id) === String(tourId));
      if (!item) return;
      if (!item.travelers) item.travelers = { adult: 1, youth: 0, child: 0, infant: 0 };
      item.travelers[key] = Math.max(0, value);
      this.persistCart();
    },
    setCartItemField(tourId, field, value) {
      const item = this.cart.find(i => String(i.id) === String(tourId));
      if (!item) return;
      item[field] = value;
      this.persistCart();
    },
    setCartDate(date) {
      this.cart.forEach((item) => { item.date = date; });
      this.persistCart();
    },
    setCartTime(time) {
      this.cart.forEach((item) => { item.time = time; });
      this.persistCart();
    },
    setCartLanguage(language) {
      this.cart.forEach((item) => { item.language = language; });
      this.persistCart();
    },
    clearCart() {
      this.cart = [];
      this.persistCart();
    },
    openCart() {
      this.cartOpen = true;
      document.body.style.overflow = 'hidden';
    },
    closeCart() {
      this.cartOpen = false;
      document.body.style.overflow = '';
    },
    toggleWishlist(tourId) {
      const id = String(tourId);
      const idx = this.wishlist.indexOf(id);
      if (idx > -1) {
        this.wishlist.splice(idx, 1);
      } else {
        this.wishlist.push(id);
      }
      localStorage.setItem('nirt_wishlist', JSON.stringify(this.wishlist));
    },
    isWishlisted(tourId) {
      return this.wishlist.includes(String(tourId));
    },
    setLang(code) {
      this.currentLang = code;
      localStorage.setItem('nirt_lang', code);
    },
    waLink(message = '') {
      const text = message ? `?text=${encodeURIComponent(message)}` : '';
      return `https://wa.me/${this.whatsappNumber}${text}`;
    },
  },
});
