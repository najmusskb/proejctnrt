@extends('layouts.app')

@section('content')
<style>
.service-hero {
    position: relative;
    width: 100%;
    min-height: 420px;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    padding: 110px 6% 60px;
}
.service-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(5,12,25,.92) 0%, rgba(5,12,25,.6) 45%, rgba(5,12,25,.35) 100%);
    z-index: 1;
}
.service-hero-content { position: relative; z-index: 2; max-width: 720px; }
.service-breadcrumb {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12.5px; font-weight: 600; letter-spacing: .5px;
    color: rgba(255,255,255,.7); text-transform: uppercase; margin-bottom: 20px;
}
.service-breadcrumb a { color: #c8a84e; text-decoration: none; }
.service-breadcrumb span.dot { width: 5px; height: 5px; border-radius: 50%; background: #c8a84e; display: inline-block; }
.service-hero-icon {
    width: 64px; height: 64px; border-radius: 16px;
    background: linear-gradient(135deg,#c8a84e,#a58530);
    display: flex; align-items: center; justify-content: center;
    font-size: 30px; margin-bottom: 20px;
    box-shadow: 0 8px 28px rgba(200,168,78,.45);
}
.service-hero-title {
    font-family:'Cormorant Garamond',serif; font-size: clamp(40px,6vw,60px);
    font-weight: 700; color: #fff; line-height: 1.05; margin-bottom: 16px;
    text-shadow: 0 2px 24px rgba(0,0,0,.5);
}
.service-hero-desc { font-size: 16px; color: rgba(255,255,255,.88); line-height: 1.7; max-width: 560px; }
.service-wrap { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
.service-body { padding: 70px 0 40px; }
.service-card {
    background: #fff; border: 1px solid #eef0f3; border-radius: 22px;
    padding: 18px; display: flex; gap: 28px;
    box-shadow: 0 10px 40px rgba(0,0,0,.06);
}
.service-img {
    width: 46%; flex-shrink: 0; border-radius: 16px; overflow: hidden; min-height: 300px;
}
.service-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.service-content { flex: 1; padding: 10px 10px 10px 0; }
.service-label {
    font-size: 11px; font-weight: 800; letter-spacing: 3px; color: #c8a84e;
    text-transform: uppercase; margin-bottom: 12px;
}
.service-content h2 {
    font-family:'Cormorant Garamond',serif; font-size: clamp(24px,3vw,34px);
    font-weight: 700; color: #0b1623; margin: 0 0 4px; line-height: 1.15;
}
.service-content .gold-line { width: 50px; height: 3px; background: #c8a84e; border-radius: 3px; margin-bottom: 20px; }
.service-content .rich { font-size: 15px; color: #4b5563; line-height: 1.85; }
.service-content .rich h1,.service-content .rich h2,.service-content .rich h3{
    font-family:'Cormorant Garamond',serif; color: #0b1623; margin: 22px 0 10px;
}
.service-content .rich p { margin: 0 0 14px; }
.service-content .rich ul,.service-content .rich ol { margin: 0 0 16px; padding-left: 20px; }
.service-content .rich li { margin-bottom: 8px; }
.service-benefits {
    display: grid; grid-template-columns: repeat(2,1fr); gap: 12px; margin-top: 26px;
}
.service-benefit {
    display: flex; align-items: center; gap: 11px;
    background: #f4efe6; border: 1px solid #ecdfc8;
    border-radius: 12px; padding: 12px 15px; font-size: 14px; font-weight: 600; color: #0b1623;
}
.service-benefit .tick {
    width: 24px; height: 24px; border-radius: 50%; background: #c8a84e;
    color: #0b1623; display: flex; align-items: center; justify-content: center; font-size: 12px; flex-shrink: 0;
}
.service-sidebar { margin: 70px 0 0; }
.service-cta {
    background: linear-gradient(135deg,#0b1623,#1a2d45);
    border-radius: 22px; padding: 34px; color: #fff;
    box-shadow: 0 16px 50px rgba(11,22,35,.35); position: relative; overflow: hidden; margin-bottom: 24px;
}
.service-cta::after {
    content: ''; position: absolute; top: -40px; right: -40px; width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(200,168,78,.25), transparent 70%); border-radius: 50%;
}
.service-cta h3 { font-family:'Cormorant Garamond',serif; font-size: 30px; margin: 0 0 8px; position: relative; z-index: 2; }
.service-cta p { font-size: 14.5px; color: rgba(255,255,255,.75); line-height: 1.7; margin: 0 0 22px; position: relative; z-index: 2; }
.service-cta .wa-btn {
    display: inline-flex; align-items: center; gap: 10px;
    background: #25d366; color: #fff; text-decoration: none; font-weight: 700; font-size: 14px;
    padding: 15px 28px; border-radius: 12px; transition: all .3s; position: relative; z-index: 2;
    box-shadow: 0 6px 20px rgba(37,211,102,.35);
}
.service-cta .wa-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(37,211,102,.5); }
.service-contact {
    background: #fff; border: 1px solid #eef0f3; border-radius: 22px; padding: 26px;
    box-shadow: 0 10px 40px rgba(0,0,0,.04);
}
.service-contact h4 { font-family:'Cormorant Garamond',serif; font-size: 20px; color: #0b1623; margin: 0 0 18px; }
.service-contact-item { display: flex; align-items: center; gap: 13px; padding: 11px 0; border-bottom: 1px dashed #eef0f3; }
.service-contact-item:last-child { border-bottom: none; }
.service-contact-item .ic {
    width: 40px; height: 40px; border-radius: 11px; background: #f4efe6;
    color: #a58530; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.service-contact-item .t { font-size: 12px; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
.service-contact-item .v { font-size: 14px; font-weight: 700; color: #0b1623; text-decoration: none; }
.other-services-head {
    text-align: center; max-width: 640px; margin: 0 auto 40px;
}
.other-services-head p { font-size: 11px; font-weight: 800; letter-spacing: 3px; color: #c8a84e; text-transform: uppercase; margin: 0 0 10px; }
.other-services-head h2 { font-family:'Cormorant Garamond',serif; font-size: clamp(28px,4vw,40px); color: #0b1623; font-weight: 700; margin: 0; }
.other-services { padding: 70px 0; background: #fcfaf5; border-top: 1px solid #efe7d5; }
.other-card {
    background: #fff; border: 1px solid #eef0f3; border-radius: 18px; overflow: hidden; cursor: pointer;
    text-decoration: none; display: block; transition: all .35s;
    box-shadow: 0 6px 24px rgba(0,0,0,.05);
}
.other-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,.12); }
.other-card-img { height: 170px; overflow: hidden; position: relative; }
.other-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s; }
.other-card:hover .other-card-img img { transform: scale(1.08); }
.other-card-img::after { content:''; position:absolute; inset:0; background: linear-gradient(to top, rgba(11,22,35,.55), transparent); }
.other-card-ic {
    position: absolute; left: 14px; bottom: -18px; width: 42px; height: 42px; border-radius: 12px;
    background: linear-gradient(135deg,#c8a84e,#a58530); display: flex; align-items: center; justify-content: center;
    font-size: 20px; z-index: 2; box-shadow: 0 6px 18px rgba(200,168,78,.45);
}
.other-card-body { padding: 26px 18px 20px; }
.other-card-body h3 { font-family:'Cormorant Garamond',serif; font-size: 19px; color: #0b1623; font-weight: 700; margin: 0 0 7px; }
.other-card-body p { font-size: 13px; color: #6b7280; line-height: 1.6; margin: 0 0 12px; min-height: 40px; }
.other-card-body .more { font-size: 13px; font-weight: 700; color: #a58530; }
@media (max-width: 900px){
    .service-card { flex-direction: column; }
    .service-img { width: 100%; min-height: 220px; }
    .service-content { padding: 10px 0 0; }
}
@media (max-width: 640px){
    .service-benefits { grid-template-columns: 1fr; }
}
</style>

{{-- HERO --}}
<section class="service-hero" style="background-image:url('{{ $service->image }}')">
  <div class="service-hero-content">
    <nav class="service-breadcrumb">
      <a href="{{ route('index') }}">Home</a>
      <span class="dot"></span>
      <a href="{{ route('index') }}#services">Services</a>
      <span class="dot"></span>
      <span>{{ $service->name }}</span>
    </nav>
    <div class="service-hero-icon">{!! $service->icon !!}</div>
    <h1 class="service-hero-title">{{ $service->name }}</h1>
    <p class="service-hero-desc">{{ $service->short_description }}</p>
  </div>
</section>

{{-- MAIN BODY --}}
<div class="service-body">
  <div class="service-wrap">

    {{-- Main detail card --}}
    <div class="service-card">
      <div class="service-img">
        <img src="{{ $service->image }}" alt="{{ $service->name }}">
      </div>
      <div class="service-content">
        <div class="service-label">About This Service</div>
        <h2>{{ $service->name }}</h2>
        <div class="gold-line"></div>
        <div class="rich">{!! $service->description ?: $service->short_description !!}</div>

        @if($service->description)
        <div class="service-benefits">
          <div class="service-benefit"><span class="tick">&#10003;</span> Licensed &amp; trusted providers</div>
          <div class="service-benefit"><span class="tick">&#10003;</span> Instant confirmation via WhatsApp</div>
          <div class="service-benefit"><span class="tick">&#10003;</span> Flexible, personalised service</div>
          <div class="service-benefit"><span class="tick">&#10003;</span> Best price guarantee</div>
        </div>
        @endif
      </div>
    </div>

    {{-- Sidebar CTA + contact --}}
    <div class="service-sidebar">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
        <div class="md:col-span-2">
          <div class="service-cta">
            <h3>Need this service in Rome?</h3>
            <p>Chat with us on WhatsApp for instant availability, pricing and booking. We usually reply within minutes.</p>
            <a class="wa-btn" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp ?? '1234567890') }}?text={{ urlencode('Hello! I want to enquire about: '.$service->name) }}" target="_blank">
              <svg width="20" height="20" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
              Chat on WhatsApp
            </a>
          </div>
        </div>
        <div>
          <div class="service-contact h-full">
            <h4>Contact Us</h4>
            <div class="service-contact-item">
              <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
              <div><div class="t">Phone</div><a href="tel:{{ preg_replace('/[^0-9]/', '', $company->phone ?? '') }}" class="v">{{ $company->phone ?? '—' }}</a></div>
            </div>
            <div class="service-contact-item">
              <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
              <div><div class="t">Email</div><a href="mailto:{{ $company->email ?? '' }}" class="v">{{ $company->email ?? '—' }}</a></div>
            </div>
            <div class="service-contact-item">
              <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
              <div><div class="t">Based in</div><div class="v">Rome, Italy</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- WHY CHOOSE US --}}
@if($whyChooseUs->count())
<section style="background:url('https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg/960px-Panorama_view_from_the_dome_of_the_St._Peter%27s_Basilica.jpg');background-size:cover;background-position:center;background-attachment:fixed;" class="py-20 px-6 relative">
  <div class="absolute inset-0 bg-[rgba(8,16,30,.88)]"></div>
  <div class="relative max-w-[1280px] mx-auto">
    <div class="text-center mb-10">
      <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-3">Why Book With Us</p>
      <h2 class="font-playfair text-white font-bold text-center leading-tight text-[clamp(28px,4vw,40px)]">Travel With Confidence</h2>
      <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($whyChooseUs as $wcu)
      <div class="bg-white/8 backdrop-blur-sm rounded-2xl py-7 px-6 text-center border border-white/15 transition-all hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(0,0,0,.35)]">
        <div class="w-[60px] h-[60px] bg-gold/15 border border-gold/30 rounded-[15px] flex items-center justify-center mx-auto mb-4 text-[27px]">{!! $wcu->icon !!}</div>
        <h3 class="font-playfair text-[18px] font-bold text-white mb-[9px]">{{ $wcu->title }}</h3>
        <p class="text-[14px] text-white/70 leading-[1.7]">{{ $wcu->description }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- OTHER SERVICES --}}
@if($services->count())
<section class="other-services">
  <div class="service-wrap">
    <div class="other-services-head">
      <p>Explore More</p>
      <h2>More Services We Offer</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach($services as $srv)
      <a href="{{ route('service.detail', $srv->slug) }}" class="other-card">
        <div class="other-card-img"><img src="{{ $srv->image }}" alt="{{ $srv->name }}"></div>
        <div class="other-card-ic">{!! $srv->icon !!}</div>
        <div class="other-card-body">
          <h3>{{ $srv->name }}</h3>
          <p>{{ $srv->short_description }}</p>
          <span class="more">Learn more &rarr;</span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
