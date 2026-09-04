<template>
  <div class="checkout-page">
    <section class="checkout-hero">
      <div class="checkout-hero-content">
        <p class="checkout-hero-kicker"><router-link to="/cart">&#8592; Back to Cart</router-link></p>
        <h1 class="checkout-hero-title">Checkout</h1>
        <p class="checkout-hero-subtitle">Complete your booking in a few simple steps.</p>
      </div>
    </section>

    <section class="checkout-main" v-if="appStore.cart.length">
      <!-- Steps indicator -->
      <div class="stepper">
        <div class="step" :class="{ active: step === 1, done: step > 1 }" @click="step = 1">
          <span class="step-dot">1</span>
          <span class="step-label"><b>Date &amp; Time</b><small>Pick your day</small></span>
        </div>
        <div class="step-line" :class="{ active: step > 1 }"></div>
        <div class="step" :class="{ active: step === 2, done: step > 2 }" @click="step = 2">
          <span class="step-dot">2</span>
          <span class="step-label"><b>Travelers</b><small>Add guests &amp; details</small></span>
        </div>
        <div class="step-line" :class="{ active: step > 2 }"></div>
        <div class="step" :class="{ active: step === 3 }" @click="step = 3">
          <span class="step-dot">3</span>
          <span class="step-label"><b>Confirm</b><small>Review &amp; finish</small></span>
        </div>
      </div>

      <div class="checkout-layout">
        <div class="checkout-main-col">
          <transition name="cofade" mode="out-in">
            <div class="co-panel" v-if="step === 1" key="1">
              <div class="co-panel-head">
                <span class="co-icon">&#128197;</span>
                <div>
                  <h3 class="co-panel-title">When are you going?</h3>
                  <p class="co-panel-sub">Pick a date and available time slot (applies to all tours).</p>
                </div>
              </div>
              <label class="co-label">Travel Date</label>
              <input type="date" class="co-input co-date" :min="minDate" v-model="date" @change="onDateChange" />
              <span class="co-error" v-if="showError1 && !date">Please select a date.</span>

              <template v-if="date">
                <span class="co-label">Available Time Slots</span>
                <div class="co-slots">
                  <button
                    v-for="slot in timeSlots"
                    :key="slot"
                    class="co-slot"
                    :class="{ active: time === slot }"
                    @click="time = slot"
                  >{{ slot }}</button>
                </div>
                <span class="co-error" v-if="showError1 && !time">Please choose a time slot.</span>
              </template>

              <div class="co-actions">
                <button class="btn-back" @click="router.push('/cart')">&#8592; Back to Cart</button>
                <button class="btn-continue" @click="nextFromStep1">Continue &#8594;</button>
              </div>
            </div>

            <div class="co-panel" v-else-if="step === 2" key="2">
              <div class="co-panel-head">
                <span class="co-icon">&#128101;</span>
                <div>
                  <h3 class="co-panel-title">Who is travelling?</h3>
                  <p class="co-panel-sub">Choose travelers per tour, then fill each one's details.</p>
                </div>
              </div>

              <h4 class="sec-title"><span class="sec-no">1</span> Choose your travelers</h4>
              <tour-item
                v-for="item in appStore.cart"
                :key="item.id"
                :item="item"
                @change="appStore.persistCart()"
              />
              <span class="co-error" v-if="showError2 && !travelers.length">Please add at least one traveler.</span>

              <div class="traveler-summary" v-if="tripTotal">
                <span class="ts-label">Your traveler selection</span>
                <div class="ts-chips">
                  <span v-for="cat in tripSummary" :key="cat.key" class="ts-chip" :class="{ 'ts-zero': !cat.count }">
                    <b>{{ cat.count }}</b>{{ cat.label }}
                  </span>
                </div>
              </div>

              <div v-if="travelers.length">
            <hr class="co-hr" />
            <h4 class="sec-title"><span class="sec-no">2</span> Traveler details <i>name &amp; address required</i></h4>
            <div v-for="(t, idx) in travelers" :key="t.id" class="traveler-block">
              <div class="traveler-head">
                <span class="traveler-num">{{ idx + 1 }}</span>
                <span class="traveler-title">{{ t.label }}<i v-if="t.tourName"> · {{ t.tourName }}</i></span>
              </div>
              <div class="traveler-grid">
                <div class="tg-field tg-full">
                  <label class="co-label">Full Name *</label>
                  <input type="text" class="co-input" v-model="t.name" placeholder="Traveler's full name" />
                </div>
                <div class="tg-field">
                  <label class="co-label">Gender</label>
                  <select class="co-input" v-model="t.gender">
                    <option value="">Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="tg-field">
                  <label class="co-label">Date of Birth</label>
                  <input type="date" class="co-input" v-model="t.dob" />
                </div>
                <div class="tg-field">
                  <label class="co-label">Nationality</label>
                  <input type="text" class="co-input" v-model="t.nationality" placeholder="Country" />
                </div>
                <div class="tg-field">
                  <label class="co-label">Passport / ID</label>
                  <input type="text" class="co-input" v-model="t.passport" placeholder="Passport number" />
                </div>
                <div class="tg-field tg-full">
                  <label class="co-label">Address *</label>
                  <input type="text" class="co-input" v-model="t.address" placeholder="Street, City, Country" />
                </div>
              </div>
            </div>

          <h4 class="sec-title"><span class="sec-no">3</span> Contact details <i>for your booking confirmation</i></h4>
          <div class="contact-grid">
              <div class="co-contact-block">
                <label class="co-label">Phone *</label>
                <input type="text" class="co-input" v-model="leadPhone" placeholder="+..." />
              </div>
              <div class="co-contact-block">
                <label class="co-label">Email *</label>
                <input type="email" class="co-input" v-model="leadEmail" placeholder="you@email.com" />
              </div>
            </div>
            <span class="co-error" v-if="showError2 && (!leadPhone.trim() || !leadEmail.trim())">Phone and email are required.</span>
          </div>

          <div class="co-actions">
            <button class="btn-back" @click="step = 1">&#8592; Back</button>
            <button class="btn-continue" @click="nextFromStep2">Continue &#8594;</button>
          </div>
        </div>

            <div class="co-panel" v-else-if="step === 3" key="3">
              <div class="co-panel-head">
                <span class="co-icon">&#128203;</span>
                <div>
                  <h3 class="co-panel-title">Review your booking</h3>
                  <p class="co-panel-sub">Check everything is correct before confirming.</p>
                </div>
              </div>

          <h4 class="sec-title"><span class="sec-no">1</span> Tour &amp; date</h4>
          <div class="rev-card">
            <div class="rev-row" v-for="item in appStore.cart" :key="item.id">
              <span class="rev-name">{{ item.name }}</span>
              <span class="rev-price">€{{ appStore.itemTotal(item) }}</span>
            </div>
            <div class="rev-row rev-muted">
              <span>Date &amp; time</span>
              <span>{{ formatDate(date) }} · {{ time }}</span>
            </div>
            <div class="rev-row rev-muted">
              <span>Travelers</span>
              <span>{{ travelers.length }}</span>
            </div>
          </div>

          <h4 class="sec-title"><span class="sec-no">2</span> Travelers</h4>
          <div class="rev-travelers">
            <div v-for="(t, i) in travelers" :key="t.id" class="rev-traveler">
              <span class="rev-tnum">{{ i + 1 }}</span>
              <div>
                <div class="rev-tname">{{ t.name }} <i>{{ t.label }}</i></div>
                <div class="rev-tsub">{{ [t.gender, t.nationality].filter(Boolean).join(' · ') || '—' }}</div>
              </div>
            </div>
          </div>

          <h4 class="sec-title"><span class="sec-no">3</span> Contact <i>we'll send the confirmation here</i></h4>
          <div class="rev-card rev-muted">
            <div class="rev-row"><span>Phone</span><span>{{ leadPhone }}</span></div>
            <div class="rev-row"><span>Email</span><span>{{ leadEmail }}</span></div>
          </div>

            <div class="co-actions">
              <button class="btn-back" @click="step = 2">&#8592; Back</button>
              <button class="btn-continue confirm" :disabled="placing" @click="placeOrder">
                {{ placing ? 'Placing...' : 'Confirm &amp; Place Order &#10003;' }}
              </button>
            </div>
          </div>
          </transition>
        </div>

        <!-- Summary sidebar (always visible) -->
        <div class="checkout-side">
        <div class="checkout-summary">
          <h3 class="checkout-summary-title">Order Summary</h3>
          <div class="summary-items">
            <div v-for="item in appStore.cart" :key="'x' + item.id" class="summary-item">
              <span class="summary-thumb">
                <img v-if="item.image" :src="item.image" alt="" />
              </span>
              <div class="summary-item-info">
                <div class="summary-item-name">{{ item.name }}</div>
                <div class="summary-item-meta">{{ countMeta(item) }}</div>
              </div>
              <div class="summary-item-price">€{{ appStore.itemTotal(item) }}</div>
            </div>
          </div>
          <div class="summary-row">
            <span>Date</span>
            <span>{{ date ? formatDate(date) + (time ? ' · ' + time : '') : '—' }}</span>
          </div>
          <div class="summary-row">
            <span>Travelers</span>
            <span>{{ travelers.length || '—' }}</span>
          </div>
          <div class="summary-row summary-total">
            <span>Total</span>
            <span>€{{ appStore.cartTotal }}</span>
          </div>
          <div class="summary-trust">
            <span>&#128274; Secure payment</span>
            <span>&#9989; Free cancel</span>
            <span>&#128231; E-tickets</span>
          </div>
        </div>
      </div>
      </div>
    </section>

    <section class="checkout-empty" v-else>
      <div class="checkout-empty-box">
        <h2>Your cart is empty</h2>
        <router-link to="/tours" class="cart-empty-link">&#8592; Continue Shopping</router-link>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAppStore, CATEGORY_KEYS } from '../stores/app';
