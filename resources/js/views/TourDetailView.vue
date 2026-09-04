<template>
  <div class="tour-detail-view pt-[100px] bg-gray-50 pb-16">
    <div v-if="loading" class="text-center py-28">
      <LoadingSpinner />
      <p class="text-gray-500 mt-4 text-sm font-semibold">Loading tour details...</p>
    </div>

    <div v-else-if="tour" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- BREADCRUMBS & ACTIONS -->
      <div class="flex flex-col md:flex-row md:items-center justify-between py-4">
        <nav class="flex items-center text-[13px] font-medium text-gray-500 mb-4 md:mb-0">
          <router-link to="/" class="hover:text-[#c69c27] transition">Home</router-link>
          <span class="mx-2 text-gray-400">/</span>
          <router-link to="/tours" class="hover:text-[#c69c27] transition">Tours</router-link>
          <span class="mx-2 text-gray-400">/</span>
          <span class="text-gray-900 truncate max-w-[200px] sm:max-w-xs">{{ tour.name }}</span>
        </nav>
        <div class="flex items-center gap-3">
          <button @click="shareTour" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-100 transition text-[13px] font-semibold text-gray-700">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
            Share
          </button>
          <button @click="appStore.toggleWishlist(tour.id)" class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-100 transition text-[13px] font-semibold text-gray-700">
            <svg width="16" height="16" viewBox="0 0 24 24" :fill="appStore.isWishlisted(tour.id) ? '#ef4444' : 'none'" :stroke="appStore.isWishlisted(tour.id) ? '#ef4444' : 'currentColor'" stroke-width="2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            {{ appStore.isWishlisted(tour.id) ? 'Saved' : 'Save' }}
          </button>
        </div>
      </div>

      <!-- HERO TITLE -->
      <div class="mb-6">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-3">{{ tour.name }}</h1>
        <div class="flex flex-wrap items-center gap-4 text-[14px] text-gray-600">
          <div class="flex items-center gap-1">
            <span class="text-[#c69c27]">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
            <span class="font-bold text-gray-900 ml-1">{{ tour.rating || '4.9' }}</span>
            <span>({{ tour.reviews_count || 350 }} reviews)</span>
          </div>
          <span v-if="tour.meeting_point" class="w-1 h-1 rounded-full bg-gray-300"></span>
          <div v-if="tour.meeting_point" class="flex items-center gap-1.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            {{ tour.meeting_point }}
          </div>
        </div>
      </div>

      <!-- INFO PILLS -->
      <div class="flex flex-wrap items-center gap-3 mb-8">
        <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
          <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div>
            <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Duration</div>
            <div class="text-[13px] font-bold text-gray-900">{{ tour.duration || '3 hours' }}</div>
          </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
          <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div>
            <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Group Size</div>
            <div class="text-[13px] font-bold text-gray-900">{{ tour.group_size || 'Small group' }}</div>
          </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
          <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          </div>
          <div>
            <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Tour Type</div>
            <div class="text-[13px] font-bold text-gray-900">{{ tour.category?.name || 'Guided Tour' }}</div>
          </div>
        </div>
      </div>

      <!-- GALLERY (FANCYBOX INTEGRATED) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
        <a 
          v-for="(img, idx) in galleryList" 
          :key="idx" 
          :href="img" 
          data-fancybox="gallery" 
          class="relative cursor-pointer hover:opacity-95 transition group h-[300px] sm:h-[400px] md:h-[480px] rounded-[24px] overflow-hidden block"
        >
          <img :src="img" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" :alt="tour.name">
          <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition duration-300"></div>
          <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-md text-white px-3 py-1.5 rounded-full text-xs font-semibold flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition duration-300">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
            View Fullscreen
          </div>
        </a>
      </div>

      <!-- BODY LAYOUT -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <!-- LEFT COLUMN -->
        <div class="lg:col-span-8">
          <!-- STICKY TABS -->
          <div class="sticky top-[80px] z-40 bg-gray-50/90 backdrop-blur-md py-4 border-b border-gray-200 mb-8 overflow-x-auto no-scrollbar">
            <div class="flex items-center gap-2 min-w-max">
              <a href="#overview" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Overview</a>
              <a href="#itinerary" v-if="itineraryList.length > 0" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Tour Plan</a>
              <a href="#included" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Included</a>
              <a href="#location" v-if="tour.map_iframe || tour.meeting_point" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Location</a>
              <a href="#faq" v-if="faqs.length > 0" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">FAQ</a>
              <a href="#reviews" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Reviews</a>
            </div>
          </div>

          <!-- SECTION: OVERVIEW -->
          <section id="overview" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-5">Tour Overview</h2>
            <div class="prose prose-gray max-w-none text-[15px] text-gray-600 leading-relaxed" v-html="tour.description"></div>
          </section>

          <hr class="border-gray-200 mb-12">

          <!-- SECTION: ITINERARY -->
          <section id="itinerary" v-if="itineraryList.length > 0" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Tour Plan</h2>
            <div class="relative space-y-6 ml-2">
              <div v-for="(item, i) in itineraryList" :key="i" class="itinerary-item relative flex items-start gap-5">
                <div class="itinerary-line relative z-10 shrink-0 w-10 h-10 rounded-full bg-white border-2 border-[#c69c27] flex items-center justify-center text-[#c69c27] font-bold text-[14px] shadow-sm">
                  {{ i + 1 }}
                </div>
                <div class="flex-1 pt-2 pb-6">
                  <h3 class="text-[16px] font-bold text-gray-900 mb-2">{{ item }}</h3>
                </div>
              </div>
            </div>
          </section>

          <hr v-if="itineraryList.length > 0" class="border-gray-200 mb-12">

          <!-- SECTION: INCLUDED / EXCLUDED -->
          <section id="included" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">What's Included</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div>
                <ul class="space-y-4">
                  <li v-for="(it, i) in includedList" :key="i" class="flex items-start gap-3">
                    <div class="mt-0.5 w-6 h-6 rounded-full bg-[#10b981]/10 flex items-center justify-center shrink-0">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <span class="text-[15px] text-gray-700 font-medium">{{ it }}</span>
                  </li>
                </ul>
              </div>
              <div>
                <ul class="space-y-4">
                  <li v-for="(it, i) in excludedList" :key="i" class="flex items-start gap-3">
                    <div class="mt-0.5 w-6 h-6 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </div>
                    <span class="text-[15px] text-gray-700 font-medium">{{ it }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </section>

          <hr class="border-gray-200 mb-12">

          <!-- SECTION: LOCATION -->
          <section id="location" v-if="tour.map_iframe || tour.meeting_point" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Location & Meeting Point</h2>
            <div v-if="tour.meeting_point" class="flex items-start gap-3 mb-6 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
              <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 text-[15px] mb-1">Meeting Point</h3>
                <p class="text-[14px] text-gray-600">{{ tour.meeting_point }}</p>
              </div>
            </div>

            <div v-if="tour.map_iframe" class="rounded-2xl overflow-hidden shadow-sm border border-gray-200">
              <iframe :src="tour.map_iframe" width="100%" height="400" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </section>

          <!-- SECTION: FAQ -->
          <section id="faq" v-if="faqs.length > 0" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Frequently Asked Questions</h2>
            <div class="space-y-4">
              <div 
                v-for="(faq, i) in faqs" 
                :key="i" 
                class="faq-item bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition hover:shadow-md"
              >
                <button 
                  class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left bg-transparent cursor-pointer outline-none" 
                  @click="toggleFaq(i)"
                >
                  <span class="text-[15px] font-bold text-gray-900 pr-4">{{ faq.question || faq.q }}</span>
                  <span class="faq-icon text-gray-400 text-[20px] shrink-0 transition-transform duration-300" :class="{ 'rotate-180': openFaqIdx === i }">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                  </span>
                </button>
                <div v-show="openFaqIdx === i" class="text-[14.5px] text-gray-600 leading-relaxed px-6 pb-5 pt-1 border-t border-gray-50">
                  {{ faq.answer || faq.a }}
                </div>
              </div>
            </div>
          </section>

          <hr class="border-gray-200 mb-12">

          <!-- SECTION: REVIEWS -->
          <section id="reviews" class="scroll-mt-[150px] mb-12">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Customer Reviews</h2>

            <!-- Summary -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-10 p-6 bg-white rounded-2xl border border-gray-100 shadow-sm">
              <div class="flex flex-col items-center gap-2 shrink-0">
                <div class="text-5xl font-extrabold text-gray-900 leading-none">{{ averageRating || '—' }}</div>
                <div class="flex gap-0.5 text-[#fbbf24] text-lg">
                  <template v-for="i in 5" :key="i">
                    <span>{{ i <= Math.round(Number(averageRating || 0)) ? '★' : '☆' }}</span>
                  </template>
                </div>
                <div class="text-[13px] text-gray-500 font-medium">{{ reviews.length }} review{{ reviews.length === 1 ? '' : 's' }}</div>
              </div>
              <div class="flex-1 w-full">
                <div v-for="level in [5,4,3,2,1]" :key="level" class="flex items-center gap-3 mb-2">
                  <span class="text-[12px] text-gray-500 w-10 shrink-0 text-right">{{ level }}&#9733;</span>
                  <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full" :style="{ width: ratingPercent(level) + '%', background: level >= 4 ? '#fbbf24' : (level === 3 ? '#f59e0b' : '#f97316') }"></div>
                  </div>
                  <span class="text-[12px] text-gray-500 w-8 shrink-0">{{ ratingPercent(level) }}%</span>
                </div>
                <p class="text-[13px] text-gray-400 mt-3">Ratings from verified guests who explored this experience.</p>
              </div>
            </div>

            <!-- Review List -->
            <div v-if="reviews.length" class="space-y-5 mb-10">
              <div v-for="(rev, idx) in reviews" :key="idx" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4 mb-3">
                  <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-gradient-to-br from-[#c69c27] to-[#a07c1f] text-white flex items-center justify-center font-extrabold text-[16px] shrink-0">
                      {{ (rev.name || 'G')[0].toUpperCase() }}
                    </div>
                    <div>
                      <div class="font-bold text-gray-900 text-[15px]">{{ rev.name }}</div>
                      <div class="text-[12px] text-gray-400">{{ formatDate(rev.created_at) }}</div>
                    </div>
                  </div>
                  <div class="flex gap-0.5 text-[#fbbf24] text-[14px]">
                    <span v-for="i in 5" :key="i">{{ i <= rev.rating ? '★' : '☆' }}</span>
                  </div>
                </div>
                <p class="text-[14.5px] text-gray-600 leading-relaxed" v-if="rev.comment">{{ rev.comment }}</p>
                <p v-else class="text-[13px] text-gray-400 italic">No comment.</p>
              </div>
            </div>
            <div v-else class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center mb-10">
              <div class="text-4xl mb-3">&#9733;</div>
              <h3 class="font-bold text-gray-900 text-[16px] mb-1">Be the first to review</h3>
              <p class="text-[14px] text-gray-500">Share your experience and help other travellers plan their trip.</p>
            </div>

            <!-- Review Form -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
              <h3 class="text-xl font-extrabold text-gray-900 mb-1">Leave a Review</h3>
              <p class="text-[14px] text-gray-500 mb-6">Your feedback helps us and our fellow travellers.</p>

              <div v-if="reviewSuccess" class="mb-6 p-4 rounded-xl bg-[#10b981]/10 border border-[#10b981]/30 text-[#047857] text-[14px] font-semibold flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                {{ reviewSuccess }}
              </div>

              <form @submit.prevent="submitReview" class="space-y-5">
                <!-- Star rating input -->
                <div>
                  <label class="block text-[13px] font-bold text-gray-700 mb-2">Your Rating *</label>
                  <div class="flex gap-2">
                    <button
                      v-for="n in 5"
                      :key="n"
                      type="button"
                      class="text-3xl leading-none transition-transform cursor-pointer hover:scale-125"
                      :class="n <= formRating ? 'text-[#fbbf24]' : 'text-gray-300'"
                      :aria-label="n + ' star'"
                      @click="formRating = n"
                    >&#9733;</button>
                  </div>
                  <span v-if="formError.rating" class="block text-[12px] text-red-500 mt-1">{{ formError.rating }}</span>
                </div>

                <div>
                  <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Your Name *</label>
                  <input v-model="formName" type="text" placeholder="e.g. John Smith" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-[14px] text-gray-700 focus:outline-none focus:border-[#c69c27]">
                  <span v-if="formError.name" class="block text-[12px] text-red-500 mt-1">{{ formError.name }}</span>
                </div>

                <div>
                  <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Your Review</label>
                  <textarea v-model="formComment" rows="4" placeholder="Tell us about your experience..." class="w-full border border-gray-300 rounded-xl px-4 py-3 text-[14px] text-gray-700 focus:outline-none focus:border-[#c69c27] resize-none"></textarea>
                </div>

                <button 
                  type="submit"
                  :disabled="reviewLoading"
                  class="w-full bg-[#c69c27] text-white py-3.5 rounded-xl text-[15px] font-bold shadow-lg shadow-[#c69c27]/30 hover:bg-[#b08820] hover:-translate-y-0.5 transition-all disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                >
                  <span v-if="reviewLoading" class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                  {{ reviewLoading ? 'Submitting...' : 'Submit Review' }}
                </button>
              </form>
            </div>
          </section>
        </div>

        <!-- RIGHT WIDGET COLUMN -->
        <div class="lg:col-span-4">
          <div class="sticky top-[100px] bg-white rounded-[24px] border border-gray-100 shadow-xl p-6" style="box-shadow: 0 20px 50px -12px rgba(11,22,35,.25);">
            
            <!-- Price Header -->
            <div class="mb-5">
              <span class="text-[12px] text-gray-500 font-semibold uppercase tracking-wide block mb-1">From</span>
              <div class="flex items-end gap-2">
                <span class="text-3xl font-extrabold text-[#0b1623]">€{{ basePrice }}</span>
                <span class="text-[14px] text-gray-500 mb-1 font-medium">per person</span>
              </div>
            </div>

            <!-- Form / Inputs -->
            <div class="space-y-4 mb-5">
              <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Select Date</label>
                <div class="relative">
                  <input type="date" v-model="selectedDate" :min="minDate" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-[14px] text-gray-700 focus:outline-none focus:border-[#c8a84e] focus:ring-2 focus:ring-[#c8a84e]/20 transition" />
                </div>
                <template v-if="selectedDate">
                  <label class="block text-[13px] font-bold text-gray-700 mt-4 mb-1.5">Select Time</label>
                  <div class="flex flex-wrap gap-2">
                    <button
                      v-for="slot in timeSlots"
                      :key="slot"
                      @click="selectedTime = slot"
                      class="px-4 py-2 rounded-full border text-[13px] font-bold transition"
                      :class="selectedTime === slot ? 'bg-[#c8a84e] border-[#c8a84e] text-[#0b1623]' : 'border-gray-300 text-gray-600 hover:border-[#c8a84e]'"
                    >{{ slot }}</button>
                  </div>
                </template>
              </div>

              <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Guests</label>
                <div class="border border-gray-300 rounded-2xl p-3 space-y-1">
                  <div v-for="cat in guestCats" :key="cat.key" class="flex items-center justify-between py-1.5">
                    <div>
                      <div class="text-[14px] font-bold text-gray-900">{{ cat.label }}</div>
                      <div class="text-[11px] text-gray-500">{{ cat.age }} · {{ cat.priceText }}</div>
                    </div>
                    <div class="flex items-center gap-3">
                      <button @click="adjs(cat, -1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c8a84e] hover:text-[#c8a84e] transition">-</button>
                      <span class="w-4 text-center text-[15px] font-bold text-gray-900">{{ travQty(cat.key) }}</span>
                      <button @click="adjs(cat, 1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c8a84e] hover:text-[#c8a84e] transition">+</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Total Price -->
              <div class="flex items-center justify-between pt-2 border-t border-dashed border-gray-200">
                <span class="text-[15px] font-bold text-gray-700">Total Price</span>
                <span class="text-[22px] font-extrabold text-[#0b1623]">€{{ totalPrice }}</span>
              </div>
            </div>

            <!-- CTA Buttons -->
            <div class="space-y-3">
              <button 
                @click="handleBook"
                class="w-full flex items-center justify-center gap-2 bg-[#c8a84e] text-[#0b1623] py-3.5 rounded-xl text-[15px] font-bold shadow-lg shadow-[#c8a84e]/30 hover:bg-[#ddb94e] hover:-translate-y-0.5 transition-all"
              >
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"></circle><circle cx="19" cy="21" r="1.5"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                Book Now
              </button>
              <p class="text-center text-[12px] text-gray-500 mt-1">Pick date, time &amp; guests, then confirm in checkout</p>
            </div>

            <!-- Trust features -->
            <div class="mt-6 pt-5 border-t border-gray-100 space-y-3">
              <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <span class="text-[13px] font-medium text-gray-700">Free cancellation 24h before</span>
              </div>
              <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <span class="text-[13px] font-medium text-gray-700">Skip-the-line fast track</span>
              </div>
              <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <span class="text-[13px] font-medium text-gray-700">Instant e-tickets</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch, nextTick } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();
const route = useRoute();
const router = useRouter();

const tour = ref(null);
const relatedTours = ref([]);
const faqs = ref([]);
const loading = ref(true);

const guestCounts = ref({ adult: 1, youth: 0, child: 0, infant: 0 });
const selectedDate = ref(new Date().toISOString().split('T')[0]);
const selectedTime = ref('');
const openFaqIdx = ref(0);

const reviews = ref([]);
const formRating = ref(0);
const formName = ref('');
const formComment = ref('');
const formError = ref({});
const reviewLoading = ref(false);
const reviewSuccess = ref('');

const averageRating = computed(() => {
  const r = reviews.value;
  if (!r.length) return Number(tour.value?.rating || 0);
  const total = r.reduce((s, item) => s + Number(item.rating || 0), 0);
  return (total / r.length).toFixed(1);
});

const ratingPercent = (level) => {
  const r = reviews.value;
  if (!r.length) return 0;
  const count = r.filter(item => Number(item.rating) === level).length;
  return Math.round((count / r.length) * 100);
};

const formatDate = (d) => {
  if (!d) return '';
  const date = new Date(d);
  if (isNaN(date)) return '';
  return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
};

const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const galleryList = computed(() => {
  if (!tour.value) return [];
  const list = [];
  if (tour.value.image) list.push(getImgUrl(tour.value.image));
  if (tour.value.secondary_image) list.push(getImgUrl(tour.value.secondary_image));
  if (Array.isArray(tour.value.images)) {
    tour.value.images.forEach(img => {
      const p = typeof img === 'string' ? img : img?.image;
      if (p) list.push(getImgUrl(p));
    });
  }
  return list.length ? list : [getImgUrl(tour.value.image)];
});

const basePrice = computed(() => Number(tour.value?.price || 45));

const timeSlots = ['09:00', '10:30', '12:00', '14:00', '16:00'];

const guestCats = computed(() => {
  const b = basePrice.value;
  const defs = [
    { key: 'adult', label: 'Adults', age: 'Age 12+', price: b, min: 1 },
    { key: 'youth', label: 'Youth', age: 'Ages 6-11', price: Math.round(b * 0.89), min: 0 },
    { key: 'child', label: 'Children', age: 'Under 12', price: Math.round(b * 0.70), min: 0 },
    { key: 'infant', label: 'Infants', age: 'Under 3', price: 0, min: 0 },
  ];
  return defs.map((d) => ({ ...d, priceText: d.price === 0 ? 'FREE' : `€${d.price}/pp` }));
});

const travQty = (key) => Number(guestCounts.value[key] || 0);

const adjs = (cat, delta) => {
  const next = travQty(cat.key) + delta;
  guestCounts.value[cat.key] = Math.max(cat.min, next);
};

const totalPrice = computed(() => {
  return guestCats.value.reduce((sum, cat) => sum + cat.price * travQty(cat.key), 0);
});

const minDate = computed(() => {
  const d = new Date();
  return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
});

const friendlyDate = (val) => {
  if (!val) return '';
  const [y, m, d] = val.split('-');
  const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  return `${y}/${months[Number(m) - 1] || m}/${d}`;
};

const handleBook = () => {
  if (!selectedDate.value) {
    appStore.notify('Please select a date.', 'error');
    return;
  }
  if (!selectedTime.value) {
    appStore.notify('Please select a time slot.', 'error');
    return;
  }
  const travelers = { adult: guestCounts.value.adult, youth: guestCounts.value.youth, child: guestCounts.value.child, infant: guestCounts.value.infant };
  const status = appStore.addToCart(tour.value, {
    update: true,
    date: friendlyDate(selectedDate.value),
    time: selectedTime.value,
    language: 'English',
    travelers,
  });
  if (status === 'added') appStore.notify(`"${tour.value?.name}" added to cart`, 'success');
  else if (status === 'updated') appStore.notify(`"${tour.value?.name}" booking updated`, 'success');
  router.push('/checkout');
};

const itineraryList = computed(() => {
  if (!tour.value?.itinerary) return [];
  if (Array.isArray(tour.value.itinerary)) return tour.value.itinerary;
  try {
    return JSON.parse(tour.value.itinerary);
  } catch {
    return [];
  }
});

const includedList = computed(() => {
  if (!tour.value?.included) return [
    'Skip-the-line fast track tickets',
    'Expert licensed local English-speaking guide',
    'Personal headsets for crystal clear commentary',
  ];
  if (Array.isArray(tour.value.included)) return tour.value.included;
  try {
    return JSON.parse(tour.value.included);
  } catch {
    return [tour.value.included];
  }
});

const excludedList = computed(() => {
  if (!tour.value?.excluded) return [
    'Hotel pickup & drop-off',
    'Food and drinks',
    'Gratuities (optional)',
  ];
  if (Array.isArray(tour.value.excluded)) return tour.value.excluded;
  try {
    return JSON.parse(tour.value.excluded);
  } catch {
    return [tour.value.excluded];
  }
});

const toggleFaq = (idx) => {
  openFaqIdx.value = openFaqIdx.value === idx ? -1 : idx;
};

const shareTour = () => {
  if (navigator.share) {
    navigator.share({
      title: tour.value?.name,
      url: window.location.href,
    });
  } else {
    navigator.clipboard.writeText(window.location.href);
    alert('Link copied to clipboard!');
  }
};

const initFancybox = () => {
  if (typeof window !== 'undefined' && window.Fancybox) {
    try {
      window.Fancybox.unbind('[data-fancybox="gallery"]');
      window.Fancybox.bind('[data-fancybox="gallery"]', {
        Toolbar: {
          display: {
            left: ["infobar"],
            middle: [],
            right: ["slideshow", "fullscreen", "thumbs", "close"],
          },
        },
      });
    } catch (err) {
      console.warn('Fancybox init error', err);
    }
  }
};

const submitReview = async () => {
  formError.value = {};
  reviewSuccess.value = '';

  if (!formRating.value) {
    formError.value.rating = 'Please select a star rating.';
    return;
  }
  if (!formName.value.trim()) {
    formError.value.name = 'Please enter your name.';
    return;
  }

  reviewLoading.value = true;
  try {
    const slug = route.params.slug;
    const res = await fetch(`/api/tour/${slug}/reviews`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({
        name: formName.value.trim(),
        rating: formRating.value,
        comment: formComment.value.trim(),
      }),
    });
    const data = await res.json();
    if (!res.ok) {
      if (data.errors) formError.value = data.errors;
      else formError.value = { name: data.message || 'Something went wrong.' };
      return;
    }
    if (data.review) reviews.value.unshift(data.review);
    reviewSuccess.value = data.message || 'Thank you! Your review has been submitted.';
    formRating.value = 0;
    formName.value = '';
    formComment.value = '';
  } catch (e) {
    formError.value = { name: 'Network error. Please try again.' };
  } finally {
    reviewLoading.value = false;
  }
};

const fetchTourData = async () => {
  loading.value = true;
  try {
    const slug = route.params.slug;
    const res = await fetch(`/api/tour/${slug}`);
    const data = await res.json();
    tour.value = data.tour;
    relatedTours.value = data.related || [];
    faqs.value = data.faqs || [];
    reviews.value = data.tour?.reviews || [];
    nextTick(() => {
      setTimeout(initFancybox, 200);
    });
  } catch (e) {
    console.error('Failed to load tour details', e);
  } finally {
    loading.value = false;
  }
};

watch(() => route.params.slug, () => {
  fetchTourData();
});

watch(selectedDate, () => {
  selectedTime.value = '';
});

onMounted(() => {
  fetchTourData();
});
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
.itinerary-line::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    bottom: -10px;
    width: 2px;
    background: #e5e7eb;
    z-index: 0;
}
.itinerary-item:last-child .itinerary-line::before { display: none; }

@media (max-width: 768px) {
  .tour-detail-view { padding-top: 80px; }
  .tour-detail-view .sticky { position: relative !important; top: 0 !important; }
}
@media (max-width: 480px) {
  .tour-detail-view { padding-top: 70px; padding-bottom: 48px; }
  .tour-detail-view > div:nth-child(2) > div:last-child > div:last-child { gap: 24px; }
  .faq-item button { padding: 16px; }
}
</style>
