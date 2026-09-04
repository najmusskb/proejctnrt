@extends('layouts.app')

@section('content')

<style>
.Gal-hero {
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
.Gal-hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%); z-index: 1; }
.Gal-hero-content { position: relative; z-index: 2; max-width: 620px; margin-top: 60px; }
.Gal-title { font-family: 'Cormorant Garamond', serif; font-size: 56px; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.1; }
.Gal-subtitle { font-size: 18px; color: rgba(255,255,255,0.85); line-height: 1.6; font-family: 'Mulish', sans-serif; }
.Gal-wrap { max-width: 1280px; margin: 0 auto; padding: 60px 24px 80px; }
.Gal-grid { display: grid; grid-template-columns: repeat(4, 1fr); grid-auto-rows: 180px; gap: 12px; }
@media (max-width: 1024px) { .Gal-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 200px; } }
@media (max-width: 640px) { .Gal-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 150px; } .Gal-title { font-size: 40px; } .Gal-hero { height: 320px; } }
.Gal-item { position: relative; border-radius: 12px; overflow: hidden; cursor: pointer; display: block; }
.Gal-item img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s; }
.Gal-item:hover img { transform: scale(1.1); }
.Gal-item .ovl { position: absolute; inset: 0; background: linear-gradient(to top, rgba(11,22,35,.8), transparent 70%); opacity: 0; transition: opacity .3s; display: flex; flex-direction: column; justify-content: flex-end; padding: 12px; }
.Gal-item:hover .ovl { opacity: 1; }
.Gal-item .ovl .t { color: #fff; font-weight: 700; font-size: 13px; }
.Gal-item .ovl .m { color: #fff; font-size: 11px; margin-top: 3px; opacity: .8; }
.Gal-lightbox { position: fixed; inset: 0; z-index: 100; display: none; align-items: center; justify-content: center; background: rgba(5,10,20,.95); backdrop-filter: blur(6px); }
.Gal-lightbox img { max-height: 76vh; max-width: 92%; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,.6); }
.Gal-lb-title { color: #fff; font-weight: 600; font-size: 14px; margin-top: 18px; text-align: center; }
.Gal-close, .Gal-prev, .Gal-next { position: absolute; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.25); color: #fff; border-radius: 50%; cursor: pointer; }
.Gal-close { top: 20px; right: 24px; width: 44px; height: 44px; font-size: 20px; }
.Gal-prev, .Gal-next { top: 50%; transform: translateY(-50%); width: 48px; height: 48px; font-size: 18px; }
.Gal-prev { left: 16px; } .Gal-next { right: 16px; }
.Gal-close:hover, .Gal-prev:hover, .Gal-next:hover { background: #c8a84e; color: #0b1623; }
</style>

@php
$shots = $gallery->map(function ($g) {
    $img = $g->image;
    $full = preg_replace('#/1(280|024)px-#', '/1280px-', $img);
    if ($full === $img) $full = $img;
    return ['img' => $img, 'full' => $full, 't' => $g->title, 'l' => $g->likes ?? 0, 'c' => $g->comments ?? 0];
})->values();
@endphp

<section class="Gal-hero">
    <div class="Gal-hero-content">
        <h1 class="Gal-title">Photo Gallery</h1>
        <p class="Gal-subtitle">Sneak a peek at Rome's most photogenic corners &mdash; straight from our travellers.</p>
    </div>
</section>

<section class="Gal-wrap">
    <div class="Gal-grid">
        @forelse($shots as $i => $s)
        <a class="Gal-item" onclick="return galOpen({{ $i }})" style="grid-row: span {{ ($i % 6) == 0 ? 2 : 1 }};">
            <img src="{{ $s['img'] }}" alt="{{ $s['t'] }}">
            <div class="ovl">
                <span class="t">{{ $s['t'] }}</span>
                <span class="m">&#10084; {{ number_format($s['l']) }} &middot; &#128172; {{ number_format($s['c']) }}</span>
            </div>
        </a>
        @empty
        <div style="grid-column:1 / -1;text-align:center;padding:60px 0;color:#6b7280;font-size:18px;">No images uploaded yet.</div>
        @endforelse
    </div>
</section>

<div class="Gal-lightbox" id="galBox">
    <button class="Gal-close" onclick="galClose()">&times;</button>
    <button class="Gal-prev" onclick="galMove(-1)">&#10094;</button>
    <img id="galImg" src="" alt="">
    <button class="Gal-next" onclick="galMove(1)">&#10095;</button>
    <div class="Gal-lb-title" id="galTtl"></div>
</div>

<script>
(function(){
    var shots = @json($shots->map(function($s){ return ['full'=>$s['full'],'t'=>$s['t']]; }));
    var box=document.getElementById('galBox'), img=document.getElementById('galImg'), ttl=document.getElementById('galTtl'), cur=0;
    function show(){
        img.src=shots[cur].full; ttl.textContent=shots[cur].t+' ('+(cur+1)+' / '+shots.length+')';
        box.style.display='flex';
    }
    window.galOpen=function(i){ cur=i; show(); return false; };
    window.galClose=function(){ box.style.display='none'; return false; };
    window.galMove=function(d){ cur=(cur+d+shots.length)%shots.length; show(); return false; };
    box.addEventListener('click', function(e){ if(e.target===box) box.style.display='none'; });
    document.addEventListener('keydown', function(e){
        if(box.style.display==='none') return;
        if(e.key==='Escape') galClose();
        if(e.key==='ArrowRight') galMove(1);
        if(e.key==='ArrowLeft') galMove(-1);
    });
})();
</script>

@endsection
