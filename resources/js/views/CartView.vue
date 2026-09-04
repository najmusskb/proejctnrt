<template>
  <div class="cart-page">
    <section class="cart-hero">
      <div class="cart-hero-content">
        <p class="cart-hero-kicker"><a href="#" @click.prevent="goBack">&#8592; Continue Shopping</a></p>
        <h1 class="cart-hero-title">Your Cart</h1>
        <p class="cart-hero-subtitle">{{ titleLine }}</p>
      </div>
    </section>

    <section class="cart-main" v-if="appStore.cart.length">
      <div class="cart-layout">
        <!-- Left: items -->
        <div class="cart-items-col">
          <div v-for="item in appStore.cart" :key="item.id" class="cart-item-row">
            <img :src="getImgUrl(item.image)" :alt="item.name" class="cart-item-photo">
            <div class="cart-item-body">
              <div class="cart-item-title">{{ item.name }}</div>
              <div class="cart-item-meta">
                <span v-if="item.date" class="chip">&#128197; {{ item.date }}<template v-if="item.time"> · {{ item.time }}</template></span>
                <span class="chip">{{ travelersLabel(item) }}</span>
              </div>
              <div class="cart-item-cats">{{ appStore.cartLine(item) }}</div>
              <div class="cart-item-lang" v-if="item.language">&#127911; {{ item.language }}</div>
            </div>
            <div class="cart-item-right">
              <div class="cart-item-total">€{{ appStore.itemTotal(item) }}</div>
              <button class="cart-item-delete" @click="appStore.removeFromCart(item.id)">Delete</button>
            </div>
          </div>

          <button class="cart-clear-all" @click="appStore.clearCart()">Clear all</button>
        </div>

        <!-- Right: summary -->
        <div class="cart-summary-col">
          <h3 class="cart-summary-title">Order Summary</h3>
          <div class="cart-summary-lines">
            <div v-for="item in appStore.cart" :key="'s' + item.id" class="cart-summary-line">
              <span>{{ item.name }} <i v-if="item.qtyNote" class="qty-note">×{{ item.qtyNote }}</i></span>
              <span>€{{ appStore.itemTotal(item) }}</span>
            </div>
            <div class="cart-summary-line cart-subtotal">
              <span>Subtotal</span>
              <span>€{{ appStore.cartTotal }}</span>
            </div>
            <div class="cart-summary-line cart-total">
              <span>Total</span>
              <span>€{{ appStore.cartTotal }}</span>
            </div>
          </div>
          <button class="cart-checkout-btn" @click="goCheckout">Checkout All</button>
        </div>
      </div>
    </section>

    <section class="cart-empty" v-else>
      <div class="cart-empty-box">
        <div class="cart-empty-icon">&#128722;</div>
        <h2>Your cart is empty</h2>
        <p>Find your next adventure in Rome.</p>
        <router-link to="/tours" class="cart-empty-link">&#8592; Continue Shopping</router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAppStore, CATEGORY_KEYS, PRICE_RULE } from '../stores/app';

const appStore = useAppStore();
const router = useRouter();

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const travelersLabel = (item) => {
  const parts = [];
  CATEGORY_KEYS.forEach((key) => {
    const n = Number(item?.travelers?.[key]) || 0;
    if (!n) return;
    const label = { adult: 'Adults', youth: 'Youth', child: 'Children', infant: 'Infants' }[key];
    parts.push(`${label}: ${n}`);
  });
  return parts.join(' · ') || '1 traveler';
};

const titleCount = computed(() => appStore.titleCount);

const titleLine = computed(() => {
  const n = appStore.cartCount;
  const trav = appStore.titleCount;
  return `Your Cart (${n} ${n === 1 ? 'tour' : 'tours'}) · ${trav} ${trav === 1 ? 'traveler' : 'travelers'}`;
});

const goBack = () => {
  if (history.length > 1) router.back();
  else router.push('/tours');
};

const goCheckout = () => {
  router.push('/checkout');
};
</script>

