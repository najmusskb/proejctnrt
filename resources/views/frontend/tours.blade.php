@extends('layouts.app')

@section('content')

<style>
/* Tours Hero Section */
.Tours-hero {
    position: relative;
    width: 100%;
    height: 380px;
    background-image: url('{{ asset('uploads/slider/Rome_6a9132df7e458.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.Tours-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.Tours-hero-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin-top: 60px; /* offset for header */
}
.Tours-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.1;
}
.Tours-hero-subtitle {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.5;
}

/* Filter Bar */
.Tours-filter-bar {
    background: #fff;
    box-shadow: 0 4px 25px rgba(0,0,0,0.06);
    padding: 16px 5%;
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    z-index: 10;
    border-bottom: 1px solid #f1f1f1;
}
.filter-label {
    font-size: 13px;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.filter-select {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px 36px 10px 16px;
    font-size: 14px;
    font-weight: 600;
    color: #1f2937;
    background: #fff url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>') no-repeat right 12px center;
    background-size: 16px;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
    min-width: 200px;
    transition: all 0.2s;
}
.filter-select:focus {
    border-color: #c8a84e;
    box-shadow: 0 0 0 3px rgba(200,168,78,0.1);
}

/* Tours Grid */
.Tours-container {
    padding: 60px 5%;
    background: #fcfcfc;
}
.Tours-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 24px;
}
@media (min-width: 640px) {
    .Tours-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (min-width: 1024px) {
    .Tours-grid { grid-template-columns: repeat(4, 1fr); }
}

/* tour Card - Romex Style */
.tour-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    height: 380px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-decoration: none !important;
    group: hover;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.3s;
}
.tour-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
.tour-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    transition: transform 0.5s ease;
}
.tour-card:hover .tour-bg {
    transform: scale(1.05);
}
.tour-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.85) 100%);
    z-index: 2;
}
.tour-top {
    position: relative;
    z-index: 3;
    padding: 24px;
}
.tour-title {
    color: #fff;
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 8px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.tour-bottom {
    position: relative;
    z-index: 3;
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.tour-price-box {
    color: #fff;
}
.tour-price-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
    margin-bottom: 2px;
}
.tour-price-val {
    font-size: 20px;
    font-weight: 700;
}
.tour-btn {
    background: #c8a84e;
    color: #0b1623;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 10px 20px;
    border-radius: 30px;
    transition: background 0.2s;
}
.tour-card:hover .tour-btn {
    background: #ddb94e;
}
</style>

<!-- Hero Section -->
<section class="Tours-hero">
    <div class="Tours-hero-content">
        <h1 class="Tours-hero-title">Tours</h1>
        <p class="Tours-hero-subtitle">Skip the lines and explore Rome's top attractions at your own pace with our fast-track entry Tours.</p>
    </div>
</section>

<!-- Filter Bar -->
<div class="Tours-filter-bar">
    <span class="filter-label">Filter By</span>
    <select class="filter-select">
        <option value="">Select Cities</option>
        <option value="rome">Rome</option>
        <option value="vatican">Vatican City</option>
    </select>
    <select class="filter-select">
        <option value="">Select Attraction</option>
        <option value="colosseum">Colosseum</option>
        <option value="vatican-museums">Vatican Museums</option>
        <option value="pantheon">Pantheon</option>
    </select>
</div>

<!-- Tours Grid -->
<section class="Tours-container">
    <div class="Tours-grid">
        @forelse($tours as $tour)
        <a href="{{ route('tour.detail', $tour->slug) }}" class="tour-card">
            <img src="{{ asset($tour->image ?? 'frontend/images/placeholder.jpg') }}" alt="{{ $tour->name }}" class="tour-bg">
            <div class="tour-overlay"></div>
            
            <div class="tour-top">
                <h3 class="tour-title">{{ $tour->name }}</h3>
                @if($tour->duration)
                <div style="color: #c8a84e; font-size: 13px; font-weight: 600;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right:4px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    {{ $tour->duration }}
                </div>
                @endif
            </div>
            
            <div class="tour-bottom">
                <div class="tour-price-box">
                    <div class="tour-price-label">From</div>
                    <div class="tour-price-val">€{{ number_format($tour->price, 0) }}</div>
                </div>
                <div class="tour-btn">Book Now</div>
            </div>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 0;">
            <h3 style="font-size: 24px; color: #6b7280;">No Tours found.</h3>
        </div>
        @endforelse
    </div>
</section>

@endsection
