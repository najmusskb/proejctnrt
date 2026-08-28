@extends('layouts.app')

@section('content')
<style>
.td-gallery-main img{width:100%;height:100%;object-fit:cover}
.td-thumb{width:100%;height:100%;object-fit:cover;cursor:pointer;transition:opacity .25s,transform .4s}
.td-thumb:hover{opacity:.85;transform:scale(1.04)}
.td-thumb.active{outline:3px solid #c8a84e;outline-offset:-3px;opacity:1}
.it-day{position:relative}
.it-day::before{content:'';position:absolute;left:0;top:4px;width:18px;height:18px;border-radius:50%;background:#fff;border:2.5px solid #c8a84e}
.it-day::after{content:'';position:absolute;left:8.5px;top:26px;bottom:-16px;width:2px;background:#e5d9c0}
.it-day:last-child::after{display:none}
.sticky-book{position:sticky;top:90px}
.bk-step{display:none}
.bk-step.active{display:block}
@keyframes bkFade{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.bk-step.active{animation:bkFade .35s ease}
.faq-a{max-height:0;overflow:hidden;transition:max-height .35s ease}
</style>

{{-- HEADER / BREADCRUMB --}}
<div class="relative bg-navy pt-[120px] pb-12 px-6 overflow-hidden">
  <div class="absolute inset-0 opacity-25" style="background:url('{{ $tour->image ?? '' }}') center/cover no-repeat"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/80 to-navy/40"></div>
  <div class="relative max-w-[1280px] mx-auto">
    <nav class="text-[12px] tracking-wide text-gold mb-4">
      <a href="{{ route('index') }}" class="text-white/60 no-underline hover:text-gold transition-colors">Home</a>
      <span class="mx-2 text-white/40">/</span>
      <a href="{{ route('index') }}#tours" class="text-white/60 no-underline hover:text-gold transition-colors">Tours</a>
      <span class="mx-2 text-white/40">/</span>
      <span class="text-gold">{{ $tour->name }}</span>
    </nav>
    <h1 class="font-playfair text-white font-bold leading-tight text-[clamp(26px,4vw,44px)] max-w-[820px]">{{ $tour->name }}</h1>
    @if($tour->rating)
    <div class="flex items-center flex-wrap gap-3 mt-4">
      <div class="flex items-center gap-1.5">
        <span class="text-[#fbbf24] text-[14px]">{!! str_repeat('&#9733;', round($tour->rating)) !!}</span>
        <span class="text-white text-[15px] font-bold">{{ $tour->rating }}</span>
        <span class="text-white/60 text-[13px]">({{ $tour->reviews_count ?? 0 }} reviews)</span>
      </div>
      <span class="w-px h-4 bg-white/20"></span>
      <span class="text-white/80 text-[13px]">&#128336; {{ $tour->duration ?? '2 hours' }}</span>
      <span class="w-px h-4 bg-white/20"></span>
      <span class="text-white/80 text-[13px]">&#128101; {{ $tour->group_size ?? 'Small group' }}</span>
    </div>
    @endif
  </div>
</div>

{{-- MAIN CONTENT --}}
<div class="max-w-[1280px] mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">
  {{-- LEFT: gallery + details --}}
  <div class="lg:col-span-2 space-y-10">

    {{-- IMAGE GALLERY --}}
    @php
      $galleryBySlug = [
        'colosseum-skip-the-line-guided-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Colosseum-Rome-May-2009.jpg/960px-Colosseum-Rome-May-2009.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Colosseum_of_Rome_and_Roman_forum.jpg/960px-Colosseum_of_Rome_and_Roman_forum.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/1/10/Rome_Colosseum_exterior_1.jpg/960px-Rome_Colosseum_exterior_1.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg/960px-Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg',
        ],
        'vatican-museums-sistine-chapel-morning-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/VaticanMuseumStaircase.jpg/960px-VaticanMuseumStaircase.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Museums_in_the_Vatican_City.jpg/960px-Museums_in_the_Vatican_City.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Sistine_Chapel_-_panoramio.jpg/960px-Sistine_Chapel_-_panoramio.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Direction_to_Sistine_Chapel%2C_Vatican%2C_Italy.jpg/960px-Direction_to_Sistine_Chapel%2C_Vatican%2C_Italy.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Figure_of_a_woman_with_raised_hand%2C_possibly_Sybil_in_the_Sistine_Chapel_at_the_Vatican_LCCN2005696651.jpg/960px-Figure_of_a_woman_with_raised_hand%2C_possibly_Sybil_in_the_Sistine_Chapel_at_the_Vatican_LCCN2005696651.jpg',
        ],
        'roman-forum-palatine-hill-walking-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/2002_Rome_Roman_Forum_%26_Palatine_01.jpg/960px-2002_Rome_Roman_Forum_%26_Palatine_01.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Roman_Forum_%2825854190723%29.jpg/960px-Roman_Forum_%2825854190723%29.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Roman_Forum_from_Palatine_Hill_9-9-16.jpg/960px-Roman_Forum_from_Palatine_Hill_9-9-16.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Roman_Forum_viewed_from_Colosseum_1909.jpg/960px-Roman_Forum_viewed_from_Colosseum_1909.jpg',
        ],
        'golf-cart-tour-of-rome-at-sunset' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg/960px-Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2d/Rome%2C_Italy%2C_Sunset_in_central_Rome.jpg/960px-Rome%2C_Italy%2C_Sunset_in_central_Rome.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Castel_Sant%27Angelo_at_dusk%2C_Rome%2C_Italy.jpg/960px-Castel_Sant%27Angelo_at_dusk%2C_Rome%2C_Italy.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Sunset_on_the_Streets_of_Rome_%287578966218%29.jpg/960px-Sunset_on_the_Streets_of_Rome_%287578966218%29.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Ponte_Vittorio_Emanuele_II_San_Pietro%2C_Rome%2C_Italy.jpg/960px-Ponte_Vittorio_Emanuele_II_San_Pietro%2C_Rome%2C_Italy.jpg',
        ],
        'trevi-fountain-rome-highlights-walking-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Fontana_di_Trevi_by_TC.jpg/960px-Fontana_di_Trevi_by_TC.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Fontaine_Trevi_-_Rome.jpg/960px-Fontaine_Trevi_-_Rome.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/Fontana_di_Trevi_di_notte.JPG/960px-Fontana_di_Trevi_di_notte.JPG',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Fuente_de_Trevi%2C_Roma%2C_Italia%2C_2022-09-15%2C_DD_02.jpg/960px-Fuente_de_Trevi%2C_Roma%2C_Italia%2C_2022-09-15%2C_DD_02.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Trevi_Fountain%2C_Rome%2C_Italy_2_-_May_2007.jpg/960px-Trevi_Fountain%2C_Rome%2C_Italy_2_-_May_2007.jpg',
        ],
        'borghese-gallery-gardens-guided-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Galleria_borghese_facade.jpg/960px-Galleria_borghese_facade.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/VillaBorgheseCasinoUccelliera.jpg/960px-VillaBorgheseCasinoUccelliera.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/Rome_%286259890188%29.jpg/960px-Rome_%286259890188%29.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/A_handbook_of_Rome_and_the_Campagna_%281899%29_%2814765810445%29.jpg/960px-A_handbook_of_Rome_and_the_Campagna_%281899%29_%2814765810445%29.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Eckersberg%2C_CW_-_Parti_i_Villa_Borgheses_have_-_1814.jpeg/960px-Eckersberg%2C_CW_-_Parti_i_Villa_Borgheses_have_-_1814.jpeg',
        ],
        'st-peters-basilica-vatican-dome-tour' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Saint_Peter%27s_Square_from_the_dome.jpg/960px-Saint_Peter%27s_Square_from_the_dome.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/St_Peter%27s_Square%2C_Vatican_City_-_April_2007.jpg/960px-St_Peter%27s_Square%2C_Vatican_City_-_April_2007.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Vatican_City_%28VA%29%2C_Petersdom_--_2013_--_4352.jpg/960px-Vatican_City_%28VA%29%2C_Petersdom_--_2013_--_4352.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Vatican_City_%28VA%29%2C_Petersdom_--_2013_--_4352.jpg/960px-Vatican_City_%28VA%29%2C_Petersdom_--_2013_--_4352.jpg',
        ],
        'rome-in-a-day-colosseum-vatican-combo' => [
          'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg/960px-Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/St_Peter%27s_Square%2C_Vatican_City_-_April_2007.jpg/960px-St_Peter%27s_Square%2C_Vatican_City_-_April_2007.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg',
          'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Colosseum-Rome-May-2009.jpg/960px-Colosseum-Rome-May-2009.jpg',
        ],
      ];
      $gallery = $galleryBySlug[$tour->slug] ?? [$tour->image];
      if (empty($gallery[0])) { $gallery[0] = $tour->image; }
    @endphp
    <div>
      <div class="td-gallery-main rounded-2xl overflow-hidden h-[380px] sm:h-[460px] shadow-[0_12px_40px_rgba(0,0,0,.18)] bg-navy">
        <img id="tdMainImg" src="{{ $gallery[0] }}" alt="{{ $tour->name }}">
      </div>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 mt-3" id="tdThumbs">
        @foreach($gallery as $gi => $img)
        <div class="h-[72px] sm:h-[90px] rounded-xl overflow-hidden"><img class="td-thumb {{ $loop->first ? 'active' : '' }}" data-src="{{ $img }}" src="{{ $img }}" alt="{{ $tour->name }} gallery {{ $gi+1 }}"></div>
        @endforeach
      </div>
    </div>

    {{-- OVERVIEW --}}
    <div>
      <h2 class="font-playfair text-navy text-[24px] font-bold mb-4">Tour Overview</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
      <p class="text-[15px] text-[#4b5563] leading-[1.85]">{{ $tour->description }}</p>
      <p class="text-[15px] text-[#4b5563] leading-[1.85] mt-4">Led by our expert, licensed local guides, this experience is crafted to reveal Rome's hidden gems alongside its iconic landmarks. With skip-the-line access, small groups and a personal approach, you'll leave with stories you'll never forget.</p>
    </div>

    {{-- ITINERARY --}}
    <div>
      <h2 class="font-playfair text-navy text-[24px] font-bold mb-4">Itinerary</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-6"></div>
      <div class="relative">
        <div class="absolute left-[21px] top-2 bottom-2 w-[2px] bg-gradient-to-b from-gold via-gold/40 to-transparent"></div>
        <div class="space-y-2">
          @php
            $steps = [
              ['n'=>'01','t'=>'Meet Your Guide — Meeting Point','d'=>'We\'ll meet at a central, easy-to-find location and introduce you to your expert local guide for the day.','bg'=>'from-gold to-gold-dark','ic'=>'M12 2a5 5 0 00-5 5c0 1.9 1 3.6 2.5 4.6L12 20l2.5-8.4C18 10.6 19 8.9 19 7a5 5 0 00-5-5zm0 7a2 2 0 11 0-4 2 2 0 010 4z'],
              ['n'=>'02','t'=>'Skip-the-Line Entrance','d'=>'Bypass the queues with priority access tickets included, straight into the heart of the site.','bg'=>'from-gold to-gold-dark','ic'=>'M13 2L3 14h7l-1 8 10-12h-7l1-8z'],
              ['n'=>'03','t'=>'Guided Exploration','d'=>'Discover the history, art and legends behind every monument with live commentary from our licensed guide.','bg'=>'from-gold to-gold-dark','ic'=>'M12 3a9 9 0 100 18 9 9 0 000-18zm4 6.8L8.4 15l1.4 2.2L17.4 12 16 9.8z'],
              ['n'=>'04','t'=>'Hidden Gems &amp; Photo Stops','d'=>'We take you off the beaten path to quiet corners and unforgettable viewpoints most visitors miss.','bg'=>'from-gold to-gold-dark','ic'=>'M4 5h3l2-2h6l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2zm12 7a4 4 0 11-8 0 4 4 0 018 0z'],
              ['n'=>'05','t'=>'End With Insider Tips','d'=>'Finish with personalised recommendations for food, shopping and what to see next in Rome.','bg'=>'from-gold to-gold-dark','ic'=>'M12 2a7 7 0 00-4 12.7c.6.5 1 1.6 1 2.3h6c0-.7.4-1.8 1-2.3A7 7 0 0012 2zm-2 16h4v2h-4v-2zm2-12a3 3 0 100 6 3 3 0 000-6z'],
            ];
          @endphp
          @foreach($steps as $i=>$s)
          <div class="relative flex gap-5 pb-2">
            <div class="relative z-10 shrink-0 w-[42px] h-[42px] rounded-full bg-[#0b1623] border border-gold/30 flex items-center justify-center shadow-[0_4px_14px_rgba(200,168,78,.25)]">
              <svg width="19" height="19" viewBox="0 0 24 24" fill="#c8a84e"><path d="{{ $s['ic'] }}"/></svg>
            </div>
            <div class="flex-1 pt-[6px]">
              <span class="inline-block text-[10px] font-bold tracking-[2px] text-gold-dark uppercase mb-1">{{ $s['n'] }}</span>
              <h3 class="text-[15.5px] font-bold text-navy mb-1 leading-snug">{{ $s['t'] }}</h3>
              <p class="text-[13.5px] text-[#6b7280] leading-relaxed">{{ $s['d'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- INCLUDED / NOT INCLUDED --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">
      @php
        $included = [
          ['t'=>'Professional licensed tour guide','i'=>'M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-3.3 0-8 1.7-8 5v3h16v-3c0-3.3-4.7-5-8-5z'],
          ['t'=>'Skip-the-line priority entry tickets','i'=>'M13 2L3 14h7l-1 8 10-12h-7l1-8z'],
          ['t'=>'Small group (max 12 people)','i'=>'M9 11a4 4 0 100-8 4 4 0 000 8zm7-1a3 3 0 100-6 3 3 0 000 6zm-1.5 2.4A6 6 0 002 18v2h14v-2a6.4 6.4 0 00-1.5-5.6zM14 22H2v2h12v-2zm7-4h-4v2h4v-2z'],
          ['t'=>'Headsets to clearly hear your guide','i'=>'M12 1a9 9 0 019 9v4a2 2 0 01-2 2h-2c-1.1 0-2-.9-2-2v-3c0-1.1.9-2 2-2h2v-1a7 7 0 10-14 0v1h2c1.1 0 2 .9 2 2v3c0 1.1-.9 2-2 2h-2a3 3 0 003 3h3v-2H4a1 1 0 01-1-1v-6a9 9 0 019-9z'],
          ['t'=>'Free cancellation up to 24h before','i'=>'M9 16.2l-3.2-3.2-1.4 1.4L9 19 20.6 7.4 19.2 6 9 16.2zM14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM12 12.5A2.5 2.5 0 1114.5 10 2.5 2.5 0 0112 12.5z'],
        ];
        $excluded = [
          ['t'=>'Hotel pickup and drop-off','i'=>'M3 11l9-7 9 7v9a2 2 0 01-2 2H5a2 2 0 01-2-2zM10 21v-6h4v6'],
          ['t'=>'Food and drinks (unless stated)','i'=>'M18 8a3 3 0 00-6 0c0 1 0 1 .3 2H6a3 3 0 010-6 3 3 0 013 3M7 8h3v6a1 1 0 01-1 1 2 2 0 01-2-2M12 8v13h3'],
          ['t'=>'Gratuities for your guide','i'=>'M12 2l2.4 4.9 5.4.8-3.9 3.8.9 5.4-4.8-2.5-4.8 2.5.9-5.4L4.2 7.7l5.4-.8z'],
          ['t'=>'Personal expenses and souvenirs','i'=>'M17 8h1a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2v-9a2 2 0 012-2h1m2-2h6M12 2v4'],
        ];
      @endphp
      <div class="bg-white rounded-2xl border border-cream-dark overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.05)]">
        <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-[#16a34a]/10 to-[#16a34a]/3 border-b border-[#16a34a]/15">
          <span class="w-9 h-9 rounded-full bg-[#16a34a] text-white flex items-center justify-center shrink-0"><svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.2l-3.2-3.2-1.4 1.4L9 19 20.6 7.4 19.2 6 9 16.2z"/></svg></span>
          <h3 class="font-playfair text-navy text-[18px] font-bold">What's Included</h3>
        </div>
        <ul class="p-6 space-y-[13px]">
          @foreach($included as $it)
          <li class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-lg bg-[#16a34a]/10 text-[#16a34a] flex items-center justify-center shrink-0 ring-1 ring-[#16a34a]/20"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $it['i'] }}"/></svg></span>
            <span class="text-[14px] text-[#374151] font-medium leading-snug">{{ $it['t'] }}</span>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="bg-white rounded-2xl border border-cream-dark overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.05)]">
        <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-[#dc2626]/10 to-[#dc2626]/3 border-b border-[#dc2626]/15">
          <span class="w-9 h-9 rounded-full bg-[#dc2626] text-white flex items-center justify-center shrink-0"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6l12 12M18 6L6 18"/></svg></span>
          <h3 class="font-playfair text-navy text-[18px] font-bold">What's Not Included</h3>
        </div>
        <ul class="p-6 space-y-[13px]">
          @foreach($excluded as $it)
          <li class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-lg bg-[#dc2626]/10 text-[#dc2626] flex items-center justify-center shrink-0 ring-1 ring-[#dc2626]/20"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $it['i'] }}"/></svg></span>
            <span class="text-[14px] text-[#374151] font-medium leading-snug">{{ $it['t'] }}</span>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- GOOGLE MAPS --}}
    <div>
      <h2 class="font-playfair text-navy text-[24px] font-bold mb-4">Location &amp; Meeting Point</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
      <div class="rounded-2xl overflow-hidden shadow-[0_12px_36px_rgba(0,0,0,.14)]">
        <iframe src="https://www.google.com/maps?q=Colosseum,Rome&output=embed" width="100%" height="360" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <p class="text-[13px] text-[#6b7280] mt-3 flex items-start gap-2">&#128205; <span>Full meeting point and directions are sent by email and WhatsApp right after you book. A member of our concierge team is available 24/7 for assistance.</span></p>
    </div>

    {{-- CANCELLATION POLICY --}}
    <div>
      <h2 class="font-playfair text-navy text-[24px] font-bold mb-4">Cancellation Policy</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
      <div class="bg-cream border border-cream-dark rounded-2xl p-6 space-y-2.5">
        <div class="flex items-start gap-3"><span class="w-7 h-7 rounded-full bg-[#16a34a]/12 text-[#16a34a] flex items-center justify-center text-[14px] font-bold shrink-0">1</span><p class="text-[14px] text-[#4b5563] leading-relaxed">Full refund if you cancel at least <strong>24 hours</strong> before the experience start time.</p></div>
        <div class="flex items-start gap-3"><span class="w-7 h-7 rounded-full bg-[#16a34a]/12 text-[#16a34a] flex items-center justify-center text-[14px] font-bold shrink-0">2</span><p class="text-[14px] text-[#4b5563] leading-relaxed">No refund for cancellations less than 24 hours before start time or for no-shows.</p></div>
        <div class="flex items-start gap-3"><span class="w-7 h-7 rounded-full bg-[#16a34a]/12 text-[#16a34a] flex items-center justify-center text-[14px] font-bold shrink-0">3</span><p class="text-[14px] text-[#4b5563] leading-relaxed">If we cancel due to weather or unforeseen circumstances, you get a full refund or free reschedule.</p></div>
        <div class="flex items-start gap-3"><span class="w-7 h-7 rounded-full bg-[#16a34a]/12 text-[#16a34a] flex items-center justify-center text-[14px] font-bold shrink-0">4</span><p class="text-[14px] text-[#4b5563] leading-relaxed">Changes to dates or times are free up to 24 hours before, subject to availability.</p></div>
      </div>
    </div>

    {{-- FAQ --}}
    <div>
      <h2 class="font-playfair text-navy text-[24px] font-bold mb-4">Frequently Asked Questions</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
      <div class="space-y-3">
        @php
          $faqs = [
            ['q'=>'Do I need to print my tickets?','a'=>'No. Show the e-ticket or booking confirmation on your phone at the entrance. We also send a WhatsApp confirmation for easy access.'],
            ['q'=>'Is the tour suitable for kids?','a'=>'Absolutely. Our tours are family-friendly with flexible pacing, and children under 5 join free on most experiences.'],
            ['q'=>'What languages are available?','a'=>'We offer tours in English, Italian, Spanish, French, German and Arabic. Please request your preferred language when booking.'],
            ['q'=>'What if it rains on the day?','a'=>'Most of our tours run rain or shine under covered areas. If conditions make the tour unsafe, we offer a full refund or free reschedule.'],
            ['q'=>'How do I get my confirmed booking?','a'=>'You will receive instant confirmation by email and WhatsApp with your meeting point, guide details and a direct contact line.'],
          ];
        @endphp
        @foreach($faqs as $i => $faq)
        <div class="faq-item bg-white rounded-xl border border-cream-dark overflow-hidden">
          <button class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left bg-white cursor-pointer" onclick="tdFaq(this)">
            <span class="text-[14.5px] font-semibold text-navy">{{ $faq['q'] }}</span>
            <span class="faq-icon text-gold-dark text-[20px] font-bold shrink-0 transition-transform">+</span>
          </button>
          <div class="faq-a text-[13.5px] text-[#6b7280] leading-relaxed px-5" style="padding-top:0">{{ $faq['a'] }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- RIGHT: STICKY BOOKING CARD --}}
  <div>
    <div class="sticky-book bg-white rounded-2xl shadow-[0_16px_50px_rgba(0,0,0,.14)] border border-cream-dark overflow-hidden">
      {{-- Price block --}}
      <div class="bg-navy px-6 py-5">
        <div class="flex items-center justify-between flex-wrap gap-2">
          <div>
            @if($tour->old_price && $tour->old_price > $tour->price)
            <span class="text-white/40 text-[13px] line-through">€{{ $tour->old_price }}</span>
            @endif
            <div class="flex items-baseline gap-1.5">
              <span class="text-[30px] font-extrabold text-white">€{{ $tour->price }}</span>
              <span class="text-[13px] text-white/60">/ person</span>
            </div>
            @if($tour->old_price && $tour->old_price > $tour->price)
            <span class="inline-block mt-1 text-[11px] font-bold text-navy bg-[#4ade80] py-0.5 px-2 rounded">Save €{{ $tour->old_price - $tour->price }}</span>
            @endif
          </div>
          @if($tour->rating)
          <div class="text-center bg-white/10 rounded-xl px-3 py-2">
            <div class="text-[17px] font-extrabold text-gold">{{ $tour->rating }}</div>
            <div class="text-[9.5px] text-white/60 tracking-wide uppercase">{{ $tour->reviews_count ?? 0 }} reviews</div>
          </div>
          @endif
        </div>
      </div>

      {{-- Booking steps --}}
      <div class="p-6">
        <div class="flex items-center justify-between mb-5">
          <span class="text-[13px] font-bold text-navy uppercase tracking-wide">{{ $tour->name }}</span>
        </div>

        {{-- STEP 1: AVAILABILITY + DATE --}}
        <div class="bk-step active" id="bkStep1">
          <label class="text-[12px] font-bold text-navy uppercase tracking-wide mb-1.5 block">1. Choose Your Date</label>
          <input type="date" id="bkDate" class="w-full border border-cream-dark rounded-lg px-3.5 py-2.5 text-[14px] outline-none focus:border-gold mb-4" min="{{ date('Y-m-d') }}">
          <p class="text-[12px] text-[#6b7280] mb-4 flex items-center gap-1.5"><span class="text-[#16a34a]">&#11088;</span> Live availability checked instantly</p>
          <button onclick="tdStep(2)" class="w-full bg-gold text-navy border-none py-3.5 rounded-xl text-[14px] font-bold cursor-pointer transition-all hover:bg-gold-light">Continue &#8594;</button>
        </div>

        {{-- STEP 2: TIME --}}
        <div class="bk-step" id="bkStep2">
          <label class="text-[12px] font-bold text-navy uppercase tracking-wide mb-2 block">2. Select a Time Slot</label>
          <div class="grid grid-cols-3 gap-2 mb-4">
            @foreach(['08:30','09:00','10:30','12:00','14:00','15:30'] as $t)
            <button onclick="tdPickTime(this)" class="time-slot border border-cream-dark rounded-lg py-2.5 text-[13px] font-semibold text-navy cursor-pointer transition-all hover:border-gold hover:bg-gold/10">{{ $t }}</button>
            @endforeach
          </div>
          <p class="text-[12px] text-[#6b7280] mb-4">&nbsp;Selling fast — book early to secure your preferred slot</p>
          <div class="flex gap-2">
            <button onclick="tdStep(1)" class="flex-1 bg-transparent text-navy border-2 border-navy py-3 rounded-xl text-[13px] font-bold cursor-pointer">Back</button>
            <button onclick="tdStep(3)" class="flex-1 bg-gold text-navy border-none py-3 rounded-xl text-[13px] font-bold cursor-pointer transition-all hover:bg-gold-light">Continue</button>
          </div>
        </div>

        {{-- STEP 3: GUESTS --}}
        <div class="bk-step" id="bkStep3">
          <label class="text-[12px] font-bold text-navy uppercase tracking-wide mb-2 block">3. Number of Guests</label>
          <div class="border border-cream-dark rounded-xl p-4 mb-2">
            <div class="flex items-center justify-between mb-2">
              <span class="text-[14px] font-semibold text-navy">Adults</span>
              <div class="flex items-center gap-3">
                <button onclick="tdCount('adult',-1)" class="w-8 h-8 rounded-full border border-cream-dark text-navy font-bold cursor-pointer">&#8722;</button>
                <span class="text-[15px] font-bold text-navy w-4 text-center" id="cntAdult">1</span>
                <button onclick="tdCount('adult',1)" class="w-8 h-8 rounded-full border border-cream-dark text-navy font-bold cursor-pointer">+</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-[14px] font-semibold text-navy">Children <span class="text-[11px] text-[#6b7280]">(under 12)</span></span>
              <div class="flex items-center gap-3">
                <button onclick="tdCount('child',-1)" class="w-8 h-8 rounded-full border border-cream-dark text-navy font-bold cursor-pointer">&#8722;</button>
                <span class="text-[15px] font-bold text-navy w-4 text-center" id="cntChild">0</span>
                <button onclick="tdCount('child',1)" class="w-8 h-8 rounded-full border border-cream-dark text-navy font-bold cursor-pointer">+</button>
              </div>
            </div>
          </div>
          <div class="flex items-center justify-between bg-cream rounded-xl px-4 py-3 mb-4">
            <span class="text-[13px] text-[#4b5563]">Total price</span>
            <span class="text-[17px] font-extrabold text-navy" id="bkTotal">€{{ $tour->price }}</span>
          </div>
          <div class="flex gap-2">
            <button onclick="tdStep(2)" class="flex-1 bg-transparent text-navy border-2 border-navy py-3 rounded-xl text-[13px] font-bold cursor-pointer">Back</button>
            <button onclick="tdStep(4)" class="flex-1 bg-gold text-navy border-none py-3 rounded-xl text-[13px] font-bold cursor-pointer transition-all hover:bg-gold-light">Continue</button>
          </div>
        </div>

        {{-- STEP 4: BOKUN WIDGET (PLACEHOLDER) --}}
        <div class="bk-step" id="bkStep4">
          <label class="text-[12px] font-bold text-navy uppercase tracking-wide mb-2 block">4. Secure Payment — Bókun</label>
          <div class="border-2 border-dashed border-gold rounded-xl p-4 mb-2 text-center">
            <div class="w-14 h-14 rounded-full bg-gold/15 flex items-center justify-center mx-auto mb-3 text-[24px]">&#128179;</div>
            <p class="text-[13.5px] text-[#4b5563] leading-relaxed mb-2">Your booking is being securely processed via <strong>Bókun</strong>, our trusted booking platform.</p>
            <p class="text-[12px] text-[#6b7280]">Bókun widget placeholder — connect your Bókun API to enable live availability, secure payment &amp; instant confirmation.</p>
          </div>
          <button onclick="tdStep(3)" class="w-full bg-transparent text-navy border-2 border-navy py-3 rounded-xl text-[13px] font-bold cursor-pointer mb-2">Back</button>
          <a href="https://wa.me/1234567890?text={{ urlencode('Hello! I want to book: '.$tour->name) }}" target="_blank" class="flex items-center justify-center gap-2 w-full bg-[#25D366] text-white border-none py-3.5 rounded-xl text-[14px] font-bold cursor-pointer no-underline transition-all hover:bg-[#1ebe5d]">&#128172; Complete via WhatsApp</a>
        </div>

        {{-- CONFIRMATION (shown after WhatsApp redirect conceptual) --}}
        <div class="bk-step" id="bkConfirm">
          <div class="text-center py-4">
            <div class="w-16 h-16 rounded-full bg-[#16a34a]/12 text-[#16a34a] flex items-center justify-center mx-auto mb-4 text-[30px]">&#10003;</div>
            <h3 class="font-playfair text-navy text-[20px] font-bold mb-2">Booking Request Sent!</h3>
            <p class="text-[13.5px] text-[#6b7280] leading-relaxed mb-4">We've received your request. Our concierge team will confirm availability and send payment details within minutes.</p>
            <button onclick="tdStep(1)" class="w-full bg-gold text-navy border-none py-3 rounded-xl text-[14px] font-bold cursor-pointer">Book Another Tour</button>
          </div>
        </div>
      </div>

      {{-- Trust badges --}}
      <div class="border-t border-cream-dark px-6 py-4 bg-cream">
        <div class="grid grid-cols-3 gap-2 text-center">
          <div><div class="text-[16px] font-extrabold text-navy">4.8&#9733;</div><div class="text-[9.5px] text-[#6b7280] uppercase">Rating</div></div>
          <div><div class="text-[16px] font-extrabold text-navy">35K+</div><div class="text-[9.5px] text-[#6b7280] uppercase">Travellers</div></div>
          <div><div class="text-[16px] font-extrabold text-navy">&#9992;&#65039;</div><div class="text-[9.5px] text-[#6b7280] uppercase">Trusted</div></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- RELATED TOURS --}}
@if($related->count())
<section class="py-16 px-6 bg-cream">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Keep Exploring</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 text-[clamp(26px,3.5vw,38px)]">You May Also Like</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[17px] mt-10">
      @foreach($related as $r)
      <div class="bg-[#0b1623] rounded-2xl overflow-hidden transition-all hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]">
        <a href="{{ route('tour.detail', $r->slug) }}" class="block relative h-[170px] overflow-hidden no-underline">
          <img src="{{ asset($r->image ?? 'images/no.png') }}" alt="{{ $r->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-107"/>
          <div class="absolute inset-0"></div>
          <span class="absolute bottom-3 right-3 bg-gold text-navy text-[12px] font-extrabold py-1 px-2.5 rounded-full">€{{ $r->price }}</span>
        </a>
        <div class="p-4">
          <a href="{{ route('tour.detail', $r->slug) }}" class="no-underline block"><h3 class="text-[14px] font-bold text-white leading-snug min-h-[38px] hover:text-gold transition-colors">{{ $r->name }}</h3></a>
          @if($r->rating)
          <div class="flex items-center gap-1 mt-1.5">
            <span class="text-[#fbbf24] text-[12px]">{!! str_repeat('&#9733;', round($r->rating)) !!}</span>
            <span class="text-white/70 text-[12px]">{{ $r->rating }} ({{ $r->reviews_count ?? 0 }})</span>
          </div>
          @endif
          <a href="{{ route('tour.detail', $r->slug) }}" class="mt-3 inline-block bg-gradient-to-r from-gold to-gold-dark text-navy text-[12px] font-bold py-2 px-4 rounded-lg no-underline transition-all hover:opacity-90">View Tour</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- FINAL CTA --}}
<section class="py-16 px-6 bg-navy">
  <div class="max-w-[800px] mx-auto text-center">
    <h2 class="font-playfair text-white font-bold text-[clamp(26px,4vw,38px)] mb-4">Ready to Experience {{ Str::before($tour->name, ':') ?: 'Rome' }}?</h2>
    <p class="text-white/70 text-[15px] mb-7 leading-relaxed">Book now or chat with our concierge team on WhatsApp for a fully personalised experience.</p>
    <div class="flex gap-3 flex-wrap justify-center">
      <a href="#bkStep1" onclick="document.getElementById('bkStep1') && scrollToBook()" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-4 px-9 rounded-xl text-[14px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(200,168,78,.5)]">&#127915; Book This Tour</a>
      <a href="https://wa.me/1234567890" target="_blank" class="inline-flex items-center gap-2 bg-transparent text-white border-[1.5px] border-white/25 py-4 px-9 rounded-xl text-[14px] font-bold no-underline transition-all hover:border-[#25d366]/60 hover:text-[#25d366]">&#128172; WhatsApp Us</a>
    </div>
  </div>
</section>

<script>
function tdFaq(btn){
  var item=btn.parentElement, icon=btn.querySelector('.faq-icon'), a=item.querySelector('.faq-a');
  var open=a.style.maxHeight && a.style.maxHeight!=='0px';
  document.querySelectorAll('.faq-a').forEach(function(x){x.style.maxHeight='0';});
  document.querySelectorAll('.td-faq-icon').forEach(function(i){i.style.transform='';});
  if(!open){a.style.maxHeight=a.scrollHeight+'px';icon.style.transform='rotate(45deg)';}
}
window.tdPic=function(img){
  if(!img)return;
  document.getElementById('tdMainImg').src=img.dataset.src;
  document.querySelectorAll('.td-thumb').forEach(function(t){t.classList.remove('active');});
  img.classList.add('active');
};
document.addEventListener('DOMContentLoaded',function(){
  var thumbs=document.querySelectorAll('.td-thumb');
  thumbs.forEach(function(t){t.addEventListener('click',function(){window.tdPic(t);});});
});
function tdStep(n){
  document.querySelectorAll('.bk-step').forEach(function(s){s.classList.remove('active');});
  document.getElementById('bkStep'+n).classList.add('active');
  var bookEl=document.querySelector('.sticky-book');
  if(bookEl)bookEl.scrollIntoView({behavior:'smooth',block:'start'});
}
function tdPickTime(btn){
  document.querySelectorAll('.time-slot').forEach(function(t){t.style.background='';t.style.borderColor='';t.style.color='';});
  btn.style.background='rgba(200,168,78,.15)';btn.style.borderColor='#c8a84e';btn.style.color='#a58530';
}
function tdCount(type,delta){
  var id=type==='adult'?'cntAdult':'cntChild';
  var el=document.getElementById(id);
  var val=parseInt(el.textContent)+delta;
  if(val<0)val=0;
  if(type==='adult'&&val<1)val=1;
  el.textContent=val;
  var adults=parseInt(document.getElementById('cntAdult').textContent);
  var children=parseInt(document.getElementById('cntChild').textContent);
  var unit={{ $tour->price }};
  var childPrice=Math.round(unit*0.7);
  document.getElementById('bkTotal').textContent='€'+(adults*unit+children*childPrice);
}
function scrollToBook(){
  var el=document.querySelector('.sticky-book');
  if(el)el.scrollIntoView({behavior:'smooth',block:'start'});
  var d=document.getElementById('bkDate');
  if(d&&!d.value){d.value=new Date().toISOString().split('T')[0];}
}
</script>
@endsection