import TourItem from '../components/CheckoutTourItem.vue';

const appStore = useAppStore();
const router = useRouter();

const step = ref(1);
const date = ref('');
const time = ref('');
const leadPhone = ref('');
const leadEmail = ref('');
const placing = ref(false);
const showError1 = ref(false);
const showError2 = ref(false);

const timeSlots = ['09:00', '10:30', '12:00', '14:00', '16:00'];

const minDate = computed(() => {
  const d = new Date();
  return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
});

const CAT_LABELS = { adult: 'Adult', youth: 'Youth', child: 'Child', infant: 'Infant' };

const countMeta = (item) => {
  const parts = CATEGORY_KEYS.map((key) => {
    const n = Number(item?.travelers?.[key]) || 0;
    return n ? `${n} ${CAT_LABELS[key]}${n > 1 ? 's' : ''}` : null;
  }).filter(Boolean);
  return parts.length ? parts.join(' · ') : 'No travelers';
};

const travelers = computed(() => {
  const list = [];
  appStore.cart.forEach((item) => {
    CATEGORY_KEYS.forEach((key) => {
      const n = Number(item?.travelers?.[key]) || 0;
      for (let i = 0; i < n; i++) {
        list.push({
          id: `${item.id}-${key}-${i}`,
          tourId: item.id,
          tourName: item.name,
          category: key,
          label: `${CAT_LABELS[key]} ${i + 1}`,
          name: '',
          gender: '',
          dob: '',
          nationality: '',
          passport: '',
          address: '',
        });
      }
    });
  });
  return list;
});

