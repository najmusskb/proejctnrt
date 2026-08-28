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
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=900&q=85&fit=crop" alt="Colosseum"/>
          <div class="ds-frame"></div>
          <span class="ds-name">The Colosseum</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Step into the arena where gladiators once fought. Skip-the-line access included.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1564507592333-c60657eea523?w=900&q=85&fit=crop" alt="Vatican"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Vatican Museums</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Marvel at Michelangelo's Sistine Chapel ceiling and priceless masterpieces.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?w=900&q=85&fit=crop" alt="Trevi Fountain"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Trevi Fountain</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Toss a coin and make a wish at Rome's most iconic Baroque masterpiece.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1604580864964-0462f5d5b1a8?w=900&q=85&fit=crop" alt="Pantheon"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Pantheon</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Awe at the world's largest unreinforced concrete dome — 2000 years old.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1603565816030-6b389eeb23cb?w=900&q=85&fit=crop" alt="Roman Forum"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Roman Forum</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Walk the ancient streets where Caesar once stood and senators debated.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1531572753322-ad063cecc140?w=900&q=85&fit=crop" alt="St Peters"/>
          <div class="ds-frame"></div>
          <span class="ds-name">St. Peter's Basilica</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">The crown jewel of Vatican City — climb the dome for panoramic views.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1529245019870-59b249281fd3?w=900&q=85&fit=crop" alt="Spanish Steps"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Spanish Steps</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Climb 135 steps to the top for stunning views over Piazza di Spagna.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1560717789-0ac7c58ac90a?w=900&q=85&fit=crop" alt="Palatine Hill"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Palatine Hill</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">The birthplace of Rome — explore imperial palaces with breathtaking views.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
        <div class="ds-card">
          <img src="https://images.unsplash.com/photo-1569154941061-e231b4725ef1?w=900&q=85&fit=crop" alt="Piazza Navona"/>
          <div class="ds-frame"></div>
          <span class="ds-name">Piazza Navona</span>
          <div class="ds-bottom-panel">
            <p class="ds-info-desc">Rome's most elegant square — Bernini's Fountain of the Four Rivers awaits.</p>
            <a href="#tours" class="ds-info-btn">View Tours & Tickets</a>
          </div>
        </div>
      </div>
    </div>
    <button class="ds-arrow ds-arrow-l" id="dsPrev" aria-label="Previous">&#10094;</button>
    <button class="ds-arrow ds-arrow-r" id="dsNext" aria-label="Next">&#10095;</button>
    <div class="ds-dots" id="dsDots"></div>
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
    <div class="tour-grid grid grid-cols-4 gap-[17px] mb-[30px]">
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="bestseller">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1553697388-94e804e2de06?w=600&h=400&fit=crop&auto=format" alt="Colosseum" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">BESTSELLER</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Colosseum Skip-the-Line</h3>
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 2 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[11px] text-white/36">per person</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€29</span></div></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="bestseller">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1531572753322-ad063cecc140?w=600&h=400&fit=crop&auto=format" alt="Vatican" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">BESTSELLER</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Vatican Museums &amp; Sistine Chapel</h3>
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 3 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[11px] text-white/36">per person</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€45</span></div></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="popular">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&h=400&fit=crop&auto=format" alt="Pantheon" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-[#f97316] text-white text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">POPULAR</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Pantheon Priority Access</h3>
          <div class="flex items-center gap-1.5 mb-2.5"><span class="text-[#fbbf24] text-[12px]">&#9733;&#9733;&#9733;&#9733;&#9733;</span><span class="text-white text-[13px] font-bold">4.5</span><span class="text-white/46 text-[12px]">(421)</span></div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 1 hour</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[12px] text-white/36 line-through">€22</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€18</span><span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-18%</span></div><span class="text-[11px] text-white/36">per person</span></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="new">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1603565816030-6b389eeb23cb?w=600&h=400&fit=crop&auto=format" alt="Roman Forum" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-[#16a34a] text-white text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">NEW</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Roman Forum &amp; Palatine Hill</h3>
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 2.5 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[11px] text-white/36">per person</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€25</span></div></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="bestseller">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?w=600&h=400&fit=crop&auto=format" alt="Trevi Fountain" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">BESTSELLER</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Trevi Fountain Night Experience</h3>
          <div class="flex items-center gap-1.5 mb-2.5"><span class="text-[#fbbf24] text-[12px]">&#9733;&#9733;&#9733;&#9733;&#9733;</span><span class="text-white text-[13px] font-bold">4.8</span><span class="text-white/46 text-[12px]">(389)</span></div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 1.5 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[12px] text-white/36 line-through">€55</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€45</span><span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-18%</span></div><span class="text-[11px] text-white/36">per person</span></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="popular">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1529245019870-59b249281fd3?w=600&h=400&fit=crop&auto=format" alt="Rome Bus" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-[#f97316] text-white text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">POPULAR</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Rome Hop-On Hop-Off Bus</h3>
          <div class="flex items-center gap-1.5 mb-2.5"><span class="text-[#fbbf24] text-[12px]">&#9733;&#9733;&#9733;&#9733;&#9733;</span><span class="text-white text-[13px] font-bold">4.6</span><span class="text-white/46 text-[12px]">(512)</span></div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; Flexible</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[12px] text-white/36 line-through">€30</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€25</span><span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-17%</span></div><span class="text-[11px] text-white/36">per person</span></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="new">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1546587348-d12660c30c50?w=600&h=400&fit=crop&auto=format" alt="Vatican Basilica" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-[#16a34a] text-white text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">NEW</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Vatican &amp; St. Peter's Basilica Tour</h3>
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 3 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[12px] text-white/36 line-through">€55</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€45</span><span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-18%</span></div><span class="text-[11px] text-white/36">per person</span></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
      <div class="tour-card bg-tour-card rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="bestseller">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1560717789-0ac7c58ac90a?w=600&h=400&fit=crop&auto=format" alt="Colosseum Full" class="w-full h-full object-cover transition-transform duration-300"/>
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">BESTSELLER</span>
          <button class="absolute top-3 right-3 w-[31px] h-[31px] bg-white/15 backdrop-blur-sm border-none rounded-full flex items-center justify-center cursor-pointer text-white text-[15px] transition-colors hover:bg-white/30" onclick="tw(this)">&#9825;</button>
        </div>
        <div class="p-[15px]">
          <h3 class="text-[15px] font-bold text-white mb-2.5 leading-snug min-h-[40px]">Rome: Colosseum, Forum &amp; Palatine Entry</h3>
          <div class="inline-flex items-center gap-1 bg-gold/12 border border-gold/26 text-gold text-[11px] font-semibold py-1 px-2.5 rounded-full mb-2.5">&#10022; New experience</div>
          <div class="flex gap-3 mb-3"><div class="flex items-center gap-1 text-[12px] text-white/56">&#128336; 3 hours</div><div class="flex items-center gap-1 text-[12px] text-white/56">&#128101; Small group</div></div>
          <div class="h-px bg-white/8 mb-3"></div>
          <div class="flex items-center justify-between">
            <div class="flex flex-col"><span class="text-[12px] text-white/36 line-through">€33</span><div class="flex items-baseline gap-1.5"><span class="text-[22px] font-extrabold text-white">€27</span><span class="text-[11px] font-bold text-[#4ade80] bg-[rgba(74,222,128,.1)] py-0.5 px-1.5 rounded">-18%</span></div><span class="text-[11px] text-white/36">per person</span></div>
            <button class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</button>
          </div>
          <button class="flex items-center justify-center gap-[8px] w-full mt-[9px] bg-transparent text-white/70 border-[1.5px] border-white/13 py-2.5 rounded-[10px] text-[12px] font-semibold cursor-pointer transition-all uppercase tracking-[.5px] hover:border-gold/50 hover:text-gold hover:shadow-[0_0_16px_rgba(200,168,78,.12)]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg> Add to Cart</button>
        </div>
      </div>
    </div>
    <div class="text-center mt-1.5"><button class="bg-transparent text-navy border-2 border-navy py-3 px-[34px] rounded-[10px] text-[14px] font-bold cursor-pointer transition-all hover:bg-navy hover:text-white" id="smBtn" onclick="showMore()">Show More Tours</button></div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="py-20 px-6 bg-white">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Why Choose Us</p>
    <h2 class="font-playfair text-navy font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Why Book With Mr. J?</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-[#6b7280] text-center max-w-[560px] mx-auto mt-3.5 mb-[42px] leading-[1.7]">We make your Rome experience extraordinary with personalized service and instant booking.</p>
    <div class="about-search-wrap" id="aboutSearch">
      <button class="about-search-icon" onclick="toggleAboutSearch()" aria-label="Search tours">
        <svg width="22" height="22" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      </button>
      <div class="about-search-bar">
        <svg width="18" height="18" fill="none" stroke="#999" stroke-width="2" viewBox="0 0 24 24" class="shrink-0 ml-1"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" placeholder="Search tours, destinations, experiences..." id="aboutSearchInput"/>
        <button class="search-close" onclick="toggleAboutSearch()">
          <svg width="16" height="16" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
    </div>
    <div class="about-search-overlay" id="aboutOverlay" onclick="toggleAboutSearch()"></div>
    <div class="why-grid grid grid-cols-3 gap-6">
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#128172;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">WhatsApp Instant Booking</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Book your tour in seconds — availability confirmed instantly, 24/7. Chat like a friend, not a customer.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127963;&#65039;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Skip the Line Access</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Exclusive priority access to Rome's most visited monuments. No waiting, no stress — just pure history.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127758;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">7 Languages Spoken</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Our expert guides speak Italian, English, Spanish, French, Arabic and more for a truly personal experience.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#9989;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Free Cancellation</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Flexible booking with free cancellation on all tours. Book with confidence — plans change, we understand.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#11088;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">4.8&#9733; Average Rating</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Trusted by 35,000+ happy tourists worldwide. Our reputation is built on unforgettable experiences.</p></div>
      <div class="bg-cream rounded-2xl py-7 px-6 text-center border border-cream-dark transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.08)]"><div class="w-[60px] h-[60px] bg-navy rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">&#127919;</div><h3 class="font-playfair text-[18px] font-bold text-navy mb-[9px]">Small Group Tours</h3><p class="text-[14px] text-[#6b7280] leading-[1.7]">Intimate small-group experiences that make you feel like a VIP, not just another tourist in the crowd.</p></div>
    </div>
  </div>
</section>

<!-- INTERNATIONAL PACKAGES -->
<section class="py-20 px-6 bg-[#0b1623] overflow-hidden">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Multi-City Adventures</p>
    <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">International Packages</h2>
    <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    <p class="text-[15px] text-white/60 text-center max-w-[560px] mx-auto mt-3.5 mb-10 leading-[1.7]">Explore beyond Rome — curated multi-city packages across Italy &amp; Europe.</p>
    <div class="pkg-slider-wrap relative">
      <div class="pkg-track flex gap-5 overflow-x-auto scroll-smooth pb-4" id="pkgTrack" style="scrollbar-width:none;-ms-overflow-style:none">
        <!-- Package 1 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=600&h=400&fit=crop&auto=format" alt="Venice" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">7 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#127758; 3 Cities</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Florence &rarr; Venice</h3>
            <p class="text-[13px] text-white/50 mb-3">The Classic Italian Trio</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Colosseum</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Uffizi Gallery</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">St. Mark's</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Gondola Ride</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;899</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>
        <!-- Package 2 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1534113414509-0eec2bfb493f?w=600&h=400&fit=crop&auto=format" alt="Amalfi" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">5 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#127754; Coastal</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Amalfi &rarr; Positano</h3>
            <p class="text-[13px] text-white/50 mb-3">Sun, Sea &amp; Italian Coast</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Pompeii</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Ravello</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Boat Tour</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Limoncello</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;749</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>
        <!-- Package 3 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1516483638261-f4dbaf036963?w=600&h=400&fit=crop&auto=format" alt="Tuscany" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">4 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#127806; Wine</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Siena &rarr; Florence</h3>
            <p class="text-[13px] text-white/50 mb-3">Tuscany Wine &amp; Art Trail</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Wine Tasting</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Duomo</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Chianti</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Siena Piazza</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;649</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>
        <!-- Package 4 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=600&h=400&fit=crop&auto=format" alt="Paris" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">10 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#9992; 2 Countries</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Milan &rarr; Paris</h3>
            <p class="text-[13px] text-white/50 mb-3">Italy to France Grand Tour</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Eiffel Tower</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Louvre</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Milan Duomo</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">High-Speed Train</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;1,499</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>
        <!-- Package 5 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=600&h=400&fit=crop&auto=format" alt="Swiss Alps" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">8 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#9968; Alps</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Zurich &rarr; Lucerne</h3>
            <p class="text-[13px] text-white/50 mb-3">Italian Riviera to Swiss Alps</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Matterhorn</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Lake Lucerne</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Glacier Express</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Chocolate Tour</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;1,299</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>

      
        <!-- Package 6 -->
        <div class="pkg-card flex-shrink-0 w-[300px] rounded-2xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm transition-all hover:-translate-y-2 hover:border-gold/40 hover:shadow-[0_16px_40px_rgba(200,168,78,.15)] cursor-pointer group">
          <div class="relative h-[200px] overflow-hidden">
            <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=600&h=400&fit=crop&auto=format" alt="Greek Islands" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b1623] via-transparent to-transparent"></div>
            <span class="absolute top-3 left-3 bg-gold text-navy text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px]">9 DAYS</span>
            <span class="absolute top-3 right-3 bg-white/15 backdrop-blur-sm text-white text-[11px] font-semibold py-1 px-2.5 rounded-full">&#9992; 2 Countries</span>
          </div>
          <div class="p-5">
            <h3 class="font-playfair text-[18px] font-bold text-white mb-1">Rome &rarr; Athens &rarr; Santorini</h3>
            <p class="text-[13px] text-white/50 mb-3">Ancient Wonders &amp; Island Bliss</p>
            <div class="flex flex-wrap gap-1.5 mb-4">
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Acropolis</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Parthenon</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Oia Sunset</span>
              <span class="bg-white/8 text-white/70 text-[11px] py-1 px-2 rounded-full">Island Hop</span>
            </div>
            <div class="flex items-center justify-between pt-3 border-t border-white/10">
              <div><span class="text-white/40 text-[12px]">From</span><span class="text-gold text-[22px] font-extrabold ml-1">&euro;1,199</span><span class="text-white/40 text-[12px]">/person</span></div>
              <span class="text-gold text-[13px] font-semibold">View &rarr;</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Slider Arrows -->
      <button class="pkg-arrow pkg-arrow-l absolute top-1/2 -translate-y-1/2 left-0 w-[42px] h-[42px] rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" onclick="slidePkg(-1)">&#10094;</button>
      <button class="pkg-arrow pkg-arrow-r absolute top-1/2 -translate-y-1/2 right-0 w-[42px] h-[42px] rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center cursor-pointer transition-all hover:bg-gold hover:border-gold hover:text-navy z-10" onclick="slidePkg(1)">&#10095;</button>
    </div>
    <!-- Dots -->
    <div class="flex justify-center gap-2 mt-6" id="pkgDots"></div>
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
    <div class="blog-grid grid grid-cols-3 gap-5">
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://images.unsplash.com/photo-1584479898061-1c3d46c35783?w=600&h=400&fit=crop&auto=format" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">History</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">The Colosseum's Secret Underground — What Most Tourists Miss</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 15, 2026 &nbsp;&middot;&nbsp; 5 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
      </div>
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://images.unsplash.com/photo-1602087594264-e35b170f5016?w=600&h=400&fit=crop&auto=format" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">Guide</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">Vatican Museums: The Complete Visitor's Guide for 2026</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 10, 2026 &nbsp;&middot;&nbsp; 7 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
      </div>
      <div class="blog-card bg-white rounded-2xl overflow-hidden shadow-[0_2px_12px_rgba(0,0,0,.06)] transition-all cursor-pointer hover:-translate-y-1 hover:shadow-[0_12px_30px_rgba(0,0,0,.1)]">
        <div class="blog-card-img h-[194px] overflow-hidden"><img src="https://images.unsplash.com/photo-1564507592333-c60657eea523?w=600&h=400&fit=crop&auto=format" alt="" class="w-full h-full object-cover transition-transform duration-300"/></div>
        <div class="p-[18px]"><span class="text-[11px] font-bold tracking-[1.5px] text-gold-dark uppercase mb-[7px] block">Tips</span><h3 class="font-playfair text-[17px] font-bold text-navy mb-[7px] leading-[1.4]">Best Time to Visit Trevi Fountain Without the Crowds</h3><p class="text-[13px] text-[#6b7280] leading-[1.6] mb-[11px]">The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace?...</p><p class="text-[12px] text-[#6b7280] mb-3">&#128197; Aug 5, 2026 &nbsp;&middot;&nbsp; 4 min read</p><a href="#" class="text-gold-dark font-semibold no-underline text-[13px]">Read More &rarr;</a></div>
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

<!-- CTA -->
<section class="bg-navy py-[78px] px-6 text-center">
  <div class="max-w-[1280px] mx-auto">
    <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase text-center mb-3">Ready to Explore?</p>
    <h2 class="font-playfair text-white font-bold text-center mb-2.5 leading-tight text-[clamp(28px,4vw,44px)]">Start Planning Your Rome Adventure</h2>
    <p class="text-[15px] text-white/68 text-center max-w-[560px] mx-auto mt-3.5 mb-0 leading-[1.7]">Join 35,000+ happy travellers who discovered Rome with Mr. J. Book your perfect tour in seconds via WhatsApp.</p>
    <div class="flex gap-[13px] justify-center flex-wrap mt-[28px]">
      <a href="#tours" class="bg-gold text-navy border-none py-[15px] px-8 rounded-[10px] text-[15px] font-bold cursor-pointer flex items-center gap-2 transition-all no-underline hover:bg-gold-light hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(201,168,76,.4)]">&#127915; Browse All Tours</a>
      <a href="https://wa.me/1234567890" class="bg-transparent text-white border-2 border-white/48 py-[15px] px-8 rounded-[10px] text-[15px] font-semibold cursor-pointer flex items-center gap-2 transition-all no-underline hover:border-white hover:bg-white/10" target="_blank">&#128172; Chat on WhatsApp</a>
    </div>
  </div>
</section>

@endsection
