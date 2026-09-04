<template>
  <div class="co-item">
    <div class="co-item-head">
      <img :src="imgUrl" :alt="item.name" class="co-item-img">
      <div>
        <div class="co-item-name">{{ item.name }}</div>
        <div class="co-item-price">€{{ appStore.itemTotal(item) }} <span class="co-item-total-label">total</span></div>
      </div>
    </div>

    <div class="co-cat-list">
      <div v-for="cat in cats" :key="cat.key" class="co-cat">
        <div>
          <div class="co-cat-name">{{ cat.label }}</div>
          <div class="co-cat-price">{{ cat.priceText }}</div>
        </div>
        <div class="co-stepper">
          <button @click="dec(cat.key)">-</button>
          <span>{{ qty(cat.key) }}</span>
          <button @click="inc(cat.key)">+</button>
        </div>
      </div>
    </div>

    <div class="co-lang">
      <span class="co-lang-label">Audio language</span>
      <div class="co-lang-options">
        <button
          v-for="l in languages"
          :key="l"
          class="co-lang-opt"
          :class="{ active: (item.language || 'English') === l }"
          @click="setLang(l)"
        >{{ l }}</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useAppStore, CATEGORY_KEYS, PRICE_RULE } from '../stores/app';

const props = defineProps({
  item: { type: Object, required: true },
});

const emit = defineEmits(['change']);

const appStore = useAppStore();

const imgUrl = computed(() => {
  const path = props.item.image;
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
});

const base = computed(() => Number(props.item.price) || 0);

const cats = computed(() =>
  CATEGORY_KEYS.map((key, i) => {
    const labels = ['Adults', 'Youth', 'Children', 'Infants'];
    const per = Math.round(base.value * (PRICE_RULE[key] || 0) * 100) / 100;
    return {
      key,
      label: labels[i],
      per,
      priceText: per === 0 ? 'FREE' : `€${per}/pp`,
    };
  })
);

const languages = ['English', 'Italian', 'French', 'Spanish', 'German'];

const qty = (key) => Number(props.item?.travelers?.[key]) || 0;

const inc = (key) => {
  appStore.setTraveler(props.item.id, key, qty(key) + 1);
  emit('change');
};

const dec = (key) => {
  appStore.setTraveler(props.item.id, key, qty(key) - 1);
  emit('change');
};

const setLang = (l) => {
  appStore.setCartItemField(props.item.id, 'language', l);
  emit('change');
};
</script>

<style scoped>
.co-item { border: 1px solid #f0f1f4; border-radius: 12px; padding: 16px; margin-bottom: 14px; background: #fafbfc; }
.co-item-head { display: flex; gap: 14px; align-items: center; margin-bottom: 14px; }
.co-item-img { width: 82px; height: 64px; border-radius: 10px; object-fit: cover; flex-shrink: 0; background: #0b1623; }
.co-item-name { font-size: 15px; font-weight: 700; color: #0b1623; }
.co-item-price { font-size: 15px; font-weight: 900; color: #c8a84e; margin-top: 3px; }
.co-item-total-label { font-size: 11px; font-weight: 600; color: #9ca3af; margin-left: 4px; }
.co-cat-list { display: flex; flex-direction: column; gap: 10px; }
.co-cat { display: flex; align-items: center; justify-content: space-between; background: #fff; border-radius: 10px; padding: 10px 14px; }
.co-cat-name { font-size: 14px; font-weight: 700; color: #111827; }
.co-cat-price { font-size: 12px; color: #6b7280; margin-top: 2px; }
.co-stepper { display: flex; align-items: center; gap: 12px; }
.co-stepper button { width: 30px; height: 30px; border-radius: 9px; border: 1px solid #e5e7eb; background: #fafbfc; color: #374151; font-size: 16px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .2s; }
.co-stepper button:hover { background: #c8a84e; border-color: #c8a84e; color: #fff; }
.co-stepper span { min-width: 18px; text-align: center; font-weight: 800; color: #111827; }
.co-lang { margin-top: 14px; }
.co-lang-label { font-size: 12px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: .5px; }
.co-lang-options { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
.co-lang-opt { border: 1px solid #e5e7eb; background: #fff; color: #374151; padding: 7px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all .2s; }
.co-lang-opt:hover { border-color: #c8a84e; }
.co-lang-opt.active { background: #0b1623; border-color: #0b1623; color: #fff; }
</style>