const tripSummary = computed(() => {
  const counts = { adult: 0, youth: 0, child: 0, infant: 0 };
  appStore.cart.forEach((item) => {
    CATEGORY_KEYS.forEach((key) => {
      counts[key] += Number(item?.travelers?.[key]) || 0;
    });
  });
  return CATEGORY_KEYS.map((key) => ({ key, label: CAT_LABELS[key] + (counts[key] > 1 ? 's' : ''), count: counts[key] }));
});
const tripTotal = computed(() => tripSummary.value.reduce((sum, c) => sum + c.count, 0));

const onDateChange = () => {
  time.value = '';
  appStore.setCartDate(formatDate(date.value));
};

const formatDate = (val) => {
  if (!val) return '';
  const [y, m, d] = val.split('-');
  const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  return `${y}/${months[Number(m) - 1] || m}/${d}`;
};

const parseFriendly = (val) => {
  if (!val) return '';
  const m = String(val).match(/^(\d{4})\/([A-Za-z]{3})\/(\d{1,2})$/);
  if (!m) return '';
  const months = { Jan:'01', Feb:'02', Mar:'03', Apr:'04', May:'05', Jun:'06', Jul:'07', Aug:'08', Sep:'09', Oct:'10', Nov:'11', Dec:'12' };
  const mm = months[m[2]];
  return mm ? `${m[1]}-${mm}-${String(m[3]).padStart(2, '0')}` : '';
};

