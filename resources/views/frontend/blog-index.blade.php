@extends('layouts.app')

@section('content')

<style>
.BlogId-hero {
    position: relative;
    width: 100%;
    height: 380px;
    background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Colosseum_of_Rome%2C_Italy.jpg/960px-Colosseum_of_Rome%2C_Italy.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.BlogId-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.BlogId-hero-content {
    position: relative;
    z-index: 2;
    max-width: 620px;
    margin-top: 60px;
}
.BlogId-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.1;
}
.BlogId-subtitle {
    font-size: 18px;
    color: rgba(255,255,255,0.85);
    line-height: 1.6;
    font-family: 'Mulish', sans-serif;
}
.BlogId-wrap {
    max-width: 1280px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}
.BlogId-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
@media (max-width: 1024px) {
    .BlogId-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .BlogId-grid { grid-template-columns: 1fr; }
    .BlogId-title { font-size: 40px; }
    .BlogId-hero { height: 320px; }
}
.BlogId-card {
    display: block;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    text-decoration: none;
    transition: transform .3s, box-shadow .3s;
}
.BlogId-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.1); }
.BlogId-card-img { height: 194px; overflow: hidden; }
.BlogId-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
.BlogId-card:hover .BlogId-card-img img { transform: scale(1.05); }
.BlogId-card-body { padding: 18px; }
.BlogId-author { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; color: #a58530; text-transform: uppercase; margin-bottom: 7px; display: block; }
.BlogId-card-title { font-family: 'Cormorant Garamond', serif; font-size: 17px; font-weight: 700; color: #0b1623; margin-bottom: 7px; line-height: 1.4; }
.BlogId-card-desc { font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 11px; }
.BlogId-meta { font-size: 12px; color: #6b7280; margin-bottom: 12px; }
.BlogId-read { font-weight: 600; color: #a58530; font-size: 13px; }
.BlogId-pag { display: flex; justify-content: center; gap: 8px; margin-top: 40px; flex-wrap: wrap; }
.BlogId-pag a, .BlogId-pag span {
    min-width: 40px; height: 40px; padding: 0 12px; display: inline-flex; align-items: center; justify-content: center;
    border: 1.5px solid #e5ddd0; border-radius: 10px; font-size: 13px; font-weight: 600; text-decoration: none; color: #6b7280;
}
.BlogId-pag a:hover { border-color: #c8a84e; color: #a58530; }
.BlogId-pag .active { background: #c8a84e; border-color: #c8a84e; color: #0b1623; }
</style>

<section class="BlogId-hero">
    <div class="BlogId-hero-content">
        <h1 class="BlogId-title">Travel Stories &amp; Tips</h1>
        <p class="BlogId-subtitle">Insider guides, travel tips and stories from Rome's hidden corners.</p>
    </div>
</section>

<section class="BlogId-wrap">
    <div class="BlogId-grid">
        @forelse($blogs as $blog)
        <a href="{{ route('blog.detail', $blog->slug) }}" class="BlogId-card">
            <div class="BlogId-card-img"><img src="{{ $blog->image }}" alt="{{ $blog->title }}"></div>
            <div class="BlogId-card-body">
                <span class="BlogId-author">{{ $blog->author ?? 'Journal' }}</span>
                <h3 class="BlogId-card-title">{{ $blog->title }}</h3>
                <p class="BlogId-card-desc">{{ $blog->short_description }}</p>
                <p class="BlogId-meta">&#128197; {{ optional($blog->created_at)->format('M d, Y') }} &nbsp;&middot;&nbsp; {{ $blog->read_time ?? '5' }} min read</p>
                <span class="BlogId-read">Read More &rarr;</span>
            </div>
        </a>
        @empty
        <div style="grid-column:1 / -1;text-align:center;padding:60px 0;color:#6b7280;font-size:18px;">No posts published yet.</div>
        @endforelse
    </div>

    @if($blogs->hasPages())
    <div class="BlogId-pag">
        @if($blogs->onFirstPage())
        <span>&laquo;</span>
        @else
        <a href="{{ $blogs->previousPageUrl() }}">&laquo;</a>
        @endif
        @for($i = 1; $i <= $blogs->lastPage(); $i++)
        <a href="{{ $blogs->url($i) }}" class="{{ ($blogs->currentPage() == $i) ? 'active' : '' }}">{{ $i }}</a>
        @endfor
        @if($blogs->hasMorePages())
        <a href="{{ $blogs->nextPageUrl() }}">&raquo;</a>
        @else
        <span>&raquo;</span>
        @endif
    </div>
    @endif
</section>

@endsection
