@extends('layouts.app')

@section('content')

<style>
.Srvc-hero {
    position: relative;
    width: 100%;
    height: 380px;
    background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.Srvc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.Srvc-hero-content { position: relative; z-index: 2; max-width: 620px; margin-top: 60px; }
.Srvc-title { font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.1; }
.Srvc-subtitle { font-size: 18px; color: rgba(255,255,255,0.85); line-height: 1.6; font-family: 'Mulish', sans-serif; }
.Srvc-wrap { max-width: 1280px; margin: 0 auto; padding: 60px 24px 80px; }
.Srvc-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
@media (max-width: 1024px) { .Srvc-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) { .Srvc-grid { grid-template-columns: 1fr; } .Srvc-title { font-size: 40px; } .Srvc-hero { height: 320px; } }
.Srvc-card {
    display: block; background: #f4efe6; border-radius: 16px; overflow: hidden; text-decoration: none; cursor: pointer;
    border: 1px solid #e5ddd0; transition: transform .5s, box-shadow .5s, border-color .5s;
}
.Srvc-card:hover { transform: translateY(-8px); box-shadow: 0 18px 44px rgba(0,0,0,.12); border-color: rgba(200,168,78,.4); }
.Srvc-card-img { position: relative; height: 150px; overflow: hidden; }
.Srvc-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s; }
.Srvc-card:hover .Srvc-card-img img { transform: scale(1.1); }
.Srvc-card-img::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(11,22,35,.7), transparent); }
.Srvc-icon { position: absolute; bottom: 15px; left: 15px; z-index: 2; width: 36px; height: 36px; background: #c8a84e; color: #0b1623; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 17px; }
.Srvc-card-body { padding: 20px; }
.Srvc-card-title { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #0b1623; margin-bottom: 6px; line-height: 1.4; }
.Srvc-card-desc { font-size: 13px; color: #6b7280; line-height: 1.7; margin-bottom: 14px; }
.Srvc-more { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #a58530; font-family: 'Mulish', sans-serif; }
.Srvc-card:hover .Srvc-more { gap: 10px; }
</style>

<section class="Srvc-hero">
    <div class="Srvc-hero-content">
        <h1 class="Srvc-title">Travel Services</h1>
        <p class="Srvc-subtitle">Beyond our signature tours, we handle every detail of your Rome stay &mdash; seamless, stress-free, first-class.</p>
    </div>
</section>

<section class="Srvc-wrap">
    <div class="Srvc-grid">
        @forelse($services as $srv)
        <a href="{{ route('service.detail', $srv->slug) }}" class="Srvc-card">
            <div class="Srvc-card-img">
                <img src="{{ $srv->image }}" alt="{{ $srv->name }}">
                <div class="Srvc-icon">{!! $srv->icon !!}</div>
            </div>
            <div class="Srvc-card-body">
                <h3 class="Srvc-card-title">{{ $srv->name }}</h3>
                <p class="Srvc-card-desc">{{ $srv->short_description }}</p>
                <span class="Srvc-more">Learn more &rarr;</span>
            </div>
        </a>
        @empty
        <div style="grid-column:1 / -1;text-align:center;padding:60px 0;color:#6b7280;font-size:18px;">No services available yet.</div>
        @endforelse
    </div>
</section>

@endsection
