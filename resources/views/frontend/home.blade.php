@extends('layouts.app')

@section('content')

<!-- WOW SLIDER -->
<link rel="stylesheet" type="text/css" href="{{ asset('engine1/style.css') }}" />
<style>
/* Adjust wowslider to sit behind the premium header seamlessly */
#wowslider-container1 {
    display: block !important;
    width: 100%;
    height: 100vh !important; /* Full screen height */
    min-height: 500px !important;
    z-index: 1;
    margin: 0;
    position: relative;
    overflow: hidden !important;
}
/* Permanent smooth dark overlay so transitions don't lose darkness */
#wowslider-container1::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.5); /* Slightly darker for better contrast */
    z-index: 55;
    pointer-events: none;
}
#wowslider-container1 .ws_images { height: 100vh !important; display: block !important; overflow: hidden !important; }
.ws_images ul { height: 100% !important; }
.ws_images ul li { height: 100% !important; position: relative !important; }
.ws_images ul li img { 
    height: 100% !important; width: 100% !important; object-fit: cover !important; 
    margin: 0 !important; padding: 0 !important; 
    position: absolute !important; top: 0 !important; left: 0 !important; 
    max-width: none !important; max-height: none !important; transform: none !important;
}
/* Custom Slider Overlay syncing with WOW Slider */
.custom-wow-overlay {
    position: absolute;
    top: 28%; /* Pushed down to sit cleanly below the header */
    left: 8%;
    transform: none; /* Removed vertical centering */
    z-index: 60;
    width: 90%;
    max-width: 700px;
    pointer-events: none;
}
.custom-slide-text {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    opacity: 0;
    pointer-events: none;
    transform: translateY(30px);
    transition: all 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.cst-subtitle { font-size: 15px; font-weight: 800; letter-spacing: 4px; color: #FFD700; text-transform: uppercase; margin-bottom: 12px; line-height: 1.2; text-align: left; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
.cst-title { font-family: "Playfair Display", serif; font-size: clamp(45px, 6vw, 80px); font-weight: bold; color: white; line-height: 1.1; margin-bottom: 20px; text-shadow: 0 4px 20px rgba(0,0,0,0.8); margin-top: 0; text-align: left; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.cst-heading { font-size: 20px; color: rgba(255,255,255,0.95); margin-bottom: 40px; line-height: 1.6; text-shadow: 0 2px 10px rgba(0,0,0,0.8); margin-top: 0; text-align: left; max-width: 90%; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.cst-buttons { display: flex; gap: 20px; margin-top: 10px; justify-content: flex-start; }
.cst-btn { font-weight: 900; text-decoration: none; display: inline-flex; align-items: center; gap: 12px; padding: 18px 45px; border-radius: 50px; pointer-events: auto; text-transform: uppercase; letter-spacing: 2px; font-size: 15px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.cst-btn-primary { background: linear-gradient(135deg, #FFD700, #DAA520); color: #000; box-shadow: 0 10px 30px rgba(218, 165, 32, 0.5); border: 2px solid #FFD700; }
.cst-btn-primary:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 15px 40px rgba(218, 165, 32, 0.8); background: linear-gradient(135deg, #FFF8DC, #FFD700); color: #000; }
.cst-btn-secondary { background: rgba(255,255,255,0.15); border: 2px solid #ffffff; color: #ffffff; backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.cst-btn-secondary:hover { background: #ffffff; color: #000; transform: translateY(-6px) scale(1.03); box-shadow: 0 15px 40px rgba(255,255,255,0.5); }
/* Premium Filter Section - RomexTours Style */
.cst-filter-section {
    margin-top: 30px;
    width: 100%;
}
.cst-filter-form { 
    display: flex; 
    align-items: center; 
    gap: 15px; 
    flex-wrap: wrap; 
}
.filter-input { 
    background: #f8f9fa; 
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 15px; 
    color: #000; 
    outline: none; 
    cursor: pointer; 
    font-family: inherit; 
    padding: 16px 20px; 
    width: 250px; 
    font-weight: 600; 
    appearance: auto;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.filter-submit-btn {
    background: #09203f; /* Dark Navy */
    color: #fff; 
    border: none;
    padding: 16px 35px; 
    border-radius: 6px; 
    font-weight: 700; 
    cursor: pointer; 
    transition: all 0.3s ease;
    font-size: 16px; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.filter-submit-btn:hover { background: #133866; }
@media (max-width: 768px) {
    .filter-input, .filter-submit-btn { width: 100%; }
    .custom-wow-overlay { top: 15%; left: 5%; width: 90%; }
    .cst-title { font-size: clamp(32px, 8vw, 45px); margin-bottom: 15px; }
    .cst-buttons { flex-direction: row; flex-wrap: wrap; gap: 10px; }
    .cst-btn { width: auto; padding: 12px 20px; font-size: 11px; justify-content: center; flex: 1; min-width: 130px; letter-spacing: 1px; }
    .cst-btn svg { width: 14px; height: 14px; }
}
/* Hide default wowslider titles and controls */
.ws-title { display: none !important; }
#wowslider-container1 a.ws_next,
#wowslider-container1 a.ws_prev,
#wowslider-container1 .ws_playpause { display: none !important; }
</style>

<div id="wowslider-container1">
    <div class="ws_images">
        <ul>
            @foreach($sliders as $idx => $slider)
            <li>
                <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" title="" id="wows1_{{ $idx }}"/>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="ws_bullets">
        <div>
            @foreach($sliders as $idx => $slider)
            <a href="#" title="{{ $slider->title }}"><span>{{ $idx + 1 }}</span></a>
            @endforeach
        </div>
    </div>
    
    <!-- Custom text overlay -->
    <div class="custom-wow-overlay">
        @foreach($sliders as $idx => $slider)
        <div class="custom-slide-text" id="cst-{{ $idx }}">
            <h1 class="cst-title">{!! nl2br(e($slider->title)) !!}</h1>
            <div class="cst-subtitle" style="margin-bottom: 20px;">{{ $slider->subtitle }}</div>
            <div class="cst-buttons" style="margin-bottom: 25px;">
                <a href="#tours" class="cst-btn cst-btn-primary">
                    <svg viewBox='0 0 24 24' width='20' height='20' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z'/><path d='M13 5v2'/><path d='M13 17v2'/><path d='M13 11v2'/></svg> BUY TICKETS
                </a>
                <a href="https://wa.me/1234567890" target="_blank" class="cst-btn cst-btn-secondary">
                    <svg viewBox='0 0 24 24' width='20' height='20' fill='currentColor'><path d='M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z'/></svg> WhatsApp Us
                </a>
            </div>
            
            <!-- RomexTours Style Filter Section -->
            <div class="cst-filter-section">
                <form action="#" method="GET" class="cst-filter-form">
                    <select name="attraction" class="filter-input">
                        <option value="">Select Attraction</option>
                        <option value="colosseum">Colosseum</option>
                        <option value="vatican">Vatican Museums</option>
                        <option value="pantheon">Pantheon</option>
                        <option value="st-peters">St. Peter's Basilica</option>
                    </select>
                    
                    <select name="type" class="filter-input">
                        <option value="">Select...</option>
                        <option value="guided">Guided Tour</option>
                        <option value="audio">Audio Guide</option>
                        <option value="ticket">Entry Ticket</option>
                    </select>

                    <button type="submit" class="filter-submit-btn">Search Tour</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="ws_shadow"></div>
</div>

<script type="text/javascript" src="{{ asset('engine1/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('engine1/wowslider.js') }}"></script>
<script type="text/javascript" src="{{ asset('engine1/script.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var checkInterval = setInterval(function() {
        var bullets = document.querySelectorAll('.ws_bullets a');
        var texts = document.querySelectorAll('.custom-slide-text');
        if(bullets.length > 0 && texts.length > 0) {
            bullets.forEach(function(bull, idx) {
                if(bull.classList.contains('ws_selbull')) {
                    texts.forEach(function(t, i) {
                        if(i === idx) {
                            t.style.opacity = '1';
                            t.style.pointerEvents = 'auto';
                            t.style.transform = 'translateY(0)';
                            t.style.zIndex = '2';
                        } else {
                            t.style.opacity = '0';
                            t.style.pointerEvents = 'none';
                            t.style.transform = 'translateY(20px)';
                            t.style.zIndex = '1';
                        }
                    });
                }
            });
        }
    }, 100);
});
</script>


<!-- STATS TICKER -->
<div class="bg-navy overflow-hidden">
  <div class="ticker-track">
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">35,000+</span> TOURISTS SERVED</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> MOST VISITED MONUMENTS</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> WHATSAPP INSTANT BOOKING</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">7</span> LANGUAGES SPOKEN</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">4.8&#9733;</span> AVERAGE RATING</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">50+</span> CURATED TOURS</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> FREE CANCELLATION</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">24/7</span> SUPPORT</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">35,000+</span> TOURISTS SERVED</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> MOST VISITED MONUMENTS</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> WHATSAPP INSTANT BOOKING</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">7</span> LANGUAGES SPOKEN</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">4.8&#9733;</span> AVERAGE RATING</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">50+</span> CURATED TOURS</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span> FREE CANCELLATION</div>
    <div class="inline-flex items-center gap-2 px-[35px] text-white text-[12px] font-semibold tracking-[1.5px] uppercase whitespace-nowrap"><span class="text-gold text-[9px]">&#10022;</span><span class="text-gold text-[15px] font-bold">24/7</span> SUPPORT</div>
  </div>
</div>



<!-- POPULAR DESTINATIONS -->
<section class="py-8 px-6 relative" id="destinations">
  <div class="dest-bg-img"></div>
  <div class="dest-bg-overlay"></div>
  <div class="max-w-[1280px] mx-auto relative z-10">
    <div class="text-center mb-3">
      <p class="text-[10px] font-bold tracking-[3px] text-gold uppercase mb-1">Best Places For You</p>
      <h2 class="font-playfair text-white font-bold leading-none text-[clamp(24px,3.5vw,38px)] mb-1" style="text-shadow:0 2px 12px rgba(0,0,0,.5)">Popular Destinations</h2>
      <div class="w-8 h-[2px] bg-gold mx-auto mb-1 rounded-sm"></div>
      <p class="text-[13px] text-white/70 max-w-[480px] mx-auto leading-[1.5]">Journey through Rome's storied past, from the majestic Colosseum to the sacred Vatican.</p>
    </div>
  </div>

  <!-- 3-Card Destination Slider -->
  <div class="ds-section" id="dsSection">
    <div class="ds-viewport" id="dsViewport">
      <div class="ds-track" id="dsTrack">
        @foreach($destinations as $dest)
        <div class="ds-card">
          <img src="{{ asset($dest->image) }}" alt="{{ $dest->name }}"/>
          <div class="ds-frame"></div>
          <span class="ds-name">{{ $dest->name }}</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">{{ $dest->description }}</p>
            <a href="{{ $dest->link ?? '#tours' }}" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <button class="ds-arrow ds-arrow-l" id="dsPrev" aria-label="Previous">&#10094;</button>
    <button class="ds-arrow ds-arrow-r" id="dsNext" aria-label="Next">&#10095;</button>
    <div class="ds-dots" id="dsDots"></div>
  </div>
</section>

<!-- TOUR CATEGORIES -->
<section class="py-20 px-6 bg-white" id="categories">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Explore Rome</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Find Your Perfect Tour</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[40px] leading-[1.7]">Browse by theme &mdash; from ancient monuments to candlelit food strolls, there's a Roman adventure for every traveller.</p>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#127963;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Rome City Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">12 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#127858;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Food &amp; Wine Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">6 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#128694;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Walking Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">18 tours &rarr;</span>
      </a>
      <a href="{{ url('/services') }}" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#128663;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Private Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">8 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#127963;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Ancient Rome</h3>
        <span class="text-[12px] text-gold-dark font-semibold">10 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#127769;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Night Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">5 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#128106;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Family Friendly</h3>
        <span class="text-[12px] text-gold-dark font-semibold">9 tours &rarr;</span>
      </a>
      <a href="#tours" class="group bg-cream rounded-2xl border border-cream-dark p-6 text-center no-underline transition-all duration-300 hover:-translate-y-1.5 hover:border-gold hover:bg-[#fbf4e3] hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]">
        <div class="w-[54px] h-[54px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-3.5 text-[26px] transition-transform duration-300 group-hover:scale-110">&#128332;</div>
        <h3 class="font-playfair text-[16px] font-bold text-navy mb-1">Vatican Tours</h3>
        <span class="text-[12px] text-gold-dark font-semibold">7 tours &rarr;</span>
      </a>
    </div>
  </div>
</section>

<!-- TOURS SECTION -->
<section id="tours" class="py-20 px-6 bg-cream">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Curated Experiences</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Discover Rome's Best Experiences</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">Hand-picked tours led by Rome's top licensed guides &mdash; bookable instantly via WhatsApp.</p>
    <div class="flex gap-2.5 justify-center flex-wrap mb-[30px]">
      <button class="py-[9px] px-5 rounded-full border-[1.5px] border-cream-dark bg-white text-[13px] font-semibold text-[#6b7280] cursor-pointer transition-all ft active" onclick="ft2('all',this)">All Tours</button>
      <button class="py-[9px] px-5 rounded-full border-[1.5px] border-cream-dark bg-white text-[13px] font-semibold text-[#6b7280] cursor-pointer transition-all ft" onclick="ft2('bestseller',this)">Bestsellers</button>
      <button class="py-[9px] px-5 rounded-full border-[1.5px] border-cream-dark bg-white text-[13px] font-semibold text-[#6b7280] cursor-pointer transition-all ft" onclick="ft2('new',this)">New</button>
      <button class="py-[9px] px-5 rounded-full border-[1.5px] border-cream-dark bg-white text-[13px] font-semibold text-[#6b7280] cursor-pointer transition-all ft" onclick="ft2('popular',this)">Popular</button>
    </div>
    <div class="tour-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[17px] mb-[30px]">
      @foreach($tours as $tour)
      <div class="tour-card bg-[#0b1623] rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="{{ strtolower($tour->badge_type ?? 'popular') }}">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <a href="{{ route('tour.detail', $tour->slug) }}">
            <img src="{{ asset($tour->image ?? 'images/no.png') }}" alt="{{ $tour->name }}" class="w-full h-full object-cover transition-transform duration-300"/>
          </a>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          @if($tour->badge_type)
          <span class="absolute top-3 left-3 {{ $tour->badge_type == 'Bestseller' ? 'bg-gold text-navy' : ($tour->badge_type == 'New' ? 'bg-[#16a34a] text-white' : 'bg-[#f97316] text-white') }} text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px] uppercase">{{ $tour->badge_type }}</span>
          @endif
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <a href="{{ route('tour.detail', $tour->slug) }}" class="no-underline block"><h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px] hover:text-gold transition-colors">{{ $tour->name }}</h3></a>
          
          @if($tour->rating)
          <div class="flex items-center gap-1.5 mb-2.5">
            <span class="text-[#fbbf24] text-[12px]">{!! str_repeat('&#9733;', round($tour->rating)) !!}</span>
            <span class="text-white text-[13px] font-bold">{{ $tour->rating }}</span>
            <span class="text-white text-[12px]">({{ $tour->reviews_count ?? 0 }})</span>
          </div>
          @else
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          @endif
          
          <div class="flex gap-3 mb-3">
            @if($tour->duration)
            <div class="flex items-center gap-1 text-[12px] text-white">&#128336; {{ $tour->duration }}</div>
            @endif
            @if($tour->group_size)
            <div class="flex items-center gap-1 text-[12px] text-white">&#128101; {{ $tour->group_size }}</div>
            @endif
          </div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col">
              @if($tour->old_price && $tour->old_price > $tour->price)
                <span class="text-[12px] text-white/36 line-through">€{{ $tour->old_price }}</span>
                <div class="flex items-baseline gap-1.5">
                  <span class="text-[22px] font-extrabold text-white">€{{ $tour->price }}</span>
                  <span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-{{ round((($tour->old_price - $tour->price)/$tour->old_price)*100) }}%</span>
                </div>
              @else
                <span class="text-[11px] text-white/36">per person</span>
                <div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€{{ $tour->price }}</span></div>
              @endif
              @if($tour->old_price && $tour->old_price > $tour->price)
                <span class="text-[11px] text-white/36">per person</span>
              @endif
            </div>
            <a href="{{ route('tour.detail', $tour->slug) }}" class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase no-underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</a>
          </div>
          <a href="https://wa.me/1234567890?text={{ urlencode('Hello! I want to book the tour: '.$tour->name) }}" target="_blank" class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold no-underline transition-all uppercase tracking-[.5px] hover:border-[#25d366]/60 hover:text-[#25d366] hover:shadow-[0_0_16px_rgba(37,211,102,.15)]"><svg width="15" height="15" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> WhatsApp</a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-1.5"><button class="bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold cursor-pointer transition-all hover:bg-navy hover:text-white" id="smBtn" onclick="showMore()">Show More Tours</button></div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="py-20 px-6 bg-white">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Why Choose Us</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Why Book With Nice In Rome Tour</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">We make your Rome experience extraordinary with personalized service and instant booking.</p>
    <div class="why-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#128172;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">WhatsApp Instant Booking</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Book your tour in seconds — availability confirmed instantly, 24/7. Chat like a friend, not a customer.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127963;&#65039;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Skip the Line Access</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Exclusive priority access to Rome's most visited monuments. No waiting, no stress — just pure history.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127758;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">7 Languages Spoken</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Our expert guides speak Italian, English, Spanish, French, Arabic and more for a truly personal experience.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#9989;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Free Cancellation</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Flexible booking with free cancellation on all tours. Book with confidence — plans change, we understand.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#11088;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">4.8&#9733; Average Rating</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Trusted by 35,000+ happy tourists worldwide. Our reputation is built on unforgettable experiences.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127919;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Small Group Tours</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Intimate small-group experiences that make you feel like a VIP, not just another tourist in the crowd.</p></div>
    </div>
  </div>
</section>

<!-- EXPERIENCE ROME / ABOUT -->
<section class="py-20 px-6 bg-white overflow-hidden">
  <div class="max-w-[1280px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-[50px] items-center">
    <div class="relative">
      <div class="relative rounded-[22px] overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,.2)]">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg" alt="Experience Rome with Nice in Rome Tour" class="w-full h-[420px] object-cover"/>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/50 to-transparent"></div>
        <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
          <div class="bg-white/90 backdrop-blur rounded-2xl px-5 py-3.5 text-center shadow-lg">
            <div class="text-[26px] font-extrabold text-navy leading-none">35K<span class="text-gold-dark text-[18px]">+</span></div>
            <div class="text-[10px] font-semibold text-[#6b7280] tracking-wide uppercase">Happy Travellers</div>
          </div>
          <div class="bg-gold/95 rounded-2xl px-5 py-3.5 text-center shadow-lg">
            <div class="text-[26px] font-extrabold text-navy leading-none">4.8<span class="text-[18px]">&#9733;</span></div>
            <div class="text-[10px] font-semibold text-navy/70 tracking-wide uppercase">Avg. Rating</div>
          </div>
        </div>
      </div>
      <div class="absolute -top-5 -right-4 bg-navy text-gold rounded-[14px] px-4 py-3 text-center shadow-xl rotate-2">
        <div class="text-[20px] font-extrabold leading-none">12<span class="text-[13px]">+</span></div>
        <div class="text-[9px] font-semibold tracking-widest uppercase">Years Exp.</div>
      </div>
    </div>
    <div>
      <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-3">Experience Rome</p>
      <h2 class="font-playfair text-navy font-bold leading-tight mb-5 text-[clamp(28px,4vw,42px)]">See Rome Through The Eyes Of A Local</h2>
      <div class="w-12 h-[3px] bg-gold rounded-sm mb-5"></div>
      <p class="text-[15px] text-[#6b7280] leading-[1.8] mb-6">Nice in Rome Tour is more than a booking service &mdash; we're a family of passionate Roman guides who have spent a decade uncovering the Eternal City's secrets. Every experience is hand-crafted, authentic and personal.</p>
      <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-7">
        <li class="flex items-start gap-2.5"><span class="w-6 h-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center text-[13px] shrink-0 mt-0.5">&#10003;</span><span class="text-[14px] font-medium text-navy">Deep local knowledge of Rome</span></li>
        <li class="flex items-start gap-2.5"><span class="w-6 h-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center text-[13px] shrink-0 mt-0.5">&#10003;</span><span class="text-[14px] font-medium text-navy">Experienced, licensed guides</span></li>
        <li class="flex items-start gap-2.5"><span class="w-6 h-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center text-[13px] shrink-0 mt-0.5">&#10003;</span><span class="text-[14px] font-medium text-navy">Authentic, hand-crafted experiences</span></li>
        <li class="flex items-start gap-2.5"><span class="w-6 h-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center text-[13px] shrink-0 mt-0.5">&#10003;</span><span class="text-[14px] font-medium text-navy">Personalised, concierge service</span></li>
      </ul>
      <div class="flex gap-3.5 flex-wrap">
        <a href="#" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3.5 px-8 rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(200,168,78,.4)]">Discover Our Story &rarr;</a>
        <a href="#tours" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3.5 px-8 rounded-[10px] text-[14px] font-semibold no-underline transition-all hover:bg-navy hover:text-white">Browse All Tours</a>
      </div>
    </div>
  </div>
</section>

<!-- ROME EXPERIENCE PACKAGES -->
<section class="py-20 px-6 bg-[#0b1623] overflow-hidden">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Explore Rome</p>
    <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Rome Experience Packages</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-white/60 text-center max-w-[560px] mx-auto mt-3.5 mb-10 leading-[1.7]">Discover Rome's greatest treasures — handcrafted full-day packages covering the Eternal City's must-see landmarks.</p>
    <div class="pkg-slider-wrap relative">
      <div class="pkg-track flex gap-5 overflow-x-auto scroll-smooth pb-4" id="pkgTrack" style="scrollbar-width:none;-ms-overflow-style:none">
        @foreach($packages as $pkg)
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="{{ asset($pkg->image ?? 'images/no.png') }}" alt="{{ $pkg->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            @if($pkg->badge_label)
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px] uppercase">{{ $pkg->badge_label }}</span>
            @endif
            @if($pkg->badge_icon)
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">{{ $pkg->badge_icon }}</span>
            @endif
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">{{ $pkg->name }}</h3>
            @if($pkg->subtitle)
            <p class="text-[13px] text-white/50 mb-3">{{ $pkg->subtitle }}</p>
            @endif
            <div class="flex flex-wrap gap-1.5 mb-4">
              @if(!empty($pkg->highlights))
                @foreach((array)$pkg->highlights as $highlight)
                <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">{{ $highlight }}</span>
                @endforeach
              @endif
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;{{ $pkg->price }}</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">Book &rarr;</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- Slider Arrows -->
      <button class="pkg-arrow pkg-arrow-l absolute top-1/2 -translate-y-1/2 left-0 w-[42px] h-[42px] rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" onclick="slidePkg(-1)">&#10094;</button>
      <button class="pkg-arrow pkg-arrow-r absolute top-1/2 -translate-y-1/2 right-0 w-[42px] h-[42px] rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" onclick="slidePkg(1)">&#10095;</button>
    </div>
    <!-- Dots -->
    <div class="flex justify-center gap-2 mt-6" id="pkgDots"></div>
  </div>
</section>

<!-- CONCIERGE SERVICES -->
<section class="py-20 px-6 bg-white" id="services">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">More Than Tours</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Travel Services Built Around You</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">Beyond our signature tours, we handle every detail of your Rome stay &mdash; seamless, stress-free, first-class.</p>

    <div class="service-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Luggage Storage -->
      <div class="group bg-cream rounded-2xl overflow-hidden border border-cream-dark transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_18px_44px_rgba(0,0,0,.12)] hover:border-gold/40 cursor-pointer">
        <div class="relative h-[150px] overflow-hidden">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Roma_2013_-_Termini_rail.jpg/960px-Roma_2013_-_Termini_rail.jpg" alt="Luggage storage in Rome" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/70 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-[15px] flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center text-navy text-[17px] shrink-0">&#128718;</div>
          </div>
        </div>
        <div class="p-5">
          <h3 class="font-playfair text-[17px] font-bold text-navy mb-1.5">Luggage Storage</h3>
          <p class="text-[13px] text-[#6b7280] leading-[1.7] mb-3.5">Drop your bags before your tour and explore hands-free. Secure storage right in the heart of the city, open daily.</p>
          <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gold-dark no-underline transition-all group-hover:gap-2.5">Learn more &rarr;</a>
        </div>
      </div>

      <!-- Airport Transfer -->
      <div class="group bg-cream rounded-2xl overflow-hidden border border-cream-dark transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_18px_44px_rgba(0,0,0,.12)] hover:border-gold/40 cursor-pointer">
        <div class="relative h-[150px] overflow-hidden">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Aletti_Fiumicino_-_arrivi_14_(cropped).jpg/960px-Aletti_Fiumicino_-_arrivi_14_(cropped).jpg" alt="Airport transfer in Rome" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/70 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-[15px] flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center text-navy text-[17px] shrink-0">&#9992;&#65039;</div>
          </div>
        </div>
        <div class="p-5">
          <h3 class="font-playfair text-[17px] font-bold text-navy mb-1.5">Airport Transfer</h3>
          <p class="text-[13px] text-[#6b7280] leading-[1.7] mb-3.5">Private, punctual transfers to and from Fiumicino &amp; Ciampino. A chauffeur meets you at arrivals &mdash; no queues, no hassle.</p>
          <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gold-dark no-underline transition-all group-hover:gap-2.5">Learn more &rarr;</a>
        </div>
      </div>

      <!-- Private Taxi -->
      <div class="group bg-cream rounded-2xl overflow-hidden border border-cream-dark transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_18px_44px_rgba(0,0,0,.12)] hover:border-gold/40 cursor-pointer">
        <div class="relative h-[150px] overflow-hidden">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Rome_taxi.jpg/960px-Rome_taxi.jpg" alt="Private taxi service in Rome" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/70 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-[15px] flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center text-navy text-[17px] shrink-0">&#128663;</div>
          </div>
        </div>
        <div class="p-5">
          <h3 class="font-playfair text-[17px] font-bold text-navy mb-1.5">Private Taxi &amp; Transfers</h3>
          <p class="text-[13px] text-[#6b7280] leading-[1.7] mb-3.5">Book a private car for any journey &mdash; hotel-to-hotel, cruise port, or a night out. Fixed fares, professional drivers.</p>
          <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gold-dark no-underline transition-all group-hover:gap-2.5">Learn more &rarr;</a>
        </div>
      </div>

      <!-- Golf Cart Tour -->
      <div class="group bg-cream rounded-2xl overflow-hidden border border-cream-dark transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_18px_44px_rgba(0,0,0,.12)] hover:border-gold/40 cursor-pointer">
        <div class="relative h-[150px] overflow-hidden">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Colosseum_at_blue_hour.jpg/960px-Colosseum_at_blue_hour.jpg" alt="Golf cart tour in Rome" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623]/70 to-transparent"></div>
          <div class="absolute bottom-0 left-0 right-0 p-[15px] flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-lg bg-gold flex items-center justify-center text-navy text-[17px] shrink-0">&#127937;</div>
          </div>
        </div>
        <div class="p-5">
          <h3 class="font-playfair text-[17px] font-bold text-navy mb-1.5">Golf Cart Tours</h3>
          <p class="text-[13px] text-[#6b7280] leading-[1.7] mb-3.5">Glide through the cobbled lanes of the Eternal City in style. A fun, effortless way to see Rome's hidden gems.</p>
          <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-gold-dark no-underline transition-all group-hover:gap-2.5">Learn more &rarr;</a>
        </div>
      </div>
    </div>

    <div class="text-center mt-8">
      <a href="#" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-navy hover:text-white">View All Services &#8594;</a>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="bg-cream py-[58px] px-6">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Our Network</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-[26px] leading-tight text-[clamp(28px,4vw,44px)]">Our Trusted Partners</h2>
    <div class="overflow-hidden">
      <div class="partner-track">
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Vatican Museums</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Borghese Gallery</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Roma Pass</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Trenitalia</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Visit Rome</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Italia.it</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">ENIT</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Colosseo Parco Archeologico</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Musei Vaticani</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Vatican Museums</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Borghese Gallery</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Roma Pass</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Trenitalia</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Visit Rome</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Italia.it</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">ENIT</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Colosseo Parco Archeologico</div>
        <div class="bg-white border-[1.5px] border-cream-dark rounded-xl py-[13px] px-6 text-[13px] font-bold text-navy whitespace-nowrap shrink-0 transition-all hover:border-gold hover:text-gold-dark">Musei Vaticani</div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG -->
<section class="py-20 px-6 bg-cream">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">From the Journal</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Travel Stories &amp; Tips</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">Insider guides, travel tips and stories from Rome's hidden corners.</p>
    <div class="blog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Colosseo_di_Roma_sotterranei.jpg/960px-Colosseo_di_Roma_sotterranei.jpg" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">History</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">The Colosseum's Secret Underground — What Most Tourists Miss</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 15, 2026 &nbsp;&middot;&nbsp; 5 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
      </div>
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Vatican_Museum_Spiral_Staircase.jpg/960px-Vatican_Museum_Spiral_Staircase.jpg" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">Guide</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">Vatican Museums: The Complete Visitor's Guide for 2026</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 10, 2026 &nbsp;&middot;&nbsp; 7 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
      </div>
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">Tips</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">Best Time to Visit Trevi Fountain Without the Crowds</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace?...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 5, 2026 &nbsp;&middot;&nbsp; 4 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-20 px-6 bg-cream relative overflow-hidden" id="reviews">
  <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;)"></div>
  <div class="max-w-[1280px] mx-auto relative z-10">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Loved by Travellers</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">What Our Guests Say</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <div class="flex items-center justify-center gap-2 mt-4 mb-[38px]">
      <span class="text-[18px] font-extrabold text-navy">4.8</span>
      <span class="text-[#fbbf24] text-[15px]">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
      <span class="text-[13px] text-[#6b7280]">Based on 2,300+ verified reviews</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"The Colosseum tour with skip-the-line access was flawless. Mr. J's team made everything effortless — we booked on WhatsApp in under a minute!"</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-gold to-gold-dark text-navy font-bold flex items-center justify-center text-[15px]">EL</div>
          <div><div class="text-[14px] font-bold text-navy">Emily &amp; Luke</div><div class="text-[12px] text-[#9ca3af]">Verified Travellers, UK</div></div>
        </div>
      </div>
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"Vatican Museums at opening was magical. Our guide spoke perfect English and Spanish for my parents. Worth every euro — book it!"</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-navy to-navy-light font-bold text-gold flex items-center justify-center text-[15px]">MC</div>
          <div><div class="text-[14px] font-bold text-navy">Marco &amp; Camila</div><div class="text-[12px] text-[#9ca3af]">Verified Travellers, Spain</div></div>
        </div>
      </div>
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"Free cancellation saved my trip when my flight changed. The team rearranged everything instantly via WhatsApp. Truly premium service."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-gold to-gold-dark text-navy font-bold flex items-center justify-center text-[15px]">SG</div>
          <div><div class="text-[14px] font-bold text-navy">Sarah Green</div><div class="text-[12px] text-[#9ca3af]">Verified Traveller, USA</div></div>
        </div>
      </div>
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"The golf cart tour was the highlight of our honeymoon! Covered more of Rome in one evening than days of walking. So romantic at sunset."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-navy to-navy-light font-bold text-gold flex items-center justify-center text-[15px]">PD</div>
          <div><div class="text-[14px] font-bold text-navy">Priya &amp; Daniel</div><div class="text-[12px] text-[#9ca3af]">Verified Travellers, India / Canada</div></div>
        </div>
      </div>
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"Luggage storage + airport transfer package was genius. We landed, dropped bags, toured the Pantheon, and reached our hotel stress-free."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-gold to-gold-dark text-navy font-bold flex items-center justify-center text-[15px]">HK</div>
          <div><div class="text-[14px] font-bold text-navy">Hiro &amp; Keiko</div><div class="text-[12px] text-[#9ca3af]">Verified Travellers, Japan</div></div>
        </div>
      </div>
      <div class="bg-white rounded-2xl p-6 border border-cream-dark shadow-[0_2px_12px_rgba(0,0,0,.05)] transition-all hover:-translate-y-1 hover:shadow-[0_14px_34px_rgba(0,0,0,.1)]">
        <div class="flex items-center gap-1 text-[#fbbf24] text-[13px] mb-3">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="text-[14px] leading-[1.75] text-[#4b5563] mb-4">"As a solo traveller I felt completely safe and looked after. The small group size meant the guide could tailor everything to us. 10/10."</p>
        <div class="flex items-center gap-3">
          <div class="w-11 h-11 rounded-full bg-gradient-to-br from-navy to-navy-light font-bold text-gold flex items-center justify-center text-[15px]">AB</div>
          <div><div class="text-[14px] font-bold text-navy">Aisha B.</div><div class="text-[12px] text-[#9ca3af]">Verified Traveller, Australia</div></div>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center gap-2.5 mt-9">
      <a href="#" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3 px-7 rounded-[10px] text-[13px] font-bold no-underline transition-all hover:bg-gold-dark hover:-translate-y-0.5">&starf; Read All Reviews</a>
      <a href="https://wa.me/1234567890" target="_blank" class="inline-flex items-center gap-2 bg-transparent text-navy border-2 border-navy py-3 px-7 rounded-[10px] text-[13px] font-semibold no-underline transition-all hover:bg-navy hover:text-white">&#128172; Share Your Experience</a>
    </div>
  </div>
</section>

<!-- SPECIAL OFFERS / DEALS -->
<section class="py-20 px-6 bg-cream relative overflow-hidden" id="deals">
  <div class="max-w-[1100px] mx-auto relative">
    <div class="bg-gradient-to-br from-[#0b1623] via-[#123052] to-[#0b1623] rounded-[26px] overflow-hidden relative px-8 py-12 lg:px-16 lg:py-14">
      <div class="absolute inset-0 opacity-[0.07] pointer-events-none" style="background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;)"></div>
      <div class="absolute -top-16 -right-16 w-64 h-64 bg-gold/20 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-20 -left-16 w-72 h-72 bg-gold/10 rounded-full blur-3xl"></div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center relative">
        <div>
          <span class="inline-flex items-center gap-2 bg-gold/15 border border-gold/40 text-gold text-[11px] font-bold tracking-[2px] uppercase py-2 px-4 rounded-full mb-4">&#127881; Limited Time Offer</span>
          <h2 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,4vw,42px)] mb-4">Explore Rome &amp; <span class="text-gold">Save 15%</span></h2>
          <p class="text-[15px] text-white/70 leading-[1.8] mb-6">Book any featured tour before the end of the month and unlock an exclusive discount on your entire booking &mdash; seamless, secure and instantly confirmed.</p>
          <div class="flex flex-wrap gap-3 items-center">
            <a href="#tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3.5 px-8 rounded-[10px] text-[14px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_8px_28px_rgba(200,168,78,.5)]">&#127915; Book Now</a>
            <a href="https://wa.me/1234567890" target="_blank" class="inline-flex items-center gap-2 bg-white/10 border border-white/30 text-white py-3.5 px-8 rounded-[10px] text-[14px] font-semibold no-underline transition-all hover:bg-white hover:text-navy">&#128172; WhatsApp A Deal</a>
          </div>
        </div>
        <div class="flex justify-center lg:justify-end">
          <div class="bg-white/[0.06] backdrop-blur border border-white/15 rounded-3xl px-9 py-8 text-center w-full max-w-[300px]">
            <p class="text-[13px] text-white/60 font-semibold tracking-[2px] uppercase mb-2">Use Code</p>
            <div class="font-playfair text-[42px] font-extrabold text-gold tracking-[3px] leading-none mb-1">ROME15</div>
            <div class="h-px bg-white/15 my-4"></div>
            <p class="text-[12px] text-white/60 mb-1">Valid on all Rome tours</p>
            <p class="text-[12px] text-gold font-semibold" style="font-family:monospace;letter-spacing:1px">book.niceinrometour.com/rome15</p>
            <button onclick="navigator.clipboard.writeText('ROME15');this.textContent='Copied!';setTimeout(()=>this.textContent='Copy Code',1500);" class="mt-4 w-full bg-gold text-navy border-none py-3 rounded-[10px] text-[13px] font-bold cursor-pointer transition-all hover:bg-gold-light">Copy Code</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="py-20 px-6 bg-white" id="faq">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Got Questions?</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Frequently Asked Questions</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <br><br>
    <div class="max-w-[760px] mx-auto">
      <div class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"><button class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream" onclick="fq(this)">How does WhatsApp booking work? <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform">+</span></button><div class="faq-answer">Simply click "WhatsApp Us", send us a message with your preferred tour, date, and number of people. We confirm your booking in seconds — no forms, no waiting, just a friendly chat.</div></div>
      <div class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"><button class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream" onclick="fq(this)">What is your cancellation policy? <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform">+</span></button><div class="faq-answer">All tours offer free cancellation up to 24 hours before the tour starts. Simply message us on WhatsApp to cancel or reschedule — we'll handle it instantly with no questions asked.</div></div>
      <div class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"><button class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream" onclick="fq(this)">Are your tours suitable for families with kids? <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform">+</span></button><div class="faq-answer">Absolutely! Our guides are experienced with families and know how to keep kids engaged with fun stories and facts. Many tours have family discounts — just ask us on WhatsApp!</div></div>
      <div class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"><button class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream" onclick="fq(this)">How many people are in a "small group" tour? <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform">+</span></button><div class="faq-answer">Our small group tours have a maximum of 12 people, ensuring a personal, intimate experience. You can always hear the guide and ask questions comfortably.</div></div>
      <div class="faq-item border-[1.5px] border-cream-dark rounded-xl mb-[10px] overflow-hidden transition-colors"><button class="faq-q w-full bg-white border-none py-[19px] px-[21px] text-left font-inter text-[15px] font-semibold text-navy cursor-pointer flex items-center justify-between gap-[13px] transition-colors hover:bg-cream" onclick="fq(this)">Do I need to print my ticket? <span class="faq-icon text-gold text-[20px] shrink-0 transition-transform">+</span></button><div class="faq-answer">No printing needed! We send your tickets digitally via WhatsApp. Simply show the QR code on your phone at the entrance. Easy, eco-friendly, and hassle-free.</div></div>
    </div>
  </div>
</section>

<!-- INSTAGRAM / SOCIAL PROOF -->
<section class="py-20 px-6 bg-[#0b1623] relative overflow-hidden" id="follow">
  <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;)"></div>
  <div class="max-w-[1280px] mx-auto relative">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-5 mb-[38px]">
      <div>
        <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-3">Follow The Adventure</p>
        <h2 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,4vw,40px)]">@niceinrometour</h2>
        <div class="w-12 h-[3px] bg-gold rounded-sm mt-5"></div>
      </div>
      <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 bg-white/5 border border-white/15 rounded-[10px] py-2.5 px-4"><span class="text-[13px] font-bold text-white">12.4K</span><span class="text-[12px] text-white/50">Followers</span></div>
        <a href="#" target="_blank" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] text-white py-2.5 px-5 rounded-[10px] text-[13px] font-bold no-underline transition-all hover:scale-105 hover:shadow-[0_8px_24px_rgba(220,39,67,.35)]"><svg width="16" height="16" viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg> Follow Us</a>
      </div>
    </div>

    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-2.5">
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/VaticanMuseumStaircase.jpg/960px-VaticanMuseumStaircase.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Fontana_di_Trevi_by_TC.jpg/960px-Fontana_di_Trevi_by_TC.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Galleria_borghese_facade.jpg/960px-Galleria_borghese_facade.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg/960px-Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
      <a href="#" target="_blank" class="group relative overflow-hidden rounded-xl aspect-square">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg/960px-Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg" alt="Instagram" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
        <span class="absolute inset-0 bg-[#bc1888]/0 group-hover:bg-[#bc1888]/30 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100"><svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.4.6.2 1 .5 1.4.9.4.4.7.9.9 1.4.1.4.4 1 .4 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.4 2.2-.2.6-.5 1-.9 1.4-.4.4-.9.7-1.4.9-.4.1-1 .4-2.2.4-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.4-.6-.2-1-.5-1.4-.9-.4-.4-.7-.9-.9-1.4-.1-.4-.4-1-.4-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.4-2.2.2-.6.5-1 .9-1.4.4-.4.9-.7 1.4-.9.4-.1 1-.4 2.2-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.2A6.6 6.6 0 1 0 18.6 12 6.6 6.6 0 0 0 12 5.4zm0 10.9A4.3 4.3 0 1 1 16.3 12 4.3 4.3 0 0 1 12 16.3zm6.9-11.2a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/></svg></span>
      </a>
    </div>

    <div class="text-center mt-8">
      <a href="#" target="_blank" class="text-[13px] font-semibold text-gold no-underline transition-colors hover:text-gold-light">Tag @niceinrometour in your photos to be featured &#8594;</a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="bg-navy py-[90px] px-6 text-center relative overflow-hidden" id="cta">
  <div class="absolute inset-0 opacity-[0.06] pointer-events-none" style="background-image:url(&quot;data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E&quot;)"></div>
  <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="max-w-[720px] mx-auto relative">
    <span class="inline-flex items-center gap-2 bg-gold/10 border border-gold/40 text-gold text-[11px] font-bold tracking-[3px] uppercase py-2 px-5 rounded-full mb-5">&#127759; Ready for Your Roman Holiday?</span>
    <h2 class="font-playfair text-white font-bold text-center mb-4 leading-[1.1] text-[clamp(30px,5vw,52px)]">Ready to <span class="text-gold">Explore Rome</span>?</h2>
    <p class="text-[16px] text-white/70 text-center max-w-[520px] mx-auto mb-8 leading-[1.8]">Choose your perfect experience and start your Roman adventure today &mdash; secure, instant and unforgettable.</p>
    <div class="flex gap-[14px] justify-center flex-wrap mb-[30px]">
      <a href="#tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-[16px] px-9 rounded-[12px] text-[15px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_10px_30px_rgba(201,168,76,.5)]">&#127915; Explore Tours</a>
      <a href="https://wa.me/1234567890" target="_blank" class="inline-flex items-center gap-2 bg-transparent text-white border-2 border-white/40 py-[16px] px-9 rounded-[12px] text-[15px] font-semibold no-underline transition-all hover:border-[#25d366] hover:bg-[#25d366]/10 hover:shadow-[0_10px_30px_rgba(37,211,102,.2)]"><svg width="17" height="17" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg> WhatsApp Us</a>
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

@endsection