<style scoped>
.cart-page { background: #f6f7f9; min-height: 100vh; }
.cart-hero {
  position: relative;
  height: 420px;
  background: linear-gradient(rgba(8,16,28,.8), rgba(8,16,28,.85)), url('/uploads/slider/Rome_6a9132df7e458.jpg') center/cover;
  display: flex;
  align-items: center;
  padding: 0 5%;
}
.cart-hero-content { color: #fff; max-width: 1200px; width: 100%; margin: 0 auto; }
.cart-hero-kicker a { color: rgba(255,255,255,.8); font-size: 13px; font-weight: 600; text-decoration: none; transition: color .2s; }
.cart-hero-kicker a:hover { color: #ddb94e; }
.cart-hero-title { font-family: 'Cormorant Garamond', serif; font-size: 46px; font-weight: 700; margin: 8px 0 2px; }
.cart-hero-subtitle { font-size: 14px; color: rgba(255,255,255,.85); }
.cart-main { padding: 40px 5% 80px; }
.cart-layout { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 360px; gap: 32px; align-items: start; }
.cart-items-col { display: flex; flex-direction: column; }
.cart-item-row {
  display: flex; gap: 18px; align-items: flex-start;
  background: #fff; border: 1px solid #eceef1; border-radius: 16px;
  padding: 18px; margin-bottom: 14px;
  box-shadow: 0 4px 16px rgba(0,0,0,.04);
}
.cart-item-photo { width: 120px; height: 100px; border-radius: 12px; object-fit: cover; flex-shrink: 0; }
.cart-item-body { flex: 1; min-width: 0; }
.cart-item-title { font-family: 'Cormorant Garamond', serif; font-size: 19px; font-weight: 700; color: #0b1623; margin-bottom: 6px; }
.cart-item-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 8px; }
.chip { background: #f2f4f7; color: #4b5563; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
.cart-item-cats { font-size: 13px; color: #4b5563; font-weight: 600; margin-bottom: 6px; }
.cart-item-lang { font-size: 13px; color: #6b7280; }
.cart-item-right { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
.cart-item-total { font-size: 19px; font-weight: 900; color: #0b1623; }
.cart-item-delete { background: transparent; border: 1px solid #e5e7eb; color: #ef4444; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 20px; cursor: pointer; transition: all .2s; }
.cart-item-delete:hover { background: #ef4444; border-color: #ef4444; color: #fff; }
.cart-clear-all { align-self: flex-start; background: none; border: none; color: #9ca3af; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: underline; margin-top: 4px; }
.cart-clear-all:hover { color: #ef4444; }
.cart-summary-col { background: #fff; border: 1px solid #eceef1; border-radius: 16px; padding: 24px; position: sticky; top: 110px; box-shadow: 0 8px 24px rgba(0,0,0,.06); }
.cart-summary-title { font-family: 'Cormorant Garamond', serif; font-size: 22px; font-weight: 800; color: #0b1623; margin-bottom: 16px; }
.cart-summary-lines { display: flex; flex-direction: column; gap: 10px; border-bottom: 1px dashed #e5e7eb; padding-bottom: 16px; margin-bottom: 16px; }
.cart-summary-line { display: flex; justify-content: space-between; font-size: 14px; color: #374151; gap: 12px; }
.cart-summary-line span:first-child { flex: 1; }
.qty-note { font-style: normal; color: #9ca3af; }
.cart-subtotal { margin-top: 6px; font-weight: 700; }
.cart-total { font-size: 17px; font-weight: 900; color: #0b1623; margin-top: 4px; }
.cart-checkout-btn { width: 100%; background: #c8a84e; color: #0b1623; border: none; padding: 15px; border-radius: 12px; font-size: 15px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; cursor: pointer; transition: all .25s; }
.cart-checkout-btn:hover { background: #ddb94e; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(200,168,78,.35); }
.cart-empty { padding: 80px 5%; display: flex; justify-content: center; }
.cart-empty-box { text-align: center; background: #fff; border: 1px solid #eceef1; border-radius: 20px; padding: 60px 50px; max-width: 460px; }
.cart-empty-icon { font-size: 60px; margin-bottom: 14px; }
.cart-empty-box h2 { font-family: 'Cormorant Garamond', serif; font-size: 28px; color: #0b1623; margin: 0 0 6px; }
.cart-empty-box p { color: #6b7280; margin: 0 0 20px; }
.cart-empty-link { color: #c8a84e; font-weight: 700; text-decoration: none; }
.cart-empty-link:hover { text-decoration: underline; }
@media (max-width: 900px) {
  .cart-layout { grid-template-columns: 1fr; }
  .cart-summary-col { position: static; }
  .cart-item-photo { width: 90px; height: 82px; }
}
@media (max-width: 768px) {
  .cart-hero { height: 320px; }
  .cart-hero-title { font-size: 36px; }
  .cart-item-photo { width: 80px; height: 72px; }
  .cart-item-right { position: absolute; right: 18px; top: 18px; }
  .cart-item-row { position: relative; padding-right: 90px; }
  .cart-empty-box { padding: 40px 24px; }
}
@media (max-width: 480px) {
  .cart-hero { height: 260px; padding: 0 4%; }
  .cart-hero-title { font-size: 30px; }
  .cart-main { padding: 24px 4% 60px; }
  .cart-item-row { flex-direction: column; gap: 12px; padding: 14px; }
  .cart-item-photo { width: 100%; height: 140px; border-radius: 10px; }
  .cart-item-right { position: static; flex-direction: row; align-items: center; justify-content: space-between; width: 100%; }
  .cart-summary-col { padding: 18px; }
  .cart-empty-box { padding: 32px 16px; }
  .cart-empty-box h2 { font-size: 22px; }
}
</style>