onMounted(() => {
  const first = appStore.cart.find((i) => i.date || i.time);
  if (!first) return;
  const d = parseFriendly(first.date);
  if (d) date.value = d;
  if (first.time) time.value = first.time;
  if (d && first.time && step.value === 1) step.value = 2;
});

const step1Valid = computed(() => date.value && time.value);
const step2Valid = computed(() => {
  if (!travelers.value.length) return false;
  const filled = travelers.value.every((t) => t.name.trim() && t.address.trim());
  return filled && leadPhone.value.trim() && leadEmail.value.trim();
});

const nextFromStep1 = () => {
  if (!step1Valid.value) { showError1.value = true; return; }
  step.value = 2;
};
const nextFromStep2 = () => {
  if (!step2Valid.value) { showError2.value = true; return; }
  step.value = 3;
};

const placeOrder = () => {
  if (placing.value) return;
  placing.value = true;
  appStore.setCartTime(time.value);

  let msg = 'Hello! I would like to place an order:\n\n';
  msg += `📅 Date: ${formatDate(date.value)} at ${time.value}\n\n`;
  appStore.cart.forEach((item, i) => {
    msg += `${i + 1}. ${item.name}\n`;
    msg += `   ${appStore.cartLine(item)}\n`;
    msg += `   Subtotal: €${appStore.itemTotal(item)}\n\n`;
  });
  msg += `💰 Total: €${appStore.cartTotal}\n\n`;
  msg += `📞 Phone: ${leadPhone.value}\n`;
  msg += `✉️ Email: ${leadEmail.value}\n\n`;
  msg += '🧍 Travelers:\n';
  travelers.value.forEach((t, i) => {
    msg += ` ${i + 1}. ${t.label}: ${t.name}`;
    if (t.gender) msg += ` (${t.gender})`;
    if (t.nationality) msg += `, ${t.nationality}`;
    msg += `\n    Address: ${t.address}`;
    if (t.passport) msg += `\n    Passport: ${t.passport}`;
    if (t.dob) msg += `\n    DOB: ${t.dob}`;
    msg += '\n';
  });

  const url = appStore.waLink(msg.replace(/\n+/g, '\n'));
  window.open(url, '_blank');
  setTimeout(() => { placing.value = false; }, 500);
};
</script>

