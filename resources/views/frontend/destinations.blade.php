@extends('layouts.app')

@section('content')

{{-- HEADER / BREADCRUMB --}}
<div class="relative bg-navy pt-[120px] pb-16 px-6 overflow-hidden">
  <div class="absolute inset-0 opacity-25" style="background:url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg') center/cover no-repeat"></div>
  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/80 to-navy/40"></div>
  <div class="relative max-w-[1280px] mx-auto text-center">
    <nav class="text-[12px] tracking-wide text-gold mb-4 justify-center flex">
      <a href="{{ route('index') }}" class="text-white/60 no-underline hover:text-gold transition-colors">Home</a>
      <span class="mx-2 text-white/40">/</span>
      <span class="text-gold">Destinations</span>
    </nav>
    <h1 class="font-playfair text-white font-bold leading-tight text-[clamp(28px,5vw,52px)] mb-3">Popular Destinations</h1>
    <p class="text-[15px] text-white/70 max-w-[600px] mx-auto leading-relaxed">Explore the magnificent cities and historic landmarks where our curated tours take place.</p>
  </div>
</div>

<style>
.ds-grid .ds-card {
    width: 100% !important;
    margin-right: 0 !important;
    margin-bottom: 0 !important;
}
</style>

<section class="py-20 px-6 bg-cream min-h-[500px]">
  <div class="max-w-[1200px] mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ds-grid">
      @foreach($destinations as $dest)
      <div class="ds-card" onclick="window.location.href='{{ route('destination.detail', $dest->slug) }}'">
        <img src="{{ asset($dest->image) }}" alt="{{ $dest->name }}"/>
        <div class="ds-frame"></div>
        <span class="ds-name">{{ $dest->name }}</span>
        <div class="ds-bottom-panel">
          <p class="ds-info-desc">{{ $dest->description }}</p>
          <a href="{{ route('destination.detail', $dest->slug) }}" class="ds-info-btn">View Tours & Tickets</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
