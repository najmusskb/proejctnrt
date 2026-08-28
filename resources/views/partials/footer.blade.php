<!-- FOOTER -->
<footer class="bg-[#070e18] text-white pt-16 pb-7 px-6">
  <!-- Top CTA strip -->
  <div class="max-w-[1280px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6 border-b border-white/10 pb-10 mb-10 items-center">
    <div>
      <h3 class="font-playfair text-[22px] font-bold text-white leading-snug mb-1.5">Planning your Roman escape?</h3>
      <p class="text-[14px] text-white/55 leading-[1.7]">Message us on WhatsApp and get a personal itinerary from our Rome experts &mdash; free of charge.</p>
    </div>
    <div class="flex flex-wrap gap-3 lg:justify-end">
      <a href="https://wa.me/{{ isset($content->whatsapp) ? preg_replace('/[^0-9]/','',$content->whatsapp) : '1234567890' }}" target="_blank" class="inline-flex items-center gap-2 bg-[#25d366] text-white border-none py-3.5 px-7 rounded-[11px] text-[14px] font-bold no-underline transition-all hover:bg-[#1fb857] hover:-translate-y-0.5 hover:shadow-[0_8px_24px_rgba(37,211,102,.35)]">
        <svg width="17" height="17" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
        Chat on WhatsApp
      </a>
      <a href="#tours" class="inline-flex items-center gap-2 bg-gold text-navy border-none py-3.5 px-7 rounded-[11px] text-[14px] font-bold no-underline transition-all hover:bg-gold-light hover:-translate-y-0.5">&#128718; Explore Tours</a>
    </div>
  </div>

  <!-- Main footer grid -->
  <div class="footer-grid max-w-[1280px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr] gap-[36px] pb-[40px] border-b border-white/10 mb-[24px]">

    <!-- Brand + contact -->
    <div>
      <div class="flex items-center gap-2.5 mb-3">
        @if(isset($content->logo))
        <img src="{{ asset($content->logo) }}" alt="{{ $content->com_name }}" style="height:42px;width:42px;object-fit:cover;border-radius:11px;">
        @else
        <div style="width:42px;height:42px;border-radius:11px;background:linear-gradient(135deg,#c8a84e,#a58530);display:flex;align-items:center;justify-content:center;color:#0b1623;font-weight:800;">GJ</div>
        @endif
        <div>
          <div class="font-playfair text-[17px] font-bold text-gold leading-tight" style="text-transform:uppercase;">{{ $content->com_name ?? 'Nice In Rome Tour' }}</div>
          <div class="text-[11px] text-white/50">Rome's Premier Tour Partner</div>
        </div>
      </div>
      <p class="text-[13px] leading-[1.7] mb-[18px] text-white/60 max-w-[300px]">Hand-crafted Roman experiences, skip-the-line access and concierge service &mdash; available 24/7 via WhatsApp.</p>
      <ul class="space-y-2.5 list-none">
        @if(isset($content->phone))
        <li class="flex items-start gap-2.5 text-[13px] text-white/75"><span class="text-gold mt-0.5">&#9990;</span><span>{{ $content->phone }}</span></li>
        @endif
        @if(isset($content->email))
        <li class="flex items-start gap-2.5 text-[13px] text-white/75"><span class="text-gold mt-0.5">&#9993;</span><span>{{ $content->email }}</span></li>
        @endif
        @if(isset($content->whatsapp))
        <li class="flex items-start gap-2.5 text-[13px] text-white/75"><span class="text-gold mt-0.5">&#128172;</span><span>{{ $content->whatsapp }}</span></li>
        @endif
        @if(isset($content->address))
        <li class="flex items-start gap-2.5 text-[13px] text-white/75"><span class="text-gold mt-0.5">&#128205;</span><span>{{ $content->address }}</span></li>
        @endif
      </ul>
      <div class="flex gap-2 mt-5">
        <a href="{{ $content->facebook ?? '#' }}" target="_blank" class="w-[34px] h-[34px] bg-white/8 rounded-lg flex items-center justify-center text-white no-underline transition-all hover:bg-[#1877F2]"><svg width="15" height="15" viewBox="0 0 320 512" fill="currentColor"><path d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"/></svg></a>
        <a href="{{ $content->instagram ?? '#' }}" target="_blank" class="w-[34px] h-[34px] bg-white/8 rounded-lg flex items-center justify-center text-white no-underline transition-all hover:bg-[#dc2743]"><svg width="15" height="15" viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a>
        <a href="{{ $content->youtube ?? '#' }}" target="_blank" class="w-[34px] h-[34px] bg-white/8 rounded-lg flex items-center justify-center text-white no-underline transition-all hover:bg-[#FF0000]"><svg width="15" height="15" viewBox="0 0 576 512" fill="currentColor"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg></a>
      </div>
    </div>

    <!-- Quick Links -->
    <div>
      <h4 class="text-[12px] font-bold text-white tracking-[1.2px] uppercase mb-[16px]"><span class="text-gold mr-1.5">&#10022;</span>Quick Links</h4>
      <ul class="list-none space-y-[9px]">
        <li><a href="{{ url('/') }}" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Home</a></li>
        <li><a href="#tours" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Tours</a></li>
        <li><a href="#services" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Services</a></li>
        <li><a href="#about" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">About Us</a></li>
        <li><a href="#contact" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Contact</a></li>
        <li><a href="#faq" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">FAQ</a></li>
      </ul>
    </div>

    <!-- Tour Categories -->
    <div>
      <h4 class="text-[12px] font-bold text-white tracking-[1.2px] uppercase mb-[16px]"><span class="text-gold mr-1.5">&#10022;</span>Tour Categories</h4>
      <ul class="list-none space-y-[9px]">
        <li><a href="#tours" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Vatican Tours</a></li>
        <li><a href="#tours" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Colosseum Tours</a></li>
        <li><a href="#tours" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Food Tours</a></li>
        <li><a href="#tours" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Private Tours</a></li>
      </ul>
      <h4 class="text-[12px] font-bold text-white tracking-[1.2px] uppercase mt-6 mb-[16px]"><span class="text-gold mr-1.5">&#10022;</span>Services</h4>
      <ul class="list-none space-y-[9px]">
        <li><a href="#services" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Luggage Storage</a></li>
        <li><a href="#services" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Airport Transfer</a></li>
        <li><a href="#services" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Private Taxi</a></li>
        <li><a href="#services" class="text-[13px] text-white/65 no-underline transition-all hover:text-gold hover:pl-1">Golf Cart Tours</a></li>
      </ul>
    </div>

    <!-- Contact + Newsletter -->
    <div>
      <h4 class="text-[12px] font-bold text-white tracking-[1.2px] uppercase mb-[16px]"><span class="text-gold mr-1.5">&#10022;</span>Contact Us</h4>
      <ul class="list-none space-y-[9px] mb-6">
        <li class="flex items-start gap-2.5 text-[13px] text-white/65"><span class="text-gold mt-0.5">&#128222;</span><span>{{ $content->phone ?? '+39 06 1234 5678' }}</span></li>
        <li class="flex items-start gap-2.5 text-[13px] text-white/65"><span class="text-gold mt-0.5">&#9993;</span><span>{{ $content->email ?? 'hello@niceinrometour.com' }}</span></li>
        <li class="flex items-start gap-2.5 text-[13px] text-white/65"><span class="text-gold mt-0.5">&#128172;</span><span>{{ $content->whatsapp ?? '+39 333 123 4567' }}</span></li>
        <li class="flex items-start gap-2.5 text-[13px] text-white/65"><span class="text-gold mt-0.5">&#128205;</span><span>{{ $content->address ?? 'Via dei Fori Imperiali 1, Rome, Italy' }}</span></li>
      </ul>
      <h4 class="text-[12px] font-bold text-gold tracking-[1.2px] uppercase mb-[12px]">&#128274; Subscribe for Deals</h4>
      <form class="flex gap-2" onsubmit="document.getElementById('subMsg').style.display='block';this.querySelector('input').value='';return false;">
        <input type="email" placeholder="Your email" class="flex-1 min-w-0 bg-white/6 border border-white/12 rounded-[9px] px-3.5 py-2.5 text-[12.5px] text-white outline-none placeholder-white/30 focus:border-gold/50" style="font-family:inherit"/>
        <button type="submit" class="bg-gold text-navy border-none px-4 rounded-[9px] text-[12px] font-bold cursor-pointer transition-all hover:bg-gold-light whitespace-nowrap">Join</button>
      </form>
      <p class="text-[11.5px] text-white/40 mt-2 mb-0" id="subMsg" style="display:none">&#10003; You're on the list!</p>
    </div>
  </div>

  <!-- Bottom bar -->
  <div class="footer-grid max-w-[1280px] mx-auto text-center">
    <p class="text-[12px] text-white/45">&copy; {{ date('Y') }} {{ $content->com_name ?? 'Nice In Rome Tour' }}. All rights reserved.</p>
  </div>
</footer>