<style scoped>
.checkout-page { background: #f4f6f8; min-height: 100vh; }
.checkout-hero {
  position: relative; height: 420px;
  background: linear-gradient(rgba(8,16,28,.85), rgba(8,16,28,.9)), url('/uploads/slider/Rome_6a9132df7e458.jpg') center/cover;
  display: flex; align-items: center; padding: 0 5%;
}
.checkout-hero-content { color: #fff; max-width: 1100px; width: 100%; margin: 0 auto; }
.checkout-hero-kicker a { color: rgba(255,255,255,.8); font-size: 13px; font-weight: 600; text-decoration: none; }
.checkout-hero-kicker a:hover { color: #ddb94e; }
.checkout-hero-title { font-family: 'Cormorant Garamond', serif; font-size: 40px; font-weight: 700; margin: 6px 0 2px; }
.checkout-hero-subtitle { font-size: 14px; color: rgba(255,255,255,.85); }
.checkout-main { max-width: 1100px; margin: 0 auto; padding: 28px 16px 80px; }

/* Stepper */
.checkout-main { max-width: 1080px; margin: 0 auto; padding: 30px 16px 90px; }
.stepper { display: flex; align-items: flex-start; justify-content: center; gap: 0; margin: 0 0 34px; width: 100%; max-width: 640px; margin-left: auto; margin-right: auto; }
.step { display: flex; align-items: center; gap: 10px; cursor: pointer; }
.step-dot {
  width: 36px; height: 36px; border-radius: 50%;
  background: #fff; border: 2px solid #dcd2b6; color: #b8a873;
  font-weight: 800; font-size: 15px; display: flex; align-items: center; justify-content: center;
  transition: all .2s; flex-shrink: 0;
}
.step-label { display: flex; flex-direction: column; gap: 1px; }
.step-label b { font-size: 14px; font-weight: 800; color: #9aa1ab; transition: color .2s; }
.step-label small { font-size: 11px; font-weight: 500; color: #b4bac3; }
.step.active .step-dot { background: #c8a84e; border-color: #c8a84e; color: #0b1623; box-shadow: 0 4px 12px rgba(200,168,78,.35); }
.step.active .step-label b { color: #0b1623; }
.step.done .step-dot { background: #25D366; border-color: #25D366; color: #fff; }
.step.done .step-label b { color: #4b5563; }
.step-line { flex: 1; height: 2px; background: #e7e3d6; border-radius: 2px; transition: background .2s; margin: 17px 14px 0; min-width: 40px; }
.step-line.active { background: #25D366; }

.checkout-layout { display: grid; grid-template-columns: 1fr 340px; gap: 28px; align-items: start; }
.checkout-main-col { min-width: 0; }

/* Step transition */
.cofade-enter-active, .cofade-leave-active { transition: opacity .18s ease, transform .18s ease; }
.cofade-enter-from { opacity: 0; transform: translateY(8px); }
.cofade-leave-to { opacity: 0; transform: translateY(-6px); }

/* Panel */
.co-panel { background: #fff; border: 1px solid #eceef1; border-radius: 18px; padding: 30px; box-shadow: 0 8px 24px rgba(11,22,35,.06); }
.co-panel-head { display: flex; gap: 14px; align-items: flex-start; padding-bottom: 22px; border-bottom: 1px solid #eef1f4; margin-bottom: 6px; }
.co-icon { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg,#0b1623,#1c2a3a); color: #c8a84e; font-size: 20px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.co-panel-title { font-family: 'Cormorant Garamond', serif; font-size: 24px; font-weight: 800; color: #0b1623; margin: 0 0 3px; }
.co-panel-sub { font-size: 13px; color: #6b7280; margin: 0; }
.co-label { display: block; font-size: 11px; font-weight: 800; color: #6b7280; text-transform: uppercase; letter-spacing: .6px; margin: 16px 0 7px; }
.co-input { width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 12px 14px; font-size: 14px; color: #111827; background: #fafbfc; outline: none; transition: all .2s; box-sizing: border-box; }
.co-input:focus { border-color: #c8a84e; background: #fff; box-shadow: 0 0 0 3px rgba(200,168,78,.12); }
.co-date { font-weight: 600; }
.co-error { display: block; color: #ef4444; font-size: 12px; font-weight: 600; margin-top: 6px; }
.co-slots { display: flex; flex-wrap: wrap; gap: 10px; }
.co-slot { border: 1.5px solid #e5e7eb; background: #fafbfc; color: #374151; padding: 10px 18px; border-radius: 30px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all .2s; }
.co-slot:hover { border-color: #c8a84e; }
.co-slot.active { background: #c8a84e; border-color: #c8a84e; color: #0b1623; }
.co-actions { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-top: 30px; padding-top: 22px; border-top: 1px solid #eef1f4; }
.btn-back { background: #fff; border: 1.5px solid #e5e7eb; color: #4b5563; padding: 12px 20px; border-radius: 10px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all .2s; }
.btn-back:hover { border-color: #9ca3af; }
.btn-continue { background: #c8a84e; border: none; color: #0b1623; padding: 13px 28px; border-radius: 10px; font-size: 14px; font-weight: 800; cursor: pointer; transition: all .25s; box-shadow: 0 6px 16px rgba(200,168,78,.3); }
.btn-continue:hover { background: #ddb94e; transform: translateY(-1px); }
.btn-continue.confirm { background: #25D366; box-shadow: 0 6px 16px rgba(37,211,102,.3); }
.btn-continue.confirm:hover { background: #1ebe5b; }
.btn-continue:disabled { opacity: .5; cursor: not-allowed; transform: none; }

/* Section titles */
.co-hr { border: none; border-top: 1px solid #eef1f4; margin: 24px 0 4px; }
.sec-title { display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 800; color: #0b1623; margin: 20px 0 10px; }
.sec-title .sec-no { width: 24px; height: 24px; border-radius: 7px; background: #0b1623; color: #c8a84e; font-size: 12px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.sec-title i { font-style: normal; font-weight: 600; color: #9ca3af; font-size: 13px; }
.sec-title:first-child { margin-top: 0; }

/* Traveler forms */
.traveler-block { border: 1px solid #eceef1; border-radius: 16px; padding: 20px 20px 14px; margin-top: 14px; background: #fafbfc; }
.traveler-head { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
.traveler-num { width: 28px; height: 28px; border-radius: 50%; background: #c8a84e; color: #0b1623; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.traveler-title { font-size: 15px; font-weight: 800; color: #0b1623; }
.traveler-title i { font-style: normal; color: #9ca3af; font-weight: 600; }
.traveler-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 18px; align-items: end; }
.tg-field .co-label { margin-top: 12px; margin-bottom: 6px; }
.tg-full { grid-column: 1 / -1; }
.co-contact-block .co-label { margin-top: 12px; }
.contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 18px; margin-top: 6px; }

/* Traveler summary */
.traveler-summary { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; background: #0b1623; border-radius: 14px; padding: 14px 18px; margin: 18px 0 6px; }
.ts-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; color: #c8a84e; flex-shrink: 0; }
.ts-chips { display: flex; flex-wrap: wrap; gap: 8px; }
.ts-chip { display: inline-flex; align-items: baseline; gap: 5px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12); color: #e5e7eb; font-size: 12px; font-weight: 600; padding: 4px 11px; border-radius: 30px; }
.ts-chip b { font-size: 14px; font-weight: 800; color: #fff; }
.ts-chip.ts-zero { opacity: .45; }

/* Review */
.rev-card { border: 1px solid #eceef1; border-radius: 14px; padding: 6px 18px; background: #fafbfc; }
.rev-row { display: flex; justify-content: space-between; gap: 12px; padding: 11px 0; font-size: 14px; color: #111827; border-bottom: 1px solid #eef1f4; }
.rev-row:last-child { border-bottom: none; }
.rev-name { font-weight: 700; }
.rev-price { font-weight: 800; color: #0b1623; }
.rev-muted { color: #6b7280; }
.rev-travelers { display: flex; flex-direction: column; gap: 10px; }
.rev-traveler { display: flex; gap: 12px; align-items: center; border: 1px solid #eceef1; border-radius: 12px; padding: 12px 14px; background: #fafbfc; }
.rev-tnum { width: 28px; height: 28px; border-radius: 50%; background: #0b1623; color: #fff; font-weight: 800; font-size: 13px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.rev-tname { font-size: 14px; font-weight: 700; color: #111827; }
.rev-tname i { font-style: normal; color: #9ca3af; font-weight: 600; margin-left: 4px; }
.rev-tsub { font-size: 12px; color: #6b7280; margin-top: 2px; }

/* Sidebar */
.checkout-side { display: flex; flex-direction: column; position: sticky; top: 100px; }
.checkout-summary { background: #fff; border: 1px solid #eceef1; border-radius: 18px; padding: 24px; box-shadow: 0 8px 24px rgba(11,22,35,.06); }
.checkout-summary-title { font-family: 'Cormorant Garamond', serif; font-size: 20px; font-weight: 800; color: #0b1623; margin: 0 0 16px; padding-bottom: 14px; border-bottom: 1px solid #eef1f4; }
.summary-items { display: flex; flex-direction: column; gap: 12px; padding-bottom: 14px; margin-bottom: 12px; border-bottom: 1px solid #eef1f4; }
.summary-item { display: flex; align-items: center; gap: 12px; }
.summary-thumb { width: 46px; height: 46px; border-radius: 10px; overflow: hidden; background: #f1f3f6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
.summary-thumb img { width: 100%; height: 100%; object-fit: cover; }
.summary-item-info { flex: 1; min-width: 0; }
.summary-item-name { font-size: 13px; font-weight: 700; color: #111827; line-height: 1.3; }
.summary-item-meta { font-size: 11px; color: #9ca3af; font-weight: 600; margin-top: 2px; }
.summary-item-price { font-size: 13px; font-weight: 800; color: #0b1623; white-space: nowrap; }
.summary-row { display: flex; justify-content: space-between; gap: 12px; font-size: 13px; color: #4b5563; padding: 5px 0; }
.summary-row span:last-child { text-align: right; font-weight: 600; }
.summary-total { border-top: 1px dashed #e5e7eb; margin-top: 8px; padding-top: 12px; font-size: 18px; font-weight: 900; color: #0b1623; }
.summary-trust { display: flex; flex-direction: column; gap: 7px; margin-top: 16px; padding-top: 14px; border-top: 1px solid #eef1f4; font-size: 12px; color: #6b7280; font-weight: 600; }
.summary-trust span { display: flex; align-items: center; gap: 6px; }

.checkout-empty { padding: 80px 16px; display: flex; justify-content: center; }
.checkout-empty-box { text-align: center; background: #fff; border: 1px solid #eceef1; border-radius: 20px; padding: 60px 50px; }
.checkout-empty-box h2 { font-family: 'Cormorant Garamond', serif; font-size: 28px; color: #0b1623; margin-bottom: 16px; }
.cart-empty-link { color: #c8a84e; font-weight: 700; text-decoration: none; }
.cart-empty-link:hover { text-decoration: underline; }

@media (max-width: 900px) {
  .checkout-layout { grid-template-columns: 1fr; }
  .checkout-side { position: static; }
  .traveler-grid, .contact-grid { grid-template-columns: 1fr; }
  .step-label small { display: none; }
  .step-label { flex-direction: row; }
  .step-line { margin-top: 17px; }
}

@media (max-width: 560px) {
  .stepper { max-width: 100%; }
  .step { gap: 7px; }
  .co-panel { padding: 22px 18px; }
  .checkout-hero { padding: 0 20px; }
}

@media (max-width: 480px) {
  .checkout-hero { height: 300px; padding: 0 16px; }
  .checkout-hero-title { font-size: 30px; }
  .checkout-main { padding: 20px 12px 60px; }
  .stepper { flex-wrap: wrap; gap: 4px; justify-content: center; }
  .step { gap: 5px; }
  .step-dot { width: 30px; height: 30px; font-size: 13px; }
  .step-label b { font-size: 12px; }
  .step-line { min-width: 24px; margin: 17px 6px 0; }
  .co-panel { padding: 18px 14px; border-radius: 14px; }
  .co-panel-head { gap: 10px; padding-bottom: 16px; }
  .co-icon { width: 36px; height: 36px; font-size: 17px; border-radius: 10px; }
  .co-panel-title { font-size: 20px; }
  .co-slot { padding: 8px 14px; font-size: 13px; }
  .co-actions { flex-direction: column-reverse; gap: 10px; }
  .co-actions .btn-back, .co-actions .btn-continue { width: 100%; text-align: center; }
  .traveler-block { padding: 14px 12px 12px; border-radius: 12px; }
  .traveler-grid { gap: 0 12px; }
  .contact-grid { gap: 0 12px; }
  .checkout-summary { padding: 18px; border-radius: 14px; }
  .checkout-empty-box { padding: 40px 20px; }
  .checkout-empty-box h2 { font-size: 22px; }
  .rev-card { padding: 4px 12px; }
  .traveler-summary { flex-direction: column; align-items: flex-start; gap: 10px; padding: 12px 14px; }
}
</style>
