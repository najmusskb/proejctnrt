<template>
  <div class="home-view">
    <!-- 1. HERO SLIDER SECTION (WOW SLIDER WITH 3D ANIMATION EFFECTS) -->
    <div class="hero-section-wrapper" style="position: relative; width: 100%;">
      <div id="wowslider-container1">
        <div class="ws_images">
          <ul>
            <li v-for="(slider, idx) in sliders" :key="idx">
              <img :src="getImgUrl(slider.image)" :alt="slider.title" :title="slider.title" :id="'wows1_' + idx"/>
            </li>
          </ul>
        </div>
        <div class="ws_bullets">
          <div>
            <a v-for="(slider, idx) in sliders" :key="idx" href="#" :title="slider.title">
              <span>{{ idx + 1 }}</span>
            </a>
          </div>
        </div>
        <div class="ws_shadow"></div>
      </div>

      <!-- Custom static text overlay OUTSIDE wowslider so it never resets or moves -->
      <div class="custom-wow-overlay">
        <div class="custom-slide-text" v-if="activeSlide">
          <h1 class="cst-title" v-html="formattedSlideTitle"></h1>
          <div class="cst-subtitle" style="margin-bottom: 20px;">{{ activeSlide.subtitle }}</div>
          <div class="cst-buttons" style="margin-bottom: 25px;">
            <router-link to="/tickets" class="cst-btn cst-btn-primary">
              <svg viewBox='0 0 24 24' width='20' height='20' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z'/><path d='M13 5v2'/><path d='M13 17v2'/><path d='M13 11v2'/></svg> BUY TICKETS
            </router-link>
            <a :href="appStore.waLink('Hi! I am interested in Rome tours.')" target="_blank" class="cst-btn cst-btn-secondary">
              <svg viewBox='0 0 24 24' width='20' height='20' fill='currentColor'><path d='M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z'/></svg> WhatsApp
            </a>
          </div>

          <!-- Mobile Minimized Filter (Visible only on mobile) -->
          <div class="mobile-slide-filter">
            <form @submit.prevent="submitHeroSearch" class="msf-form">
              <div class="msf-selects">
                <div class="msf-select-wrapper">
                  <select v-model="heroAttraction" class="msf-select">
                    <option value="">Select Attraction</option>
                    <option v-for="d in destinations" :key="d.id" :value="d.slug">{{ d.name }}</option>
                  </select>
                </div>
                <div class="msf-select-wrapper">
                  <select v-model="heroType" class="msf-select">
                    <option value="">Select Type</option>
                    <option v-for="c in homeCategories" :key="c.id" :value="c.slug">{{ c.name }}</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="msf-btn">Search Tour</button>
            </form>
          </div>

          <!-- BEAUTIFUL OVERLAPPING FILTER SECTION (Desktop only) -->
          <div class="global-filter-wrapper desktop-global-filter">
            <form @submit.prevent="submitHeroSearch" class="cst-global-form">
              <select v-model="heroAttraction" class="cst-global-select border-right">
                <option value="">Attraction?</option>
                <option v-for="d in destinations" :key="d.id" :value="d.slug">{{ d.name }}</option>
              </select>
              <select v-model="heroType" class="cst-global-select border-right">
                <option value="">Tour Type?</option>
                <option v-for="c in homeCategories" :key="c.id" :value="c.slug">{{ c.name }}</option>
              </select>
              <button type="submit" class="cst-global-btn" aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. STATS TICKER MARQUEE -->
    <div class="bg-navy overflow-hidden py-3 border-y border-white/10" v-if="statsList.length">
      <div class="ticker-wrapper flex overflow-hidden whitespace-nowrap">
        <div class="ticker-track flex items-center">
          <div 
            v-for="(t, idx) in tickerLoop" 
            :key="idx"
            class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"
          >
            <span class="text-gold text-[9px]">&#10022;</span>
            <span v-if="t.number" class="text-gold text-[15px] font-bold">{{ t.number }}</span>
            <span>{{ t.label }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- 3. POPULAR DESTINATIONS SLIDER -->
    <section class="py-8 px-6 relative" id="destinations">
      <div class="dest-bg-img"></div>
      <div class="dest-bg-overlay"></div>
      <div class="max-w-[1280px] mx-auto relative z-10">
        <div class="text-center mb-3">
          <p class="text-[10px] font-bold tracking-[3px] text-gold uppercase mb-1">{{ homeSetting?.dest_subtitle || 'Best Places For You' }}</p>
          <h2 class="font-playfair text-white font-bold leading-none text-[clamp(24px,3.5vw,38px)] mb-1" style="text-shadow:0 2px 12px rgba(0,0,0,.5)">
            {{ homeSetting?.dest_title || 'Popular Destinations' }}
          </h2>
          <div class="w-8 h-[2px] bg-gold mx-auto mb-1 rounded-sm"></div>
          <p class="text-[13px] text-white/70 max-w-[480px] mx-auto leading-[1.5]">
            {{ homeSetting?.dest_desc || 'Journey through Rome\'s storied past, from the majestic Colosseum to the sacred Vatican.' }}
          </p>
        </div>
      </div>

      <!-- 3-Card Destination Slider -->
      <div class="ds-section" id="dsSection">
        <div class="ds-viewport" id="dsViewport">
          <div class="ds-track" :style="{ transform: `translateX(-${destIndex * destCardWidth}px)` }">
            <div 
              v-for="dest in destinations" 
              :key="dest.id" 
              class="ds-card" 
              @click="$router.push('/destination/' + dest.slug)"
            >
              <img :src="getImgUrl(dest.image)" :alt="dest.name"/>
              <div class="ds-frame"></div>
              <span class="ds-name">{{ dest.name }}</span>
              <div class="ds-bottom-panel">
                <p class="ds-info-desc">{{ dest.description }}</p>
                <router-link :to="'/destination/' + dest.slug" class="ds-info-btn">View Tours & Tickets</router-link>
              </div>
            </div>
          </div>
        </div>
        <button class="ds-arrow ds-arrow-l" @click="prevDest" aria-label="Previous">&#10094;</button>
        <button class="ds-arrow ds-arrow-r" @click="nextDest" aria-label="Next">&#10095;</button>
        <div class="ds-dots" id="dsDots">
          <button 
            v-for="(_, i) in destinations" 
            :key="i" 
            class="ds-dot" 
            :class="{ active: destIndex === i }" 
            @click="destIndex = i"
            :aria-label="'Destination ' + (i + 1)"
          ></button>
        </div>
        <div class="text-center mt-8">
          <router-link to="/all-destinations" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3 px-[34px] rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(200,168,78,.4)]">
            {{ homeSetting?.dest_btn || 'View All Destinations' }} &#8594;
          </router-link>
        </div>
      </div>
    </section>

    <!-- 4. TOURS SECTION -->
    <section id="tours" class="py-20 px-6 bg-cream">
      <div class="max-w-[1280px] mx-auto">
        <div>
          <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.tours_subtitle || 'Curated Experiences' }}</p>
          <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.tours_title || 'Discover Rome\'s Best Experiences' }}</h2>
          <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
          <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">{{ homeSetting?.tours_desc || 'Hand-picked tours led by Rome\'s top licensed guides — bookable instantly via WhatsApp.' }}</p>
        </div>

        <!-- Filter tabs -->
        <div class="flex gap-2.5 justify-center flex-wrap mb-[30px]">
          <button 
            class="py-[9px] px-5 rounded-full border-[1.5px] text-[13px] font-semibold cursor-pointer transition-all"
            :class="activeTourTab === 'all' ? 'border-navy bg-navy text-white' : 'border-cream-dark bg-white text-[#6b7280] hover:border-gold hover:text-navy'"
            @click="activeTourTab = 'all'"
          >
            All Tours
          </button>
          <button 
            class="py-[9px] px-5 rounded-full border-[1.5px] text-[13px] font-semibold cursor-pointer transition-all"
            :class="activeTourTab === 'bestseller' ? 'border-navy bg-navy text-white' : 'border-cream-dark bg-white text-[#6b7280] hover:border-gold hover:text-navy'"
            @click="activeTourTab = 'bestseller'"
          >
            Bestsellers
          </button>
          <button 
            class="py-[9px] px-5 rounded-full border-[1.5px] text-[13px] font-semibold cursor-pointer transition-all"
            :class="activeTourTab === 'new' ? 'border-navy bg-navy text-white' : 'border-cream-dark bg-white text-[#6b7280] hover:border-gold hover:text-navy'"
            @click="activeTourTab = 'new'"
          >
            New
          </button>
          <button 
            class="py-[9px] px-5 rounded-full border-[1.5px] text-[13px] font-semibold cursor-pointer transition-all"
            :class="activeTourTab === 'popular' ? 'border-navy bg-navy text-white' : 'border-cream-dark bg-white text-[#6b7280] hover:border-gold hover:text-navy'"
            @click="activeTourTab = 'popular'"
          >
            Popular
          </button>
        </div>

        <!-- Tour Grid -->
        <div class="tour-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[17px] mb-[30px]">
          <div 
            v-for="tour in displayTours" 
            :key="tour.id" 
            class="tour-card bg-[#161821] rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)] flex flex-col"
          >
            <div class="tour-card-img relative h-[220px] overflow-hidden shrink-0">
              <router-link :to="'/tour/' + tour.slug" class="block w-full h-full">
                <img :src="getImgUrl(tour.image)" :alt="tour.name" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" style="background:#161821;"/>
              </router-link>
              <span class="absolute bottom-4 left-4 bg-[#059669] text-white text-[12px] font-bold py-1.5 px-3 rounded-full flex items-center gap-1.5 shadow-md">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Free cancellation
              </span>
              <span 
                v-if="tour.badge_type || tour.is_featured" 
                class="absolute top-4 left-4 text-[11px] font-extrabold py-1.5 px-3.5 rounded-full tracking-wide uppercase shadow-md max-w-[65%] truncate"
                :class="(tour.badge_type === 'Bestseller' || tour.is_featured) ? 'bg-[#d6a848] text-[#111827]' : 'bg-[#d6a848] text-[#111827]'"
              >
                {{ tour.badge_type || 'Bestseller' }}
              </span>
              <button 
                class="absolute top-4 right-4 w-9 h-9 bg-[#1f2937]/70 backdrop-blur-md border-none rounded-full flex items-center justify-center cursor-pointer text-white transition-colors hover:bg-[#1f2937]/90 shadow-md"
                @click.stop="appStore.toggleWishlist(tour.id)"
                :aria-label="appStore.isWishlisted(tour.id) ? 'Remove wishlist' : 'Add wishlist'"
              >
                <svg width="16" height="16" viewBox="0 0 24 24" :fill="appStore.isWishlisted(tour.id) ? '#ef4444' : 'none'" :stroke="appStore.isWishlisted(tour.id) ? '#ef4444' : 'currentColor'" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              </button>
            </div>

            <div class="p-5 flex-1 flex flex-col bg-[#161821]">
              <router-link :to="'/tour/' + tour.slug" class="no-underline block mb-2">
                <h3 class="text-[17px] font-bold text-white leading-tight hover:text-[#d6a848] transition-colors line-clamp-2" style="font-family: inherit;">{{ tour.name }}</h3>
              </router-link>
              
              <div class="flex items-center gap-1.5 mb-4">
                <span class="text-[#eab308] text-[15px]">&#9733;</span>
                <span class="text-white text-[15px] font-bold">{{ tour.rating || '4.8' }}</span>
                <span class="text-gray-400 text-[13px] font-medium">({{ tour.reviews_count || '2,841' }})</span>
              </div>
              
              <div class="grid grid-cols-2 gap-3 mb-5">
                <div class="flex items-start gap-1.5 text-[13px] text-gray-400 font-medium leading-snug">
                  <svg class="shrink-0 mt-[2px]" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span class="line-clamp-2">{{ tour.duration || '3 hours' }}</span>
                </div>
                <div class="flex items-start gap-1.5 text-[13px] text-gray-400 font-medium leading-snug">
                  <svg class="shrink-0 mt-[2px]" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <span class="line-clamp-2">{{ tour.group_size || 'Small group' }}</span>
                </div>
              </div>

              <div class="h-px bg-white/10 mb-4 mt-auto"></div>
              
              <div class="flex items-center justify-between gap-2 mb-5">
                <div class="flex flex-col min-w-0">
                  <div class="flex items-end gap-1.5 leading-none flex-wrap">
                    <span class="text-[14px] text-gray-500 font-bold line-through">€{{ Math.round((tour.price || 35) * 1.15) }}</span>
                    <span class="text-[24px] font-extrabold text-[#d6a848] leading-none">€{{ tour.price || '35' }}</span>
                    <span class="text-[11px] font-bold text-[#059669] mb-1">-13%</span>
                  </div>
                  <span class="text-[12px] text-gray-500 mt-1.5 font-medium">per person</span>
                </div>
                <router-link :to="'/tour/' + tour.slug" class="bg-[#d6a848] text-[#111827] border-none py-2.5 px-5 rounded-xl text-[14px] font-extrabold cursor-pointer transition-all hover:bg-[#c69a38] no-underline shrink-0 text-center">
                  Book Now
                </router-link>
              </div>

              <button @click="handleAddToCart(tour)" class="flex items-center justify-center gap-2 w-full bg-transparent text-white border border-white/20 py-2.5 rounded-xl text-[14px] font-bold transition-all hover:bg-white/10">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1.5"></circle><circle cx="20" cy="21" r="1.5"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                Add to Cart
              </button>
            </div>
          </div>
        </div>

        <div class="text-center mt-1.5">
          <router-link to="/tours" class="bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold display-inline-block no-underline transition-all hover:bg-navy hover:text-white">
            {{ homeSetting?.tours_btn || 'Show More Tours' }}
          </router-link>
        </div>
      </div>
    </section>

    <!-- 5. TOUR CATEGORIES -->
    <section class="py-20 px-6 relative" id="categories" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Rome_StPeter_Panorama_02_800.jpg/960px-Rome_StPeter_Panorama_02_800.jpg');background-size:cover;background-position:center;background-attachment:fixed;">
      <div class="absolute inset-0 bg-[rgba(5,12,25,.82)]"></div>
      <div class="relative max-w-[1280px] mx-auto">
        <div>
          <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.cat_subtitle || 'Explore Rome' }}</p>
          <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.cat_title || 'Find Your Perfect Tour' }}</h2>
          <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
          <p class="text-[15px] text-white/75 text-center max-w-[560px] mx-auto mt-3.5 mb-[40px] leading-[1.7]">{{ homeSetting?.cat_desc || 'Browse by theme — from ancient monuments to candlelit food strolls, there\'s a Roman adventure for every traveller.' }}</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          <router-link 
            v-for="(cat, catIdx) in homeCategories" 
            :key="catIdx"
            :to="'/category/' + cat.slug" 
            class="group relative bg-white/8 backdrop-blur-sm rounded-2xl border border-white/15 p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-white/15 hover:shadow-[0_12px_32px_rgba(0,0,0,.35)]"
          >
            <div class="w-[54px] h-[54px] bg-gold/15 border border-gold/30 rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">
              <span v-html="cat.emoji || '&#127963;'"></span>
            </div>
            <h3 class="font-playfair text-[16px] font-bold text-white mb-1">{{ cat.name }}</h3>
            <span class="text-[12px] text-gold-light font-semibold">{{ cat.subtitle || 'Book Now →' }}</span>
          </router-link>
        </div>
      </div>
    </section>

    <!-- 6. EXPERIENCE ROME / ABOUT -->
    <section class="py-20 px-6 bg-white overflow-hidden" id="about">
      <div class="max-w-[1280px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-[50px] items-center">
        <div class="relative">
          <div class="relative rounded-[22px] overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,.2)]">
            <img :src="getImgUrl(aboutData?.image)" alt="Experience Rome with Nice in Rome Tour" class="w-full h-[260px] sm:h-[320px] lg:h-[420px] object-cover"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/50 to-transparent"></div>
            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
              <div class="bg-white/90 backdrop-blur rounded-2xl px-5 py-3.5 text-center shadow-lg">
                <div class="text-[26px] font-extrabold text-navy leading-none">{{ aboutData?.counter1_number || '35K+' }}</div>
                <div class="text-[10px] font-semibold text-[#6b7280] tracking-wide uppercase">{{ aboutData?.counter1_label || 'Happy Travellers' }}</div>
              </div>
              <div class="bg-gold/95 rounded-2xl px-5 py-3.5 text-center shadow-lg">
                <div class="text-[26px] font-extrabold text-navy leading-none">{{ aboutData?.counter2_number || '4.8★' }}</div>
                <div class="text-[10px] font-semibold text-navy/70 tracking-wide uppercase">{{ aboutData?.counter2_label || 'Avg. Rating' }}</div>
              </div>
            </div>
          </div>
          <div class="absolute -top-5 -right-4 bg-navy text-gold rounded-[14px] px-4 py-3 text-center shadow-xl rotate-2">
            <div class="text-[20px] font-extrabold leading-none">{{ aboutData?.badge_number || '12' }}</div>
            <div class="text-[9px] font-semibold tracking-widest uppercase">{{ aboutData?.badge_label || 'Years Exp.' }}</div>
          </div>
        </div>
        <div>
          <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-3">{{ aboutData?.subtitle || 'Experience Rome' }}</p>
          <h2 class="font-playfair text-navy font-bold leading-tight mb-5 text-[clamp(28px,4vw,42px)]">{{ aboutData?.title || 'See Rome Through The Eyes Of A Local' }}</h2>
          <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
          <div class="text-[15px] text-[#6b7280] leading-[1.8] mb-6" v-html="aboutData?.description || 'Nice in Rome Tour is more than a booking service — we are a family of passionate Roman guides who have spent a decade uncovering the Eternal City secrets. Every experience is hand-crafted, authentic and personal.'"></div>
          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-7">
            <li v-for="(check, cIdx) in aboutCheckmarks" :key="cIdx" class="flex items-start gap-2.5">
              <span class="w-6 h-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center text-[13px] shrink-0 mt-0.5">&#10003;</span>
              <span class="text-[14px] font-medium text-navy">{{ check }}</span>
            </li>
          </ul>
          <div class="flex gap-3.5 flex-wrap">
            <router-link to="/tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3.5 px-8 rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(200,168,78,.4)]">
              {{ aboutData?.button_text || 'Discover Our Story →' }}
            </router-link>
            <router-link to="/tours" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3.5 px-8 rounded-[10px] text-[14px] font-semibold no-underline transition-all hover:bg-navy hover:text-white">
              {{ aboutData?.button2_text || 'Browse All Tours' }}
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <!-- 7. CONCIERGE SERVICES -->
    <section class="py-20 px-6 bg-white" id="services" v-if="services.length">
      <div class="max-w-[1280px] mx-auto">
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.srv_subtitle || 'More Than Tours' }}</p>
        <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.srv_title || 'Travel Services Built Around You' }}</h2>
        <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
        <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">{{ homeSetting?.srv_desc || 'Beyond our signature tours, we handle every detail of your Rome stay — seamless, stress-free, first-class.' }}</p>

        <div class="service-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
          <router-link 
            v-for="srv in services" 
            :key="srv.id" 
            :to="'/service/' + srv.slug" 
            class="group bg-cream rounded-2xl overflow-hidden border border-cream-dark transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_18px_44px_rgba(0,0,0,.12)] hover:border-gold/40 cursor-pointer no-underline"
          >
            <div class="relative h-[150px] overflow-hidden">
              <img :src="getImgUrl(srv.image)" :alt="srv.name" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
              <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/70 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-[15px] flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center text-navy text-[17px] shrink-0" v-html="srv.icon || '&#128718;'"></div>
              </div>
            </div>
            <div class="p-5">
              <h3 class="font-playfair text-[17px] font-bold text-navy mb-1.5">{{ srv.name }}</h3>
              <p class="text-[13px] text-[#6b7280] leading-[1.7] mb-3.5">{{ srv.short_description }}</p>
              <span class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gold-dark no-underline transition-all group-hover:gap-2.5">Learn more &rarr;</span>
            </div>
          </router-link>
        </div>

        <div class="text-center mt-8">
          <router-link to="/services" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-navy hover:text-white">
            {{ homeSetting?.srv_btn || 'View All Services' }} &#8594;
          </router-link>
        </div>
      </div>
    </section>

    <!-- 8. WHY CHOOSE US -->
    <section class="py-20 px-6 relative" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg/960px-Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg');background-size:cover;background-position:center;background-attachment:fixed;">
      <div class="absolute inset-0 bg-[rgba(8,16,30,.85)]"></div>
      <div class="relative max-w-[1280px] mx-auto">
        <div>
          <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.wcu_subtitle || 'Why Choose Us' }}</p>
          <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.wcu_title || 'Why Book With Nice In Rome Tour' }}</h2>
          <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
          <p class="text-[15px] text-white/75 text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">{{ homeSetting?.wcu_desc || 'We make your Rome experience extraordinary with personalized service and instant booking.' }}</p>
        </div>
        <div class="why-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="(wcu, wIdx) in whyChooseUs" 
            :key="wIdx" 
            class="bg-white/8 backdrop-blur-sm rounded-2xl py-7 px-6 text-center border border-white/15 transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.35)]"
          >
            <div class="w-[60px] h-[60px] bg-gold/15 border border-gold/30 rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]" v-html="wcu.icon || '&#10004;'"></div>
            <h3 class="font-playfair text-[18px] font-bold text-white mb-[9px]">{{ wcu.title }}</h3>
            <div class="text-[14px] text-white/70 leading-[1.7]" v-html="wcu.description"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- 9. TRUSTED PARTNERS -->
    <section class="bg-cream py-[58px] px-6 relative" v-if="partners.length">
      <div class="max-w-[1280px] mx-auto">
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.partners_subtitle || 'Our Network' }}</p>
        <h2 class="font-playfair text-navy font-bold text-center mb-[34px] leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.partners_title || 'Our Trusted Partners' }}</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-3">
          <div 
            v-for="p in partners" 
            :key="p.id" 
            class="bg-white border-[1.5px] border-cream-dark rounded-xl px-4 h-[68px] flex items-center justify-center gap-3 transition-all hover:border-gold hover:shadow-md"
          >
            <img v-if="p.image" :src="getImgUrl(p.image)" :alt="p.name" class="h-9 w-auto max-w-full object-contain mx-auto"/>
            <span v-else class="text-[13px] font-bold text-navy whitespace-nowrap">{{ p.name }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- 10. BLOG SECTION -->
    <section class="py-20 px-6 bg-cream" v-if="blogs.length">
      <div class="max-w-[1280px] mx-auto">
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.blog_subtitle || 'From the Journal' }}</p>
        <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.blog_title || 'Travel Stories & Tips' }}</h2>
        <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
        <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">{{ homeSetting?.blog_desc || 'Insider guides, travel tips and stories from Rome\'s hidden corners.' }}</p>
        
        <div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
          <router-link 
            v-for="blog in blogs" 
            :key="blog.id" 
            :to="'/blog/' + blog.slug" 
            class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)] no-underline flex flex-col justify-between"
          >
            <div>
              <div class="blog-card-img h-[194px] overflow-hidden">
                <img :src="getImgUrl(blog.image)" :alt="blog.title" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"/>
              </div>
              <div class="p-[18px]">
                <span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">{{ blog.author || 'Journal' }}</span>
                <h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">{{ blog.title }}</h3>
                <p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px] line-clamp-2">{{ blog.short_description }}</p>
                <p class="text-[12px] text-[#6b7280] mb-3">&#128197; {{ formatDate(blog.created_at) }} &nbsp;&middot;&nbsp; {{ blog.read_time || '5' }} min read</p>
              </div>
            </div>
            <div class="px-[18px] pb-[18px]">
              <span class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</span>
            </div>
          </router-link>
        </div>

        <div class="text-center mt-10">
          <router-link to="/blogs" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-navy hover:text-white">
            {{ homeSetting?.blog_btn || 'View All Posts' }} &#8594;
          </router-link>
        </div>
      </div>
    </section>

    <!-- 11. TESTIMONIALS SLIDER -->
    <section class="py-20 px-6 relative overflow-hidden" id="reviews" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Colosseum_of_Rome%2C_Italy.jpg/960px-Colosseum_of_Rome%2C_Italy.jpg');background-size:cover;background-position:center;background-attachment:fixed;">
      <div class="absolute inset-0 bg-[rgba(7,14,26,.86)]"></div>
      <div class="max-w-[1280px] mx-auto relative z-10">
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">{{ homeSetting?.testi_subtitle || 'Loved by Travellers' }}</p>
        <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">{{ homeSetting?.testi_title || 'What Our Guests Say' }}</h2>
        <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
        <div class="flex items-center justify-center gap-2 mt-4 mb-[38px]">
          <span class="text-[18px] font-extrabold text-white">{{ avgRating }}</span>
          <span class="text-[#fbbf24] text-[15px]">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <span class="text-[13px] text-white/60">Based on {{ totalReviewsCount }}+ verified reviews</span>
        </div>

        <div class="relative" id="tmSlider">
          <div class="overflow-hidden">
            <div class="tm-track flex" :style="{ transform: `translateX(-${testiIndex * (100 / perViewTesti)}%)`, transition: 'transform .6s cubic-bezier(.22,1,.36,1)' }">
              <div 
                v-for="(rv, i) in processedReviews" 
                :key="i"
                class="tm-card flex-shrink-0 px-2.5 w-full sm:w-1/2 lg:w-1/3"
              >
                <div class="bg-white/7 backdrop-blur-sm rounded-2xl p-6 border border-white/15 h-full hover:border-gold/40 hover:bg-white/10 transition-all duration-300 xl:min-h-[280px] flex flex-col justify-between">
                  <div>
                    <div class="flex items-center justify-between mb-3">
                      <div class="flex items-center gap-1 text-[#fbbf24] text-[13px]">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                      <span class="text-[#c8a84e]/40 text-[30px] leading-none">&ldquo;</span>
                    </div>
                    <p class="text-[14px] leading-[1.75] text-white/85 mb-4">"{{ rv.text }}"</p>
                  </div>
                  <div class="flex items-center gap-3 mt-auto">
                    <div class="w-11 h-11 rounded-full font-bold flex items-center justify-center text-[15px] shrink-0" :class="rv.grad">
                      {{ rv.initials }}
                    </div>
                    <div>
                      <div class="text-[14px] font-bold text-white">{{ rv.name }}</div>
                      <div class="text-[12px] text-white/50">{{ rv.designation }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Arrows -->
          <button class="absolute -left-2 lg:-left-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy" @click="prevTesti" aria-label="Previous">&#10094;</button>
          <button class="absolute -right-2 lg:-right-5 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy" @click="nextTesti" aria-label="Next">&#10095;</button>
        </div>

        <!-- Dots -->
        <div class="flex justify-center gap-2 mt-7">
          <button 
            v-for="(_, i) in maxTestiIndex + 1" 
            :key="i"
            class="w-2.5 h-2.5 rounded-full border-none cursor-pointer transition-all"
            :style="{ background: testiIndex === i ? '#c8a84e' : 'rgba(255,255,255,.3)', width: testiIndex === i ? '26px' : '10px', borderRadius: testiIndex === i ? '4px' : '9999px' }"
            @click="testiIndex = i"
            :aria-label="'Review slide ' + (i + 1)"
          ></button>
        </div>

        <div class="flex items-center justify-center gap-2.5 mt-9 flex-wrap">
          <a href="#tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3 px-7 rounded-[10px] text-[13px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5">&starf; Read All Reviews</a>
          <a :href="appStore.waLink('Hi! I would like to share my experience with Nice In Rome Tour.')" target="_blank" class="inline-flex items-center gap-2 bg-transparent text-white border-2 border-white/25 py-3 px-7 rounded-[10px] text-[13px] font-semibold no-underline transition-all hover:bg-white hover:text-navy">&#128172; Share Your Experience</a>
        </div>
      </div>
    </section>

    <!-- 12. SPECIAL OFFERS / DEALS -->
    <section class="py-20 px-6 bg-cream relative overflow-hidden" id="deals" v-if="dealData">
      <div class="max-w-[1100px] mx-auto relative">
        <div class="bg-gradient-to-br from-[#0b1623] via-[#123052] to-[#0b1623] rounded-[26px] overflow-hidden relative px-8 py-12 lg:px-16 lg:py-14">
          <div class="absolute -top-16 -right-16 w-64 h-64 bg-gold/20 rounded-full blur-3xl"></div>
          <div class="absolute -bottom-20 -left-16 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center relative">
            <div>
              <span class="inline-flex items-center gap-2 bg-gold/15 border border-gold/40 text-gold text-[11px] font-bold tracking-[2px] uppercase py-2 px-4 rounded-full mb-4">
                {{ dealData.badge || '🎉 Limited Time Offer' }}
              </span>
              <h2 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,4vw,42px)] mb-4">
                {{ dealData.title || 'Explore Rome & Save 15%' }}
              </h2>
              <p class="text-[15px] text-white/70 leading-[1.8] mb-6">
                {{ dealData.description || 'Book any featured tour before the end of the month and unlock an exclusive discount on your entire booking.' }}
              </p>
              <div class="flex flex-wrap gap-3 items-center">
                <router-link to="/tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3.5 px-8 rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_8px_28px_rgba(200,168,78,.5)]">
                  &#127915; Book Now
                </router-link>
                <a :href="appStore.waLink('Hello! I would like to claim the deal code: ' + (dealData.code || 'ROME15'))" target="_blank" class="inline-flex items-center gap-2 bg-white/10 border border-white/30 text-white py-3.5 px-8 rounded-[10px] text-[14px] font-semibold no-underline transition-all hover:bg-white hover:text-navy">
                  &#128172; WhatsApp A Deal
                </a>
              </div>
            </div>
            <div class="flex justify-center lg:justify-end">
              <div class="bg-white/[0.06] backdrop-blur border border-white/15 rounded-3xl px-9 py-8 text-center w-full max-w-[300px]">
                <p class="text-[13px] text-white/60 font-semibold tracking-[2px] uppercase mb-2">Use Code</p>
                <div class="font-playfair text-[42px] font-extrabold text-gold tracking-[3px] leading-none mb-1">{{ dealData.code || 'ROME15' }}</div>
                <div class="h-px bg-white/15 my-4"></div>
                <p class="text-[12px] text-white/60 mb-1">Valid on all Rome tours</p>
                <p class="text-[12px] text-gold font-semibold" style="font-family:monospace;letter-spacing:1px">{{ dealData.url || 'book.niceinrometour.com/rome15' }}</p>
                <button 
                  @click="copyCode(dealData.code || 'ROME15')" 
                  class="mt-4 w-full bg-gold text-navy border-none py-3 rounded-[10px] text-[13px] font-bold cursor-pointer transition-all hover:bg-gold-light"
                >
                  {{ copyBtnText }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 13. FAQ ACCORDION -->
    <section class="py-20 px-6 bg-white" id="faq" v-if="faqs.length">
      <div class="max-w-[1280px] mx-auto">
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Got Questions?</p>
        <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Frequently Asked Questions</h2>
        <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
        <br><br>
        <div class="max-w-[760px] mx-auto">
          <div 
            v-for="(faq, idx) in faqs" 
            :key="faq.id" 
            class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"
          >
            <button 
              class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream"
              @click="toggleFaq(idx)"
            >
              <span>{{ faq.question }}</span>
              <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform" :style="{ transform: openFaq === idx ? 'rotate(45deg)' : 'rotate(0)' }">+</span>
            </button>
            <div 
              class="faq-answer px-[21px] pb-[19px] text-[14px] text-gray-600 leading-relaxed transition-all"
              v-show="openFaq === idx"
            >
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 14. INSTAGRAM / SOCIAL PROOF -->
    <section class="py-20 px-6 bg-[#0b1623] relative overflow-hidden" id="follow" v-if="galleryList.length">
      <div class="max-w-[1280px] mx-auto relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-[38px]">
          <div>
            <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-3">Follow The Adventure</p>
            <h2 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,4vw,40px)]">{{ company?.insta_handle || '@niceinrometour' }}</h2>
            <div class="w-12 h-[3px] bg-gold rounded-sm mt-5"></div>
          </div>
          <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 bg-white/5 border border-white/15 rounded-[10px] py-2.5 px-4">
              <span class="text-[13px] font-bold text-white">{{ company?.insta_followers || '12.4K' }}</span>
              <span class="text-[12px] text-white/50">Followers</span>
            </div>
            <a :href="company?.instagram || '#'" target="_blank" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] text-white py-2.5 px-5 rounded-[10px] text-[13px] font-bold no-underline transition-all hover:scale-105 hover:shadow-[0_8px_24px_rgba(220,39,67,.35)]">
              <svg width="16" height="16" viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg> Follow Us
            </a>
          </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5">
          <div 
            v-for="(s, i) in galleryList" 
            :key="i"
            @click="openLightbox(i)"
            class="group relative overflow-hidden rounded-xl cursor-pointer"
            :class="s.span || ''"
            :style="{ height: i === 0 ? '100%' : '170px' }"
          >
            <img :src="getImgUrl(s.image)" :alt="s.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <span class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/85 via-transparent to-[#bc1888]/0 opacity-70 group-hover:opacity-90 transition-opacity"></span>
            <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-gradient-to-tr group-hover:from-[#bc1888]/40 group-hover:via-[#dc2743]/25 group-hover:to-[#f09433]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
              <span class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm border border-white/40 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg>
              </span>
            </span>
            <span class="absolute bottom-0 inset-x-0 p-3 flex items-center justify-between">
              <span class="text-[12px] font-bold text-white tracking-wide drop-shadow">{{ s.title }}</span>
              <span class="flex items-center gap-2.5 text-white">
                <span class="flex items-center gap-1 text-[11px]"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-6.7-4.35-9.33-8.11C.9 10.34 1.36 6.6 4.06 5.02 6.9 3.36 9.6 4.42 12 7.1c2.4-2.68 5.1-3.74 7.94-2.08 2.7 1.58 3.16 5.32.39 7.87C18.7 16.65 12 21 12 21z"/></svg>{{ s.likes || 1200 }}</span>
                <span class="flex items-center gap-1 text-[11px]"><svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21a9 9 0 1 1 9-9 9 9 0 0 1-9 9zm0-1.5A7.5 7.5 0 1 0 4.5 12 7.5 7.5 0 0 0 12 19.5zm-3.3-3.5L12 14l3.3 2-.9-3.7 3-2.6-3.9-.3-1.5-3.6-1.5 3.6-3.9.3 3 2.6z"/></svg>{{ s.comments || 150 }}</span>
              </span>
            </span>
          </div>
        </div>

        <div class="text-center mt-8">
          <router-link to="/photo-gallery" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3 px-[34px] rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(200,168,78,.4)] mb-4">
            View All Gallery &#8594;
          </router-link>
          <div>
            <a :href="company?.instagram || '#'" target="_blank" class="text-[13px] font-semibold text-gold no-underline transition-colors hover:text-gold-light">
              Tag {{ company?.insta_handle || '@niceinrometour' }} in your photos to be featured &#8594;
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Lightbox Modal -->
    <div 
      v-if="lightboxOpen" 
      class="fixed inset-0 z-[100] flex items-center justify-center bg-[rgba(5,10,20,.95)] backdrop-blur-sm"
      @click.self="lightboxOpen = false"
    >
      <button class="absolute top-5 right-6 w-11 h-11 rounded-full bg-white/10 border border-white/25 text-white text-xl flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:text-navy" @click="lightboxOpen = false" aria-label="Close">&times;</button>
      <button class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 border border-white/25 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" @click="prevLightbox" aria-label="Previous">&#10094;</button>
      <button class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/10 border border-white/25 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" @click="nextLightbox" aria-label="Next">&#10095;</button>
      <div class="max-w-[900px] w-[92%] mx-auto text-center" v-if="galleryList[lightboxIndex]">
        <img :src="getImgUrl(galleryList[lightboxIndex].image)" :alt="galleryList[lightboxIndex].title" class="max-h-[76vh] w-auto max-w-full rounded-xl shadow-[0_20px_60px_rgba(0,0,0,.6)] mx-auto object-contain"/>
        <div class="text-white font-semibold text-[14px] mt-5 tracking-wide">{{ galleryList[lightboxIndex].title }}</div>
        <div class="text-[12px] text-white/50 mt-1.5">{{ company?.insta_handle || '@niceinrometour' }} · {{ lightboxIndex + 1 }} / {{ galleryList.length }}</div>
      </div>
    </div>

    <!-- 15. CTA BANNER -->
    <section class="bg-navy py-[90px] px-6 text-center relative overflow-hidden" id="cta">
      <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="max-w-[720px] mx-auto relative">
        <span class="inline-flex items-center gap-2 bg-gold/10 border border-gold/40 text-gold text-[11px] font-bold tracking-[3px] uppercase py-2 px-5 rounded-full mb-5">
          {{ company?.cta_badge || '🌍 Ready for Your Roman Holiday?' }}
        </span>
        <h2 class="font-playfair text-white font-bold text-center mb-4 leading-[1.1] text-[clamp(30px,5vw,52px)]">
          {{ company?.cta_title || 'Ready to Explore Rome?' }}
        </h2>
        <p class="text-[16px] text-white/70 text-center max-w-[520px] mx-auto mb-8 leading-[1.8]">
          {{ company?.cta_description || 'Choose your perfect experience and start your Roman adventure today — secure, instant and unforgettable.' }}
        </p>
        <div class="flex gap-[14px] justify-center flex-wrap mb-[30px]">
          <router-link to="/tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-[16px] px-9 rounded-[12px] text-[15px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(201,168,76,.5)]">
            {{ company?.cta_btn1_text || '🎟️ Explore Tours' }}
          </router-link>
          <a :href="appStore.waLink('Hi! I am ready to explore Rome.')" target="_blank" class="inline-flex items-center gap-2 bg-transparent text-white border-2 border-white/40 py-[16px] px-9 rounded-[12px] text-[15px] font-semibold no-underline transition-all hover:border-[#25d366] hover:bg-[#25d366]/10 hover:shadow-[0_10px_30px_rgba(37,211,102,.2)]">
            <svg width="17" height="17" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> {{ company?.cta_btn2_text || 'WhatsApp Us' }}
          </a>
        </div>
        <div class="flex items-center justify-center gap-5 flex-wrap text-[12px] text-white/50">
          <span class="flex items-center gap-1.5">&#128274; Secure Booking</span>
          <span class="w-1 h-1 rounded-full bg-white/30"></span>
          <span class="flex items-center gap-1.5">&#9889; Instant Confirmation</span>
          <span class="w-1 h-1 rounded-full bg-white/30"></span>
          <span class="flex items-center gap-1.5">&#9989; Free Cancellation</span>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue';
