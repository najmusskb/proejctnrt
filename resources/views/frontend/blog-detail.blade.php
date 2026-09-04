@extends('layouts.app')

@section('content')
<style>
.blog-hero {
    position: relative; width: 100%; min-height: 460px;
    background-size: cover; background-position: center; background-attachment: fixed;
    display: flex; align-items: flex-end; padding: 120px 6% 56px;
}
.blog-hero::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(180deg, rgba(5,12,25,.35) 0%, rgba(5,12,25,.55) 60%, rgba(5,12,25,.9) 100%);
    z-index: 1;
}
.blog-hero-content { position: relative; z-index: 2; max-width: 860px; width: 100%; }
.blog-crumb {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
    color: #c8a84e; text-transform: uppercase; margin-bottom: 18px;
}
.blog-crumb a { color: rgba(255,255,255,.75); text-decoration: none; }
.blog-crumb a:hover { color: #c8a84e; }
.blog-crumb span.dot { width: 5px; height: 5px; border-radius: 50%; background: #c8a84e; display: inline-block; }
.blog-hero h1 {
    font-family:'Cormorant Garamond',serif; font-size: clamp(34px,5.5vw,58px);
    font-weight: 700; color: #fff; line-height: 1.08; margin: 0 0 18px; text-shadow: 0 2px 20px rgba(0,0,0,.5);
}
.blog-hero-meta { display: flex; flex-wrap: wrap; align-items: center; gap: 16px; color: rgba(255,255,255,.85); font-size: 13.5px; }
.blog-hero-meta .m { display: inline-flex; align-items: center; gap: 7px; }
.blog-hero-meta .badge { background: rgba(200,168,78,.16); border: 1px solid rgba(200,168,78,.4); color: #c8a84e; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
.blog-wrap { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
.blog-body { padding: 60px 0 80px; }
.blog-main {
    background: #fff; border: 1px solid #eef0f3; border-radius: 24px; padding: 44px 48px;
    box-shadow: 0 10px 40px rgba(0,0,0,.05);
}
.blog-lead { font-size: 18px; color: #1a2d45; font-weight: 500; line-height: 1.8; margin-bottom: 28px; }
.blog-content { font-size: 16px; color: #444c58; line-height: 1.9; }
.blog-content h1,.blog-content h2,.blog-content h3,.blog-content h4 {
    font-family:'Cormorant Garamond',serif; color: #0b1623; font-weight: 700; line-height: 1.25; margin: 34px 0 14px;
}
.blog-content h2 { font-size: 30px; }
.blog-content h3 { font-size: 24px; }
.blog-content p { margin: 0 0 20px; }
.blog-content img { max-width: 100%; border-radius: 16px; margin: 22px 0; }
.blog-content ul,.blog-content ol { margin: 0 0 22px; padding-left: 24px; }
.blog-content li { margin-bottom: 9px; }
.blog-content a { color: #a58530; text-decoration: underline; }
.blog-content blockquote {
    border-left: 4px solid #c8a84e; background: #f8f4ea; padding: 20px 24px; border-radius: 0 14px 14px 0;
    font-family:'Cormorant Garamond',serif; font-size: 20px; font-style: italic; color: #1a2d45; margin: 26px 0;
}
.blog-author {
    display: flex; align-items: center; gap: 16px; margin-top: 40px; padding-top: 30px;
    border-top: 1px solid #f0f1f3;
}
.blog-author .av {
    width: 56px; height: 56px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg,#c8a84e,#a58530); color: #fff;
    display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px;
}
.blog-share { display: flex; align-items: center; gap: 10px; margin-top: 30px; padding-top: 24px; border-top: 1px solid #f0f1f3; flex-wrap: wrap; }
.blog-share span { font-size: 13px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 1px; margin-right: 6px; }
.share-btn {
    width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; transition: all .3s; text-decoration: none;
}
.share-btn:hover { transform: translateY(-3px); }
.share-fb { background: #1877F2; } .share-tw { background: #000; } .share-wa { background: #25D366; } .share-pin { background: #E60023; }
.side-head { font-family:'Cormorant Garamond',serif; font-size: 22px; font-weight: 700; color: #0b1623; margin: 0 0 18px; }
.side-box { background: #fff; border: 1px solid #eef0f3; border-radius: 18px; padding: 24px; box-shadow: 0 6px 24px rgba(0,0,0,.05); margin-bottom: 24px; }
.recent-item { display: flex; gap: 14px; padding: 11px 0; border-bottom: 1px dashed #eef0f3; text-decoration: none; }
.recent-item:last-child { border-bottom: none; }
.recent-item img { width: 74px; height: 60px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
.recent-item .rt { font-size: 14px; font-weight: 700; color: #0b1623; line-height: 1.4; margin: 0 0 4px; transition: color .2s; }
.recent-item:hover .rt { color: #a58530; }
.recent-item .rm { font-size: 12px; color: #9ca3af; }
.cta-box {
    background: linear-gradient(135deg,#0b1623,#1a2d45); border-radius: 20px; padding: 32px; color: #fff;
    box-shadow: 0 16px 50px rgba(11,22,35,.3); position: relative; overflow: hidden;
}
.cta-box::after { content:''; position:absolute; top:-40px; right:-40px; width:170px; height:170px; background: radial-gradient(circle, rgba(200,168,78,.28), transparent 70%); border-radius: 50%; }
.cta-box h3 { font-family:'Cormorant Garamond',serif; font-size: 26px; margin: 0 0 8px; position: relative; z-index: 2; }
.cta-box p { font-size: 14px; color: rgba(255,255,255,.75); margin: 0 0 18px; position: relative; z-index: 2; }
.cta-box a { position: relative; z-index: 2; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg,#c8a84e,#a58530); color: #0b1623; font-weight: 800; font-size: 14px; text-decoration: none; padding: 13px 24px; border-radius: 11px; transition: all .3s; }
.cta-box a:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(200,168,78,.4); }
@media (max-width: 900px){ .blog-main{ padding: 30px 24px; } }
</style>

{{-- HERO --}}
<section class="blog-hero" style="background-image:url('{{ $blog->image }}')">
  <div class="blog-hero-content">
    <nav class="blog-crumb">
      <a href="{{ route('index') }}">Home</a>
      <span class="dot"></span>
      <a href="{{ route('index') }}#blog">Blog</a>
      <span class="dot"></span>
      <span>Article</span>
    </nav>
    <h1>{{ $blog->title }}</h1>
    <div class="blog-hero-meta">
      <span class="badge">{{ $blog->author ?? 'Journal' }}</span>
      <span class="m">&#128197; {{ optional($blog->created_at)->format('M d, Y') }}</span>
      <span class="m">&#128336; {{ $blog->read_time ?? '5' }} min read</span>
    </div>
  </div>
</section>

{{-- MAIN BODY --}}
<div class="blog-body">
  <div class="blog-wrap">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      {{-- LEFT: Article --}}
      <div class="lg:col-span-8">
        <article class="blog-main">
          <p class="blog-lead">{{ $blog->short_description }}</p>
          <div class="blog-content">
            {!! $blog->description !!}
          </div>

          {{-- Author --}}
          <div class="blog-author">
            <div class="av">{{ strtoupper(mb_substr($blog->author ?? 'N',0,1)) }}</div>
            <div>
              <div style="font-size:12px;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;font-weight:700;">Written by</div>
              <div style="font-size:16px;font-weight:800;color:#0b1623;">{{ $blog->author ?? 'Nice in Rome Tour' }}</div>
            </div>
          </div>

          {{-- Share --}}
          <div class="blog-share">
            <span>Share</span>
            <a class="share-btn share-fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"><svg width="18" height="18" viewBox="0 0 320 512" fill="currentColor"><path d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"/></svg></a>
            <a class="share-btn share-tw" target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
            <a class="share-btn share-wa" target="_blank" href="https://wa.me/?text={{ urlencode($blog->title.' '.request()->url()) }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg></a>
            <a class="share-btn share-pin" target="_blank" href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->url()) }}&description={{ urlencode($blog->title) }}"><svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.718-.359-1.782c0-1.668.968-2.914 2.172-2.914 1.027 0 1.52.77 1.52 1.688 0 1.027-.653 2.561-.991 3.982-.286 1.188.598 2.162 1.773 2.162 2.127 0 3.761-2.24 3.761-5.474 0-2.861-2.062-4.866-4.999-4.866-3.404 0-5.403 2.556-5.403 5.197 0 1.027.394 2.13.889 2.73.097.119.111.224.083.345-.089.369-.287 1.16-.313 1.315-.049.208-.16.252-.373.152-1.389-.646-2.257-2.674-2.257-4.309 0-3.508 2.55-6.729 7.348-6.729 3.857 0 6.855 2.747 6.855 6.42 0 3.833-2.414 6.916-5.767 6.916-1.126 0-2.184-.584-2.549-1.274l-.694 2.643c-.25 1.003-.932 2.245-1.388 3C9.764 22.797 10.834 23 12 23c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg></a>
          </div>
        </article>
      </div>

      {{-- RIGHT: Sidebar --}}
      <div class="lg:col-span-4">
        @if($recent->count())
        <div class="side-box">
          <h4 class="side-head">Recent Stories</h4>
          @foreach($recent as $r)
          <a href="{{ route('blog.detail', $r->slug) }}" class="recent-item">
            <img src="{{ $r->image }}" alt="{{ $r->title }}">
            <div>
              <p class="rt">{{ $r->title }}</p>
              <span class="rm">&#128197; {{ optional($r->created_at)->format('M d, Y') }}</span>
            </div>
          </a>
          @endforeach
        </div>
        @endif

        <div class="cta-box">
          <h3>Planning a Trip to Rome?</h3>
          <p>Let us craft the perfect Roman experience. Instant booking via WhatsApp with our local guides.</p>
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp ?? '1234567890') }}?text={{ urlencode('Hello! I want help planning my Rome trip.') }}" target="_blank">Chat with a Local Expert &#8594;</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
