@extends('layouts.app')

@section('content')

{{-- HEADER / BREADCRUMB --}}
<div class="relative bg-navy pt-[120px] pb-16 px-6 overflow-hidden">
  <div class="absolute inset-0 opacity-25" style="background:url('{{ asset($destination->image ?? 'images/no.png') }}') center/cover no-repeat"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/80 to-navy/40"></div>
  <div class="relative max-w-[1280px] mx-auto text-center">
    <nav class="text-[12px] tracking-wide text-gold mb-4 justify-center flex">
      <a href="{{ route('index') }}" class="text-white/60 no-underline hover:text-gold transition-colors">Home</a>
      <span class="mx-2 text-white/40">/</span>
      <span class="text-gold">{{ $destination->name }}</span>
    </nav>
    <h1 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,5vw,52px)] mb-3">{{ $destination->name }}</h1>
    <p class="text-[15px] text-white/70 max-w-[600px] mx-auto leading-relaxed">{!! $destination->description !!}</p>
  </div>
</div>

{{-- TOURS SECTION --}}
<section class="py-20 px-6 bg-cream min-h-[500px]">
  <div class="max-w-[1280px] mx-auto">
    <div class="mb-10 text-center">
      <p class="text-[11px] font-bold tracking-[3px] text-gold uppercase mb-2">Explore Experiences</p>
      <h2 class="font-playfair text-navy font-bold leading-tight text-[clamp(24px,3.5vw,36px)]">Tours in {{ $destination->name }}</h2>
      <div class="w-12 h-[3px] bg-gold mx-auto mt-3 rounded-sm"></div>
    </div>
    
    @if($tours->count() > 0)
    <div class="tour-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[17px]">
      @foreach($tours as $tour)
      <div class="tour-card bg-[#0b1623] rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,.14)] transition-all cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(0,0,0,.24)]" data-tag="{{ strtolower($tour->badge_type ?? 'popular') }}">
        <div class="tour-card-img relative h-[200px] overflow-hidden">
          <a href="{{ route('tour.detail', $tour->slug) }}">
            <img src="{{ asset($tour->image ?? 'images/no.png') }}" alt="{{ $tour->name }}" class="w-full h-full object-cover transition-transform duration-300"/>
          </a>
          @if($tour->free_cancellation)
          <span class="absolute bottom-3 left-3 bg-[#16a34a] text-white text-[11px] font-bold py-[5px] px-2.5 rounded-full">&#10004; Free cancellation</span>
          @endif
          @if($tour->badge_type)
          <span class="absolute top-3 left-3 {{ $tour->badge_type == 'Bestseller' ? 'bg-gold text-navy' : ($tour->badge_type == 'New' ? 'bg-[#16a34a] text-white' : 'bg-[#f97316] text-white') }} text-[10px] font-extrabold py-1 px-2.5 rounded-full tracking-[0.5px] uppercase">{{ $tour->badge_type }}</span>
          @endif
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
            <div class="flex items-center gap-1.5">
              <span class="text-[14px] text-white/70 font-medium">Start from</span>
              <span class="text-[22px] font-extrabold text-gold">€{{ $tour->price }}</span>
            </div>
            <a href="{{ route('tour.detail', $tour->slug) }}" class="bg-gradient-to-r from-gold to-gold-dark text-navy border-none py-[11px] px-[18px] rounded-[10px] text-[12px] font-bold cursor-pointer transition-all whitespace-nowrap hover:shadow-[0_4px_18px_rgba(200,168,78,.45)] hover:-translate-y-px flex items-center gap-[6px] tracking-[.3px] uppercase no-underline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a5 5 0 0 1 5-5h10a5 5 0 0 1 5 5v0a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5Z"/><path d="M9 12h.01M15 12h.01"/><path d="M9 16c.85.63 1.885 1 3 1s2.15-.37 3-1"/></svg> Book Now</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="text-center py-10 bg-white rounded-2xl border border-cream-dark shadow-sm">
      <div class="text-[40px] mb-3">&#128681;</div>
      <h3 class="text-[18px] font-bold text-navy mb-2">No tours found</h3>
      <p class="text-[#6b7280] text-[14px]">We currently do not have any tours available for this destination.</p>
      <a href="{{ route('index') }}#tours" class="inline-block mt-4 bg-navy text-white py-2.5 px-6 rounded-lg text-[13px] font-bold no-underline hover:bg-navy-light transition-colors">Browse all tours</a>
    </div>
    @endif
  </div>
</section>

@endsection