import { useRouter } from 'vue-router';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();
const router = useRouter();

const handleAddToCart = (tour) => {
  const status = appStore.addToCart(tour);
  if (status === 'added') {
    appStore.notify(`"${tour.name}" added to cart`, 'success');
  } else {
    appStore.notify('This tour is already in your cart.', 'exists');
  }
};

const currentSlide = ref(0);
const destIndex = ref(0);
const destCardWidth = ref(380);
const activeTourTab = ref('all');
const heroAttraction = ref('');
const heroType = ref('');
const openFaq = ref(0);
const copyBtnText = ref('Copy Code');
const testiIndex = ref(0);
const lightboxOpen = ref(false);
const lightboxIndex = ref(0);

let testiTimer = null;

// Mock Fallbacks matching home.blade.php defaults
const defaultSliders = [
  {
    title: "VATICAN & ROME\nVIP EXPERIENCES",
    subtitle: "Skip-the-line passes, private tours & authentic Italian adventures",
    image: "/uploads/slider/Rome_6a9132df7e458.jpg",
  },
  {
    title: "COLOSSEUM & ANCIENT ROME\nEXCLUSIVE TOURS",
    subtitle: "Walk where gladiators fought with local historian guides",
    image: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg",
  }
];

const defaultDestinations = [
  { id: 1, name: "Colosseum & Arena Floor", slug: "colosseum", description: "Step directly onto the gladiator arena with VIP access.", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg" },
  { id: 2, name: "Vatican Museums & Sistine Chapel", slug: "vatican", description: "Marvel at Michelangelo's iconic frescoes with zero waiting in line.", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg" },
  { id: 3, name: "Borghese Gallery & Gardens", slug: "borghese-gallery", description: "Bernini statues, Caravaggio masterpieces, and serene Roman gardens.", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Galleria_borghese_facade.jpg/960px-Galleria_borghese_facade.jpg" }
];

const defaultCategories = [
  { id: 1, name: "Skip-the-Line Tickets", slug: "skip-the-line-tickets", emoji: "🎟️", subtitle: "Instant Entry →" },
  { id: 2, name: "VIP Guided Tours", slug: "vip-guided-tours", emoji: "🏛️", subtitle: "Small Groups →" },
  { id: 3, name: "Private Tours", slug: "private-tours", emoji: "👑", subtitle: "Personal Guide →" },
  { id: 4, name: "Food & Wine Tours", slug: "food-and-wine", emoji: "🍷", subtitle: "Taste of Italy →" }
];

const defaultWhyChooseUs = [
  { title: "Skip The Line Access", description: "Fast-track tickets to Colosseum, Vatican, and Borghese Gallery.", icon: "⚡" },
  { title: "Expert Local Guides", description: "Licensed historians who bring 2,000+ years of Roman history to life.", icon: "🎓" },
  { title: "Direct WhatsApp Concierge", description: "Instant support, booking confirmations, and local recommendations.", icon: "💬" }
];

const defaultStats = [
  { number: "35,000+", label: "Happy Travellers" },
  { number: "4.8★", label: "Average Rating" },
  { number: "100%", label: "Instant WhatsApp Booking" },
  { number: "12+", label: "Years in Rome" }
];

const defaultTestimonials = [
  { name: "Sarah Jenkins", designation: "London, UK", review: "The skip-the-line Colosseum tour was phenomenal! Our guide Marco was incredibly knowledgeable and booking via WhatsApp was so fast.", rating: 5 },
  { name: "David Miller", designation: "New York, USA", review: "Vatican early morning access was the highlight of our Europe trip. No crowds, seamless communication, highly recommend!", rating: 5 },
  { name: "Elena Rossi", designation: "Milan, Italy", review: "Exceptional service from start to finish. Fast, friendly, and truly authentic Roman experience!", rating: 5 }
];

const defaultFaqs = [
  { question: "How does booking via WhatsApp work?", answer: "Simply select your preferred tour and click WhatsApp. Our concierge confirms your availability, timing, and instantly delivers your confirmation." },
  { question: "Are skip-the-line tickets included in the tours?", answer: "Yes! All our flagship Colosseum and Vatican tours include priority skip-the-line entrance tickets." },
  { question: "What is your cancellation policy?", answer: "We offer free cancellation up to 24 hours before your scheduled tour departure time for maximum flexibility." }
];

// Computed Data
const company = computed(() => appStore.company || appStore.home?.company);
const homeSetting = computed(() => appStore.home?.homeSetting);
const sliders = computed(() => (appStore.home?.sliders?.length ? appStore.home.sliders : defaultSliders));
const activeSlide = computed(() => sliders.value[0]);

const formattedSlideTitle = computed(() => {
  const t = activeSlide.value?.title || 'VATICAN & ROME\nVIP EXPERIENCES';
  if (t.includes('<span') || t.includes('<br')) return t;
  const lines = t.replace(/\n/g, '<br>');
  const words = lines.split(' ');
  if (words.length > 2) {
    const lastTwo = words.slice(-2).join(' ');
    const rest = words.slice(0, -2).join(' ');
    return `${rest} <span class="cst-title-highlight">${lastTwo}</span>`;
  }
  return `<span class="cst-title-highlight">${lines}</span>`;
});

const destinations = computed(() => (appStore.home?.destinations?.length ? appStore.home.destinations : defaultDestinations));
const homeCategories = computed(() => (appStore.home?.homeCategories?.length ? appStore.home.homeCategories : defaultCategories));
const allTours = computed(() => appStore.home?.allTours || appStore.home?.tours || []);
const whyChooseUs = computed(() => (appStore.home?.whyChooseUs?.length ? appStore.home.whyChooseUs : defaultWhyChooseUs));
const services = computed(() => appStore.home?.services || []);
const partners = computed(() => appStore.home?.partners || []);
const blogs = computed(() => appStore.home?.blogs || []);
const faqs = computed(() => (appStore.home?.faqs?.length ? appStore.home.faqs : defaultFaqs));
const rawTestimonials = computed(() => (appStore.home?.testimonials?.length ? appStore.home.testimonials : defaultTestimonials));
const dealData = computed(() => appStore.home?.deals?.[0] || {
  badge: "🎉 Limited Time Offer",
  title: "Explore Rome & Save 15%",
  description: "Book any featured tour before the end of the month and unlock an exclusive discount on your entire booking.",
  code: "ROME15",
  url: "book.niceinrometour.com/rome15"
});
const aboutData = computed(() => appStore.home?.about || {});
const aboutCheckmarks = computed(() => {
  const c = aboutData.value?.checkmarks;
  if (Array.isArray(c)) return c;
  return ['Deep local knowledge of Rome', 'Experienced, licensed guides', 'Authentic, hand-crafted experiences', 'Personalised, concierge service'];
});

const galleryList = computed(() => {
  if (appStore.home?.gallery?.length) return appStore.home.gallery;
  return [
    { title: "Colosseum", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg", likes: 1472, comments: 218, span: "lg:col-span-2 lg:row-span-2" },
    { title: "St. Peter's Basilica", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg", likes: 2034, comments: 322, span: "md:col-span-2 lg:col-span-2" },
    { title: "Vatican Museums", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/VaticanMuseumStaircase.jpg/960px-VaticanMuseumStaircase.jpg", likes: 921, comments: 187 },
    { title: "Trevi Fountain", image: "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Fontana_di_Trevi_by_TC.jpg/960px-Fontana_di_Trevi_by_TC.jpg", likes: 1108, comments: 241 }
  ];
});

const statsList = computed(() => (appStore.home?.stats?.length ? appStore.home.stats : defaultStats));
const tickerLoop = computed(() => [...statsList.value, ...statsList.value, ...statsList.value]);

const displayTours = computed(() => {
  let list = allTours.value;
  if (!list || list.length === 0) {
    return [
      { id: 1, name: "Colosseum, Roman Forum & Palatine Hill Tour", slug: "colosseum-arena-floor-vip-guided-tour", price: "59", duration: "3 Hours", group_size: "Max 12", badge_type: "Bestseller", rating: 4.9, reviews_count: 380, image: "https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg" }
    ];
  }
  if (activeTourTab.value === 'all') return list;
  return list.filter(t => (t.badge_type || '').toLowerCase() === activeTourTab.value.toLowerCase());
});

const processedReviews = computed(() => {
  const grads = ['from-gold to-gold-dark text-navy', 'from-navy to-navy-light text-gold'];
  return rawTestimonials.value.map((tm, idx) => {
    const initials = (tm.name || 'G').split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
    return {
      name: tm.name,
      designation: tm.designation || 'Verified Guest',
      text: tm.review,
      initials,
      grad: grads[idx % 2]
    };
  });
});

const avgRating = computed(() => '4.8');
const totalReviewsCount = computed(() => Math.max(rawTestimonials.value.length, 2300));
const perViewTesti = computed(() => {
  if (typeof window === 'undefined') return 3;
  if (window.innerWidth < 640) return 1;
  if (window.innerWidth < 1024) return 2;
  return 3;
});
const maxTestiIndex = computed(() => Math.max(0, processedReviews.value.length - perViewTesti.value));

// Utility Functions
const getImgUrl = (path) => {
  if (!path) return 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg';
  if (/^https?:\/\//i.test(path)) return path;
  return '/' + path.replace(/^\//, '');
};

const formatDate = (dateStr) => {
  if (!dateStr) return 'Sep 04, 2026';
  try {
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
  } catch {
    return dateStr;
  }
};

const initWowSlider = () => {
  if (typeof window !== 'undefined' && window.jQuery && window.jQuery.fn && window.jQuery.fn.wowSlider) {
    const wsEffects = window.innerWidth <= 768 ? "blur" : "blur,kenburns,louvers,glass_parallax,slices";
    window.jQuery("#wowslider-container1").wowSlider({
      effect: wsEffects,
      prev: "",
      next: "",
      duration: 20 * 100,
      delay: 20 * 100,
      width: 3840,
      height: 2160,
      autoPlay: true,
      autoPlayVideo: false,
      playPause: true,
      stopOnHover: false,
      loop: false,
      bullets: 1,
      caption: true,
      captionEffect: "parallax",
      controls: true,
      controlsThumb: false,
      responsive: 2,
      fullScreen: true,
      gestures: 2,
      onBeforeStep: 0,
      images: 0
    });
  }
};

const nextDest = () => {
  if (destIndex.value < destinations.value.length - 1) {
    destIndex.value++;
  } else {
    destIndex.value = 0;
  }
};
const prevDest = () => {
  if (destIndex.value > 0) {
    destIndex.value--;
  } else {
    destIndex.value = destinations.value.length - 1;
  }
};

const nextTesti = () => {
  if (testiIndex.value < maxTestiIndex.value) {
    testiIndex.value++;
  } else {
    testiIndex.value = 0;
  }
};
const prevTesti = () => {
  if (testiIndex.value > 0) {
    testiIndex.value--;
  } else {
    testiIndex.value = maxTestiIndex.value;
  }
};

const toggleFaq = (idx) => {
  openFaq.value = openFaq.value === idx ? -1 : idx;
};

const copyCode = (code) => {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(code);
    copyBtnText.value = 'Copied!';
    setTimeout(() => {
      copyBtnText.value = 'Copy Code';
    }, 1800);
  }
};

const submitHeroSearch = () => {
  const query = {};
  if (heroAttraction.value) query.attraction = heroAttraction.value;
  if (heroType.value) query.type = heroType.value;
  router.push({ path: '/tours', query });
};

const openLightbox = (i) => {
  lightboxIndex.value = i;
  lightboxOpen.value = true;
};
const nextLightbox = () => {
  lightboxIndex.value = (lightboxIndex.value + 1) % galleryList.value.length;
};
const prevLightbox = () => {
  lightboxIndex.value = (lightboxIndex.value - 1 + galleryList.value.length) % galleryList.value.length;
};

onMounted(() => {
  appStore.loadHome().then(() => {
    nextTick(() => {
      setTimeout(initWowSlider, 200);
    });
  });
  testiTimer = setInterval(nextTesti, 5000);
});

onUnmounted(() => {
  if (testiTimer) clearInterval(testiTimer);
});
</script>

<style>
/* Scoped adjustments ensuring smooth transitions */
.ticker-track {
  animation: marquee 25s linear infinite;
}
@keyframes marquee {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}
.ticker-wrapper:hover .ticker-track {
  animation-play-state: paused;
}

/* Adjust wowslider to sit behind the premium header seamlessly */
#wowslider-container1 {
    display: block !important;
    width: 100%;
    height: 100vh !important;
    min-height: 500px !important;
    z-index: 1;
    margin: 0;
    position: relative;
    overflow: hidden !important;
}
#wowslider-container1::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 55;
    pointer-events: none;
}
#wowslider-container1 .ws_images { height: 100% !important; display: block !important; overflow: hidden !important; }
#wowslider-container1 .ws_images > ul,
#wowslider-container1 .ws_images > ul > li { 
    height: 100% !important; 
    margin: 0 !important;
}
#wowslider-container1 .ws_images > ul > li > img,
#wowslider-container1 .ws_images > ul > li > a > img { 
    height: 100% !important; 
    width: 100% !important; 
    object-fit: cover !important; 
    margin: 0 !important; 
    padding: 0 !important; 
    max-width: none !important; 
    max-height: none !important; 
}
.custom-wow-overlay {
    position: absolute;
    top: 28%;
    left: 8%;
    transform: none;
    z-index: 60;
    width: 90%;
    max-width: 700px;
    pointer-events: none;
}
.custom-slide-text {
    position: relative;
    width: 100%;
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}
.cst-subtitle { font-size: 14px; font-weight: 800; letter-spacing: 3px; color: #ffffff; text-transform: uppercase; margin-bottom: 12px; line-height: 1.2; text-align: left; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
.cst-title { font-family: "Cormorant Garamond", serif; font-size: clamp(40px, 7vw, 75px); font-weight: 900; line-height: 1.05; margin-bottom: 20px; margin-top: 0; text-align: left; color: #ffffff; text-shadow: 0 4px 20px rgba(0,0,0,0.8); }
.cst-title-highlight { background: linear-gradient(135deg, #ffffff 0%, #fde047 30%, #f59e0b 70%, #ffffff 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent; filter: drop-shadow(0px 8px 16px rgba(0,0,0,0.6)); }
.cst-buttons { display: flex; gap: 16px; margin-top: 15px; justify-content: flex-start; }
.cst-btn { font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 32px; border-radius: 50px; pointer-events: auto; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.cst-btn-primary { background: linear-gradient(135deg, #FFD700, #DAA520); color: #000; box-shadow: 0 6px 20px rgba(218, 165, 32, 0.35); border: 1.5px solid #FFD700; }
.cst-btn-primary:hover { background: transparent; color: #FFD700; transform: translateY(-4px); box-shadow: 0 10px 25px rgba(255, 215, 0, 0.2); }
.cst-btn-secondary { background: rgba(255,255,255,0.15); border: 2px solid #ffffff; color: #ffffff; backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.cst-btn-secondary:hover { background: #ffffff; color: #000; transform: translateY(-6px) scale(1.03); box-shadow: 0 15px 40px rgba(255,255,255,0.5); }

/* Mobile Minimized Filter */
.mobile-slide-filter { margin-top: 12px; width: 100%; margin-left: auto; margin-right: auto; padding: 0 10px; }
.msf-form { display: flex; flex-direction: column; gap: 8px; width: 100%; max-width: 270px; margin: 0 auto; align-items: center; background: rgba(11, 22, 35, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.12); padding: 10px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
.msf-selects { display: flex; gap: 8px; width: 100%; justify-content: space-between; }
.msf-select-wrapper { flex: 1; position: relative; }
.msf-select-wrapper::after { content: ''; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="%23333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>'); background-repeat: no-repeat; background-position: center; pointer-events: none; }
.msf-select { width: 100%; background: rgba(255, 255, 255, 0.95); color: #0b1623; font-size: 11px; font-weight: 700; padding: 8px 20px 8px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.8); appearance: none; -webkit-appearance: none; outline: none; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); text-align: left; height: 32px; transition: all 0.3s ease; }
.msf-select:focus { background: #fff; box-shadow: 0 0 0 2px rgba(200, 168, 78, 0.5); }
.msf-btn { background: linear-gradient(135deg, #FFD700, #DAA520); color: #0b1623; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: none; border-radius: 6px; padding: 0 24px; height: 32px; box-shadow: 0 4px 15px rgba(218, 165, 32, 0.4); cursor: pointer; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); margin: 2px 0 0 0; width: max-content; }
.msf-btn:active { transform: scale(0.96); box-shadow: 0 2px 8px rgba(218, 165, 32, 0.3); }
.desktop-global-filter { display: none; }

@media (min-width: 769px) {
    .mobile-slide-filter { display: none !important; }
    .desktop-global-filter { 
        display: block;
        position: relative;
        margin-top: 30px;
        width: 100%;
        max-width: 700px;
        padding: 0; 
        background-color: transparent; 
        z-index: 65;
    }
    .desktop-global-filter .cst-global-form { display: flex; align-items: center; padding: 8px 12px; border-radius: 12px; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: none; }
    .desktop-global-filter .cst-global-select { flex: 1; border: none; background: transparent; outline: none; -webkit-appearance: none; appearance: none; font-size: 14px; padding: 12px 30px 12px 20px; color: #333; cursor: pointer; background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="%23333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>'); background-repeat: no-repeat; background-position: right 10px center; background-size: 14px; }
    .desktop-global-filter .border-right { border-right: 1px solid #eee; }
    .desktop-global-filter .cst-global-btn { background: linear-gradient(135deg, #ddb94e, #c8a84e); border: none; display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; color: #0b1623; box-shadow: 0 2px 8px rgba(200,168,78,0.4); cursor: pointer; transition: transform 0.2s; flex-shrink: 0; }
    .desktop-global-filter .cst-global-btn:active { transform: scale(0.95); }
    .desktop-global-filter .cst-global-btn svg { width: 18px; height: 18px; }
}

@media (max-width: 768px) {
    .hero-section-wrapper { 
        height: 100vh !important; 
        min-height: 600px !important; 
        position: relative;
    }
    #wowslider-container1 { 
        height: 100vh !important; 
        min-height: 600px !important; 
    }
    #wowslider-container1 .ws_images { 
        height: 100% !important; 
    }
    #wowslider-container1 .ws_images ul {
        height: 100% !important; 
    }
    #wowslider-container1 .ws_images ul li {
        height: 100% !important; 
    }
    #wowslider-container1 .ws_images img { 
        height: 100vh !important;
        width: 100% !important; 
        object-fit: cover !important; 
    }
    #wowslider-container1 .ws_images .ws_list,
    #wowslider-container1 .ws_images .ws_effect,
    #wowslider-container1 .ws_images .ws_effect > div { 
        height: 100% !important; 
        background-size: cover !important;
        background-position: center !important; 
    }

    .custom-wow-overlay { 
        top: 24% !important; left: 5% !important; width: 90% !important; 
        padding: 0 !important; display: flex !important; flex-direction: column !important; align-items: center !important; text-align: center !important; 
        box-sizing: border-box !important;
    }
    .cst-title { 
        font-size: 32px !important; margin-bottom: 12px !important; display: block !important; overflow: visible !important; 
        line-height: 1.1 !important; text-align: center !important; 
        width: 100% !important; padding: 0 10px !important; box-sizing: border-box !important;
    }
    .cst-subtitle { 
        font-size: 9.5px !important; margin-bottom: 18px !important; color: #ffffff !important; 
        text-shadow: 0 4px 15px rgba(0,0,0,0.8) !important; text-align: center !important; width: 100% !important; 
        line-height: 1.5 !important; padding: 0 10px !important; box-sizing: border-box !important;
    }
    .cst-buttons { 
        flex-direction: row !important; width: 100% !important; justify-content: center !important; gap: 12px !important; 
        margin-bottom: 0 !important; margin-top: 5px !important; flex-wrap: wrap !important;
    }
    .cst-btn-primary, .cst-btn-secondary { 
        display: inline-flex !important; 
        font-size: 10px !important; 
        padding: 9px 18px !important; 
        background: rgba(255,255,255,0.15) !important; 
        border: 1px solid rgba(255,255,255,0.4) !important; 
        color: #fff !important; 
        backdrop-filter: blur(8px) !important; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
        letter-spacing: 1px !important;
    }
    .cst-btn-primary:hover, .cst-btn-secondary:hover { background: rgba(255,255,255,0.3) !important; }
}

@media (max-width: 768px) {
    .home-view section[style*="background-attachment"] {
        background-attachment: scroll !important;
    }
}

@media (max-width: 480px) {
    #wowslider-container1 { height: 70vh !important; min-height: 360px !important; }
    .hero-section-wrapper { height: 70vh !important; min-height: 360px !important; }
    .custom-wow-overlay { top: 15% !important; left: 4% !important; width: 92% !important; }
    .cst-title { font-size: 24px !important; margin-bottom: 8px !important; }
    .cst-subtitle { font-size: 8px !important; margin-bottom: 12px !important; letter-spacing: 1.5px !important; }
    .cst-buttons { gap: 8px !important; margin-top: 2px !important; }
    .cst-btn { font-size: 9px !important; padding: 8px 14px !important; letter-spacing: 0.5px !important; gap: 5px !important; }
    .home-view > section {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
    #destinations { padding-top: 2rem !important; padding-bottom: 2rem !important; }
}
</style>
