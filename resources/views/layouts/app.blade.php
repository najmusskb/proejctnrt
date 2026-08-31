<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>{{ $content->com_name ?? 'Journey With Mr. J' }} — Book Rome Tours via WhatsApp</title>
<meta name="description" content="Book the best Rome tours via WhatsApp. Skip-the-line tickets, guided tours. 35,000+ tourists served."/>
@if(isset($content->favicon))
<link rel="icon" type="image/x-icon" href="{{ asset($content->favicon) }}">
@endif
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Mulish:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        navy: { DEFAULT: '#0b1623', light: '#1a2d45' },
        gold: { DEFAULT: '#c8a84e', light: '#ddb94e', dark: '#a58530' },
        cream: { DEFAULT: '#f4efe6', dark: '#e8e0d0' },
        'tour-card': '#0e1c2e',
      },
      fontFamily: {
        playfair: ['"Cormorant Garamond"', 'serif'],
        inter: ['"Mulish"', 'sans-serif'],
      },
    }
  }
}
</script>
<style>
html{scroll-behavior:smooth}
body{font-family:'Mulish',sans-serif;background:#f4efe6;color:#1a1a2e; /* Removed overflow-x: hidden to fix iOS position:fixed bug */}

/* ===== PREMIUM NAVBAR ===== */
#mainNav{
  position:fixed !important;
  top:0 !important;left:0;right:0;
  z-index:1000;
  background:rgba(11, 22, 35, 0.45);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  box-shadow: 0 4px 30px rgba(0,0,0,0.2);
  transition:all .4s cubic-bezier(.22,1,.36,1);
  padding:0;
  transform: translateY(0);
}
#mainNav.nav-hidden {
  transform: translateY(-100%) !important;
}
#mainNav.scrolled{
  top:0 !important;
  background:rgba(8,16,28,.88);
  backdrop-filter:blur(18px) saturate(160%);
  -webkit-backdrop-filter:blur(18px) saturate(160%);
  box-shadow:0 1px 0 rgba(200,168,78,.18),0 8px 40px rgba(0,0,0,.45);
}
.nav-inner{
  max-width:1400px;
  margin:0 auto;
  padding:0 28px;
  display:flex;
  align-items:center;
  gap:0;
  height:76px;
  transition:height .35s;
}
#mainNav.scrolled .nav-inner{height:62px;}

/* Logo */
.nav-logo{
  display:flex;
  align-items:center;
  gap:12px;
  text-decoration:none;
  flex-shrink:0;
  margin-right:36px;
}
.nav-logo-badge{
  width:56px;height:56px;
  border-radius:12px;
  background:linear-gradient(135deg,#c8a84e 0%,#a58530 100%);
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 4px 18px rgba(200,168,78,.4);
  transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s;
  position:relative;
  overflow:hidden;
}
.nav-logo-badge::before{
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.18) 0%,transparent 60%);
  border-radius:12px;
}
.nav-logo-badge svg{position:relative;z-index:1;}
.nav-logo:hover .nav-logo-badge{transform:scale(1.08) rotate(-3deg);box-shadow:0 6px 28px rgba(200,168,78,.6);}
.nav-logo-text{line-height:1.2; display: flex; align-items: center;}
@keyframes rainbowText {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
.nav-logo-title{
  font-family:'Cormorant Garamond',serif;
  font-size:32px;
  font-weight:900;
  letter-spacing:1px;
  display:block;
  background: linear-gradient(90deg, #ff007f, #ffb300, #00d4ff, #8a2be2, #ff007f);
  background-size: 300% 300%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: rainbowText 5s linear infinite;
  filter: drop-shadow(0px 2px 8px rgba(0,0,0,0.5));
}
.nav-logo-sub{
  font-size:9.5px;
  color:rgba(255,255,255,.55);
  letter-spacing:.8px;
  font-weight:500;
  display:block;
  margin-top:1px;
}

/* Nav links */
.nav-links{
  display:flex;
  align-items:center;
  list-style:none;
  margin:0;padding:0;
  flex:1;
  gap:2px;
}
.nav-links li{position:relative;}
.nav-links a{
  display:block;
  position:relative;
  font-size:13px;
  font-weight:500;
  color:rgba(255,255,255,.82);
  text-decoration:none;
  padding:8px 12px;
  border-radius:8px;
  letter-spacing:.15px;
  transition:color .25s,background .25s;
  white-space:nowrap;
}
.nav-links a::after{
  content:'';
  position:absolute;
  bottom:4px;left:12px;right:12px;
  height:2px;
  background:linear-gradient(90deg,#c8a84e,#ddb94e);
  border-radius:2px;
  transform:scaleX(0);
  transform-origin:left;
  transition:transform .3s cubic-bezier(.22,1,.36,1);
}
.nav-links a:hover{
  color:#fff;
  background:rgba(255,255,255,.07);
}
.nav-links a:hover::after,.nav-links a.nav-active::after{
  transform:scaleX(1);
}
.nav-links a.nav-active{
  color:#c8a84e;
  background:rgba(200,168,78,.1);
  font-weight:600;
}

/* Divider */
.nav-divider{
  width:1px;height:22px;
  background:rgba(255,255,255,.13);
  margin:0 12px;
  flex-shrink:0;
}

/* Right controls */
.nav-actions{
  display:flex;
  align-items:center;
  gap:6px;
  flex-shrink:0;
}
.nav-lang-btn{
  display:flex;
  align-items:center;
  gap:5px;
  background:none;
  border:1.5px solid rgba(255,255,255,.15);
  color:rgba(255,255,255,.75);
  font-size:11.5px;
  font-weight:600;
  letter-spacing:.5px;
  padding:6px 11px;
  border-radius:8px;
  cursor:pointer;
  transition:all .25s;
}
.nav-lang-btn:hover{
  border-color:rgba(200,168,78,.5);
  color:#c8a84e;
  background:rgba(200,168,78,.06);
}
.nav-translate{
  position:relative;
  display:flex;
  align-items:center;
}
.nav-translate-btn{
  display:flex;
  align-items:center;
  gap:7px;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.16);
  color:rgba(255,255,255,.88);
  font-family:inherit;
  font-size:12.5px;
  font-weight:600;
  padding:8px 13px;
  border-radius:9px;
  cursor:pointer;
  transition:all .25s;
  white-space:nowrap;
}
.nav-translate-btn:hover{
  background:rgba(200,168,78,.12);
  border-color:rgba(200,168,78,.5);
  color:#c8a84e;
}
.nav-translate-btn .lang-chevron{
  transition:transform .25s;
  flex:none;
}
.nav-translate-btn[aria-expanded="true"] .lang-chevron{
  transform:rotate(180deg);
}
.lang-menu{
  position:absolute;
  top:calc(100% + 10px);
  right:0;
  width:270px;
  max-height:360px;
  background:#ffffff;
  border:1px solid rgba(11,22,35,.08);
  border-radius:14px;
  box-shadow:0 18px 45px rgba(11,22,35,.18);
  padding:9px;
  z-index:350;
  opacity:0;
  visibility:hidden;
  transform:translateY(-8px) scale(.98);
  transition:all .2s cubic-bezier(.22,1,.36,1);
  text-align:left;
}
.lang-menu.open{
  opacity:1;
  visibility:visible;
  transform:translateY(0) scale(1);
}
.lang-search{
  width:100%;
  box-sizing:border-box;
  border:1.5px solid rgba(11,22,35,.15);
  border-radius:9px;
  padding:9px 12px;
  font-size:13px;
  color:#0b1623;
  outline:none;
  background-color:#fff;
  margin-bottom:8px;
}
.lang-search:focus{
  border-color:#c8a84e;
  box-shadow:0 0 0 3px rgba(200,168,78,.18);
}
.lang-search::placeholder{
  color:#9ca3af;
}
.lang-list{
  max-height:280px;
  overflow-y:auto;
  scrollbar-width:thin;
  scrollbar-color:#c8a84e #e9e2d3;
}
.lang-list::-webkit-scrollbar{width:6px;}
.lang-list::-webkit-scrollbar-track{background:#f4efe6;border-radius:8px;}
.lang-list::-webkit-scrollbar-thumb{background:#c8a84e;border-radius:8px;}
.lang-opt{
  display:block;
  width:100%;
  text-align:left;
  background:none;
  border:none;
  padding:8px 11px;
  border-radius:8px;
  font-size:13px;
  color:#1f2937;
  cursor:pointer;
  transition:all .15s;
  font-family:inherit;
  font-weight:500;
}
.lang-opt:hover{
  background:#f4efe6;
  color:#0b1623;
}
.lang-empty{
  padding:14px 10px;
  text-align:center;
  color:#9ca3af;
  font-size:13px;
}
.nav-translate .gt-widget{
  position:absolute;
  left:-9999px;
  top:0;
  width:1px;
  height:1px;
  overflow:hidden;
  clip:rect(0 0 0 0);
}
.nav-translate .gt-widget .goog-te-combo{
  width:1px;
  height:1px;
  opacity:0;
  position:absolute;
}
#goog-gt-tt, .goog-te-banner-frame, .goog-te-spinner-pos, body > .skiptranslate{
  display:none !important;
}
.nav-action-btn, .nav-search-btn {
  position:relative;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.14);
  color:rgba(255,255,255,.82);
  width:40px;height:40px;
  border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  transition:all .3s cubic-bezier(.175, .885, .32, 1.275);
}
.nav-action-btn:hover, .nav-search-btn:hover {
  background:rgba(200,168,78,.12);
  border-color:rgba(200,168,78,.4);
  color:#c8a84e;
  transform:translateY(-2px) scale(1.05);
}
.nav-wishlist-btn:hover {
  background:rgba(239,68,68,.12);
  border-color:rgba(239,68,68,.4);
  color:#ef4444;
}
.nav-badge{
  position:absolute;
  top:-6px;right:-6px;
  background:#c8a84e;
  color:#0b1623;
  font-size:9.5px;
  font-weight:800;
  width:18px;height:18px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  border:2px solid #0b1623;
  line-height:1;
  box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
.nav-account-btn{
  display:flex;
  align-items:center;
  gap:7px;
  background:linear-gradient(135deg,#c8a84e,#a58530);
  color:#0b1623;
  font-size:13px;
  font-weight:700;
  padding:9px 20px;
  border-radius:10px;
  border:none;
  cursor:pointer;
  text-decoration:none;
  letter-spacing:.2px;
  transition:all .3s cubic-bezier(.22,1,.36,1);
  box-shadow:0 4px 16px rgba(200,168,78,.3);
  white-space:nowrap;
}
.nav-account-btn:hover{
  background:linear-gradient(135deg,#ddb94e,#c8a84e);
  transform:translateY(-2px);
  box-shadow:0 8px 28px rgba(200,168,78,.5);
}
.nav-account-btn svg{transition:transform .3s;}
.nav-account-btn:hover svg{transform:translateX(3px);}

/* Hamburger */
.nav-ham{
  display:none;
  position:relative;
  align-items:center;
  justify-content:center;
  width:40px;height:40px;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.14);
  border-radius:10px;
  cursor:pointer;
  color:#fff;
  margin-left:8px;
  transition:all .3s;
}
.nav-ham:hover{
  background:rgba(200,168,78,.12);
  border-color:rgba(200,168,78,.4);
  color:#c8a84e;
}
.nav-ham svg {
  position: absolute;
  transition: all 0.4s cubic-bezier(.22,1,.36,1);
}
.nav-ham svg.ham-icon {
  opacity: 1;
  transform: rotate(0) scale(1);
}
.nav-ham svg.close-icon {
  opacity: 0;
  transform: rotate(-90deg) scale(0.5);
}
.nav-ham.open svg.ham-icon {
  opacity: 0;
  transform: rotate(90deg) scale(0.5);
}
.nav-ham.open svg.close-icon {
  opacity: 1;
  transform: rotate(0) scale(1);
}

/* Mobile drawer */
.nav-mobile-drawer{
  display:none;
  position:fixed;
  top:0;left:0;right:0;bottom:0;
  background:rgba(8,16,28,.96);
  backdrop-filter:blur(18px);
  -webkit-backdrop-filter:blur(18px);
  z-index:999;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  gap:8px;
  opacity:0;
  pointer-events:none;
  transition:opacity .4s;
}
.nav-mobile-drawer.open{
  display:flex;
  opacity:1;
  pointer-events:auto;
}
.nav-mobile-drawer a{
  font-family:'Cormorant Garamond',serif;
  font-size:28px;
  font-weight:700;
  color:rgba(255,255,255,.7);
  text-decoration:none;
  padding:10px 28px;
  border-radius:12px;
  transition:all .25s;
  letter-spacing:.5px;
}
.nav-mobile-drawer a:hover{color:#c8a84e;background:rgba(200,168,78,.08);}
.nav-mobile-drawer-close{
  position:absolute;
  top:22px;right:22px;
  width:42px;height:42px;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.15);
  border-radius:50%;
  color:#fff;
  font-size:20px;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  transition:all .25s;
}
.nav-mobile-drawer-close:hover{background:rgba(200,168,78,.15);color:#c8a84e;}

/* Gold accent line at very top */
#mainNav::before{
  content:'';
  position:absolute;
  top:0;left:0;right:0;
  height:2.5px;
  background:linear-gradient(90deg,transparent 0%,#c8a84e 30%,#ddb94e 50%,#c8a84e 70%,transparent 100%);
  opacity:.7;
}

/* Premium Nav Search — Inline */
.nav-search-inline{
  display:flex;
  align-items:center;
  gap:8px;
  background:rgba(255,255,255,.06);
  border:1.5px solid rgba(255,255,255,.1);
  border-radius:10px;
  padding:0 14px;
  height:38px;
  min-width:0;
  width:200px;
  flex-shrink:0;
  transition:all .4s cubic-bezier(.22,1,.36,1);
  margin-left:16px;
}
.nav-search-inline svg{
  color:rgba(200,168,78,.55);
  flex-shrink:0;
  transition:color .3s;
}
.nav-search-inline-input{
  background:none;border:none;outline:none;
  font-size:12.5px;font-family:'Mulish',sans-serif;
  color:rgba(255,255,255,.85);
  width:100%;padding:0;
  font-weight:400;
}
.nav-search-inline-input::placeholder{color:rgba(255,255,255,.3);font-weight:400}
.nav-search-inline:focus-within{
  border-color:rgba(200,168,78,.45);
  background:rgba(255,255,255,.1);
  box-shadow:0 0 0 3px rgba(200,168,78,.08);
  width:260px;
}
.nav-search-inline:focus-within svg{color:#c8a84e}

/* Search Dropdown Overlay */
.nav-search-overlay{
  position:fixed;top:0;left:0;right:0;bottom:0;
  background:rgba(8,16,28,.7);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
  z-index:1001;
  opacity:0;pointer-events:none;
  transition:opacity .4s cubic-bezier(.22,1,.36,1);
}
.nav-search-overlay.open{opacity:1;pointer-events:auto}

.nav-search-dropdown{
  position:fixed;top:0;left:0;right:0;
  z-index:1002;
  background:rgba(12,22,38,.95);
  backdrop-filter:blur(24px) saturate(180%);
  -webkit-backdrop-filter:blur(24px) saturate(180%);
  border-bottom:1px solid rgba(200,168,78,.15);
  box-shadow:0 20px 60px rgba(0,0,0,.5);
  padding:0;
  transform:translateY(-100%);
  transition:transform .5s cubic-bezier(.22,1,.36,1);
}
.nav-search-dropdown.open{transform:translateY(0)}
.nav-search-inner{
  max-width:780px;margin:0 auto;
  padding:22px 28px 28px;
  display:flex;flex-direction:column;align-items:center;gap:18px;
}
.nav-search-close{
  position:absolute;top:18px;right:24px;
  width:38px;height:38px;border-radius:50%;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
  color:#fff;font-size:18px;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  transition:all .3s;
}
.nav-search-close:hover{background:rgba(200,168,78,.15);color:#c8a84e;transform:rotate(90deg)}

.nav-search-input-wrap{
  width:100%;position:relative;
  display:flex;align-items:center;
}
.nav-search-input-wrap svg{
  position:absolute;left:18px;
  color:rgba(200,168,78,.6);
  pointer-events:none;
  transition:color .3s;
}
.nav-search-input{
  width:100%;
  background:rgba(255,255,255,.06);
  border:1.5px solid rgba(255,255,255,.12);
  border-radius:16px;
  padding:18px 20px 18px 52px;
  font-size:16px;
  font-family:'Mulish',sans-serif;
  color:#fff;
  outline:none;
  transition:all .35s cubic-bezier(.22,1,.36,1);
}
.nav-search-input::placeholder{color:rgba(255,255,255,.35);font-weight:400}
.nav-search-input:focus{
  border-color:rgba(200,168,78,.45);
  background:rgba(255,255,255,.09);
  box-shadow:0 0 0 4px rgba(200,168,78,.08),0 8px 32px rgba(0,0,0,.3);
}
.nav-search-input:focus + svg{color:#c8a84e}

.nav-search-suggestions{
  width:100%;display:flex;flex-wrap:wrap;gap:8px;justify-content:center;
}
.nav-search-tag{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);
  border-radius:99px;
  padding:8px 18px;
  font-size:12px;
  font-weight:500;
  color:rgba(255,255,255,.55);
  cursor:pointer;
  transition:all .3s;
  letter-spacing:.3px;
}
.nav-search-tag:hover{
  background:rgba(200,168,78,.1);
  border-color:rgba(200,168,78,.35);
  color:#c8a84e;
}
.bg-tour-card { background: #0b1623; }
.bg-cream { background: #fdfbf7; }
.nav-search-tag svg{width:12px;height:12px;margin-right:4px;vertical-align:-1px}

/* Hero Search Section */
.hero-search-wrap{
  display:flex;align-items:center;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.15);
  border-radius:16px;
  padding:6px 6px 6px 22px;
  transition:all .4s cubic-bezier(.22,1,.36,1);
  backdrop-filter:blur(8px);
  -webkit-backdrop-filter:blur(8px);
}
.hero-search-wrap:focus-within{
  border-color:rgba(200,168,78,.5);
  background:rgba(255,255,255,.1);
  box-shadow:0 0 0 4px rgba(200,168,78,.08),0 12px 40px rgba(0,0,0,.3);
}
.hero-search-icon{color:rgba(200,168,78,.55);flex-shrink:0;transition:color .3s}
.hero-search-wrap:focus-within .hero-search-icon{color:#c8a84e}
.hero-search-input{
  flex:1;background:none;border:none;outline:none;
  font-size:16px;font-family:'Mulish',sans-serif;
  color:#fff;padding:14px 16px;
  font-weight:400;
}
.hero-search-input::placeholder{color:rgba(255,255,255,.35)}
.hero-search-btn{
  background:linear-gradient(135deg,#c8a84e,#a58530);
  color:#0b1623;border:none;
  width:48px;height:48px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;flex-shrink:0;
  transition:all .3s cubic-bezier(.22,1,.36,1);
  box-shadow:0 4px 16px rgba(200,168,78,.3);
}
.hero-search-btn:hover{transform:scale(1.08);box-shadow:0 6px 24px rgba(200,168,78,.5)}
.hero-search-tags{
  display:flex;flex-wrap:wrap;gap:8px;justify-content:center;
  margin-top:18px;
}
.hero-tag{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.1);
  border-radius:99px;
  padding:9px 20px;
  font-size:12.5px;
  font-weight:500;
  color:rgba(255,255,255,.55);
  cursor:pointer;
  transition:all .3s cubic-bezier(.22,1,.36,1);
  white-space:nowrap;
}
.hero-tag:hover{
  background:rgba(200,168,78,.12);
  border-color:rgba(200,168,78,.4);
  color:#c8a84e;
  transform:translateY(-2px);
  box-shadow:0 4px 16px rgba(200,168,78,.15);
}

/* === DESTINATION SLIDER === */
#destinations{
  position:relative;
  background:url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg') center/cover no-repeat fixed;
}
#destinations::before{
  content:'';position:absolute;inset:0;
  background:rgba(5,12,25,.72);
  z-index:0;
}
#destinations .dest-bg-overlay{
  display:none;
}
.ds-section{position:relative;width:100%;overflow:hidden;background:transparent}
.ds-viewport{position:relative;width:100%;overflow:hidden;max-width:1200px;margin:0 auto;padding:0 24px}
.ds-track{
  display:flex;
  transition:transform .65s cubic-bezier(.25,.46,.45,.94);
  will-change:transform;
}
.ds-card{
  position:relative;
  flex-shrink:0;
  width:calc(33.333% - 8px);
  margin-right:12px;
  border-radius:18px;
  overflow:hidden;
  cursor:pointer;
  aspect-ratio:3/4;
  border:3px solid rgba(255,255,255,.85);
  box-shadow:0 4px 20px rgba(0,0,0,.12);
  transition:border-color .4s,box-shadow .4s;
}
.ds-card:last-child{margin-right:0}
.ds-card:hover{
  border-color:#fff;
  box-shadow:0 8px 32px rgba(0,0,0,.2);
}
.ds-card img{
  width:100%;height:100%;object-fit:cover;
  display:block;
  filter:saturate(1.15);
  transition:filter .6s cubic-bezier(.22,1,.36,1);
}
.ds-card:hover img{
  filter:saturate(1.1) brightness(.8) blur(6px);
}
/* Dark overlay */
.ds-card::before{
  content:'';
  position:absolute;inset:0;
  background:linear-gradient(180deg,rgba(11,22,35,.15) 0%,rgba(11,22,35,.08) 40%,rgba(11,22,35,.5) 100%);
  z-index:1;
  transition:background .5s cubic-bezier(.22,1,.36,1);
}
.ds-card:hover::before{
  background:rgba(10,18,40,.7);
}
/* Inner frame — THICK white */
.ds-frame{
  position:absolute;
  inset:12px;
  border:8px solid rgba(255,255,255,.8);
  border-radius:10px;
  pointer-events:none;
  z-index:3;
}
.ds-card:hover .ds-frame{
  border-color:rgba(255,255,255,1);
  inset:14px;
}
/* Name label — ALWAYS visible at bottom */
.ds-name{
  position:absolute;
  bottom:20px;left:0;right:0;
  text-align:center;
  z-index:6;
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(20px,2vw,28px);
  font-weight:700;
  color:#fff;
  text-shadow:0 2px 12px rgba(0,0,0,.6);
  letter-spacing:.3px;
  padding:0 20px;
}
.ds-card:hover .ds-name{
  bottom:auto;
  top:30%;
  transform:translateY(-50%);
}
/* Center info — direct on card, no panel */
.ds-bottom-panel{
  position:absolute;
  inset:0;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  z-index:5;
  padding:24px;
  text-align:center;
  opacity:0;
  pointer-events:none;
  transition:opacity .7s cubic-bezier(.22,1,.36,1);
}
.ds-card:hover .ds-bottom-panel{
  opacity:1;
  pointer-events:auto;
}
.ds-bottom-panel .ds-info-desc{
  font-size:16px;
  font-weight:500;
  color:#fff;
  line-height:1.7;
  margin-bottom:18px;
  max-width:240px;
  text-shadow:0 1px 10px rgba(0,0,0,.6);
}
.ds-bottom-panel .ds-info-btn{
  display:inline-flex;
  align-items:center;
  gap:6px;
  background:transparent;
  color:#fff;
  border:1.5px solid rgba(255,255,255,.7);
  padding:10px 24px;
  border-radius:6px;
  font-size:12px;
  font-weight:700;
  letter-spacing:1px;
  text-transform:uppercase;
  cursor:pointer;
  transition:all .3s;
  text-decoration:none;
}
.ds-bottom-panel .ds-info-btn:hover{
  background:rgba(255,255,255,.15);
  border-color:#fff;
}
/* Arrow buttons */
.ds-arrow{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  z-index:10;
  width:42px;height:48px;
  border-radius:4px;
  background:rgba(11,22,35,.65);
  border:1px solid rgba(255,255,255,.15);
  color:#fff;
  font-size:18px;
  cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  transition:all .3s;
  backdrop-filter:blur(4px);
}
.ds-arrow:hover{
  background:rgba(11,22,35,.9);
  border-color:rgba(255,255,255,.3);
}
.ds-arrow-l{left:28px;border-radius:6px}
.ds-arrow-r{right:28px;border-radius:6px}
/* Dots */
.ds-dots{display:flex;justify-content:center;gap:8px;padding:18px 0 0}
.ds-dot{
  width:10px;height:10px;
  border-radius:50%;
  background:rgba(11,22,35,.2);
  border:none;
  cursor:pointer;
  transition:all .35s;
}
.ds-dot.active{background:#c8a84e;width:26px;border-radius:4px}
@media(max-width:768px){
  .ds-card{width:calc(100% - 12px);aspect-ratio:3/4}
  .ds-name{font-size:18px}
  .ds-viewport{padding:0 16px}
}
@media(max-width:768px){
  .hero-search-input{font-size:14px;padding:12px 12px}
  .hero-search-btn{width:42px;height:42px}
  .hero-tag{padding:7px 14px;font-size:11.5px}
}

@media(max-width:1100px){
  .nav-links a{font-size:12px;padding:7px 9px;}
}
@media(max-width:900px){
  .nav-links,.nav-divider,.nav-lang-btn{display:none}
  .nav-translate { display: flex; margin-left: auto; }
  .nav-ham{display:flex}
  .nav-search-inline{display:none}
}
@media(max-width:480px){
  .nav-logo-text{display:none;}
  .nav-inner{padding:0 16px;}
}

/* === TICKER === */
@keyframes tick{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
@keyframes pscroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
@keyframes fu{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
@keyframes pu{0%,100%{box-shadow:0 6px 22px rgba(201,168,76,.5)}50%{box-shadow:0 6px 30px rgba(201,168,76,.8),0 0 0 10px rgba(201,168,76,.1)}}
.ticker-track{display:flex;animation:tick 28s linear infinite;white-space:nowrap;padding:14px 0}
.ticker-track:hover{animation-play-state:paused}
.partner-track{display:flex;gap:13px;animation:pscroll 20s linear infinite}
.partner-track:hover{animation-play-state:paused}
.chat-bubble-anim{animation:fu .4s ease}
.chat-btn-pulse{animation:pu 2.5s infinite}

/* === FAQ === */
.faq-answer{max-height:0;overflow:hidden;transition:max-height .35s ease,padding .35s;background:#f4efe6;font-size:14px;color:#6b7280;line-height:1.7;padding:0 21px}
.faq-item.open .faq-answer{max-height:200px;padding:0 21px 17px}
.faq-item.open .faq-icon{transform:rotate(45deg)}
.faq-item.open{border-color:#c9a84c}
.tour-card:hover .tour-card-img img{transform:scale(1.07)}
.blog-card:hover .blog-card-img img{transform:scale(1.05)}
.hdot.active{background:#c8a84e;width:26px;border-radius:4px}

/* === HERO — CINEMATIC === */
/* === SMART SLIDER (Cinematic Zoom-Blur) === */
.smart-slider{position:relative;width:100%;height:100vh;overflow:hidden}
.ss-slides{position:relative;width:100%;height:100%;transform-style:preserve-3d}
.ss-slide{position:absolute;inset:0;transform-origin:left center;opacity:0;z-index:0;pointer-events:none;backface-visibility:hidden}
.ss-slide .ss-slide-bg{position:absolute;inset:-60px;background-size:cover;background-position:center;will-change:transform}
.ss-slide.active .ss-slide-bg{animation:ssKen 20s ease-in-out infinite alternate}
@keyframes ssKen{0%{transform:scale(1.05) translate(0,0)}100%{transform:scale(1.15) translate(-1.5%,-.5%)}}
.ss-slide::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(11,22,35,.72) 0%,rgba(11,22,35,.55) 40%,rgba(11,22,35,.78) 100%);z-index:1}
.ss-slide.visible{opacity:1;pointer-events:auto}
.ss-slide.active{opacity:1;z-index:2;pointer-events:auto}
/* Cinematic Zoom-Blur Transition */
.ss-slide.turning{z-index:3;pointer-events:none;opacity:1;animation:cinematicZoomOut 1.8s cubic-bezier(.25,.1,.25,1) forwards}
@keyframes cinematicZoomOut{
  0%{transform:perspective(1200px) scale(1) translateZ(0);filter:brightness(1) blur(0);opacity:1}
  50%{filter:brightness(.65) blur(2px)}
  100%{transform:perspective(1200px) scale(1.25) translateZ(150px);filter:brightness(.2) blur(8px);opacity:0}
}
.ss-slide.entering{z-index:2;pointer-events:auto;opacity:1;animation:cinematicZoomIn 1.8s cubic-bezier(.25,.1,.25,1) forwards}
@keyframes cinematicZoomIn{
  0%{transform:perspective(1200px) scale(1.2) translateZ(150px);filter:brightness(.3) blur(6px);opacity:0}
  50%{filter:brightness(.7) blur(2px)}
  100%{transform:perspective(1200px) scale(1) translateZ(0);filter:brightness(1) blur(0);opacity:1}
}
/* Content styles */
.ss-content{position:absolute;inset:0;z-index:5;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:0 24px}
.ss-inner{max-width:820px;width:100%}
.ss-label{font-size:11px;font-weight:700;letter-spacing:5px;color:#c8a84e;text-transform:uppercase;margin-bottom:20px;opacity:0;transform:translateY(20px);transition:opacity .8s,transform .8s}
.ss-slide.active .ss-label{opacity:1;transform:translateY(0)}
.ss-title{font-family:'Cormorant Garamond',serif;font-size:clamp(42px,8vw,84px);font-weight:700;color:#fff;line-height:1.05;margin-bottom:20px;text-shadow:0 4px 40px rgba(0,0,0,.6),0 2px 60px rgba(200,168,78,.12);opacity:0;transform:translateY(40px) translateX(-30px);transition:opacity 1s .15s,transform 1s .15s cubic-bezier(.22,1,.36,1)}
.ss-slide.active .ss-title{opacity:1;transform:translateY(0) translateX(0)}
.ss-line{width:0;height:2px;background:linear-gradient(90deg,#c8a84e,rgba(200,168,78,.2));margin:0 auto 20px;border-radius:1px;transition:width 1.2s .4s cubic-bezier(.22,1,.36,1)}
.ss-slide.active .ss-line{width:80px}
.ss-sub{font-size:17px;color:rgba(255,255,255,.88);max-width:500px;margin:0 auto 28px;line-height:1.7;opacity:0;transform:translateY(30px) translateX(-20px);transition:opacity .8s .3s,transform .8s .3s cubic-bezier(.22,1,.36,1)}
.ss-slide.active .ss-sub{opacity:1;transform:translateY(0) translateX(0)}
.ss-ctas{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;opacity:0;transform:translateY(25px);transition:opacity .8s .45s,transform .8s .45s}
.ss-slide.active .ss-ctas{opacity:1;transform:translateY(0)}
.ss-cta-primary{position:relative;background:linear-gradient(135deg,#c8a84e 0%,#e8c85a 40%,#ddb94e 60%,#c8a84e 100%);background-size:200% 100%;color:#0b1623;border:none;padding:17px 36px;border-radius:14px;font-size:14px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:10px;text-decoration:none;transition:all .4s cubic-bezier(.22,1,.36,1);box-shadow:0 4px 24px rgba(200,168,78,.4),inset 0 1px 0 rgba(255,255,255,.3),inset 0 -1px 0 rgba(0,0,0,.1);letter-spacing:1px;text-transform:uppercase;overflow:hidden;animation:shimmerGold 3s ease-in-out infinite}
@keyframes shimmerGold{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.ss-cta-primary::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent);transition:none;animation:btnShine 4s ease-in-out infinite}
@keyframes btnShine{0%{left:-100%}50%,100%{left:150%}}
.ss-cta-primary:hover{transform:translateY(-3px) scale(1.03);box-shadow:0 8px 36px rgba(200,168,78,.6),0 0 20px rgba(200,168,78,.25),inset 0 1px 0 rgba(255,255,255,.3)}
.ss-cta-primary svg{width:18px;height:18px;flex-shrink:0;filter:drop-shadow(0 1px 1px rgba(0,0,0,.15))}
.ss-cta-secondary{position:relative;background:rgba(255,255,255,.06);backdrop-filter:blur(14px) saturate(150%);-webkit-backdrop-filter:blur(14px) saturate(150%);color:#fff;border:1.5px solid rgba(255,255,255,.22);padding:17px 36px;border-radius:14px;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:10px;text-decoration:none;transition:all .4s cubic-bezier(.22,1,.36,1);letter-spacing:1px;text-transform:uppercase;overflow:hidden}
.ss-cta-secondary::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(37,211,102,.08) 0%,transparent 50%,rgba(37,211,102,.05) 100%);opacity:0;transition:opacity .4s}
.ss-cta-secondary:hover{border-color:rgba(37,211,102,.55);background:rgba(37,211,102,.1);color:#25d366;transform:translateY(-3px) scale(1.03);box-shadow:0 8px 32px rgba(37,211,102,.22),0 0 20px rgba(37,211,102,.1)}
.ss-cta-secondary:hover::before{opacity:1}
.ss-cta-secondary svg{width:22px;height:22px;flex-shrink:0;filter:drop-shadow(0 1px 2px rgba(0,0,0,.2))}
.ss-progress{position:absolute;bottom:0;left:0;right:0;height:3px;background:rgba(255,255,255,.1);z-index:10}
.ss-progress-bar{height:100%;background:linear-gradient(90deg,#c8a84e,#ddb94e);width:0;transition:width .3s linear}
.ss-counter{position:absolute;top:50%;right:40px;transform:translateY(-50%);z-index:10;display:flex;flex-direction:column;align-items:center;gap:6px}
.ss-num{font-size:13px;font-weight:700;color:#c8a84e;opacity:.8}
.ss-counter-line{width:1px;height:40px;background:rgba(255,255,255,.15);position:relative;overflow:hidden}
.ss-counter-fill{position:absolute;top:0;left:0;width:100%;height:0;background:#c8a84e;transition:height 1.6s cubic-bezier(.645,.045,.355,1)}
.ss-arrow{position:absolute;top:50%;z-index:11;width:50px;height:50px;border-radius:50%;background:rgba(255,255,255,.08);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.15);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .35s;opacity:0}
.smart-slider:hover .ss-arrow{opacity:1}
.ss-arrow:hover{background:#c8a84e;color:#0b1623;border-color:#c8a84e;transform:translateY(-50%) scale(1.1)}
.ss-arrow-l{left:24px;top:50%;transform:translateY(-50%)}
.ss-arrow-r{right:24px;top:50%;transform:translateY(-50%)}
.ss-dots{position:absolute;bottom:36px;left:50%;transform:translateX(-50%);z-index:10;display:flex;gap:10px}
.ss-dot{width:8px;height:8px;border-radius:9999px;background:rgba(255,255,255,.3);border:none;cursor:pointer;transition:all .4s;padding:0}
.ss-dot.active{background:#c8a84e;width:28px;border-radius:4px}
.ss-grain{position:absolute;inset:0;opacity:.025;pointer-events:none;z-index:3;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
.ss-scroll{position:absolute;bottom:20px;left:50%;transform:translateX(-50%);z-index:10;display:flex;flex-direction:column;align-items:center;gap:6px;animation:ssBounce 2s ease-in-out infinite}
@keyframes ssBounce{0%,100%{transform:translateX(-50%) translateY(0);opacity:.5}50%{transform:translateX(-50%) translateY(6px);opacity:1}}
.ss-scroll span{font-size:10px;letter-spacing:3px;color:rgba(255,255,255,.4);text-transform:uppercase;font-weight:500}
.ss-scroll-dot{width:6px;height:6px;border-radius:50%;background:#c8a84e}
.ss-bottom-fade{position:absolute;bottom:0;left:0;right:0;height:80px;background:linear-gradient(to top,#f4efe6,transparent);z-index:4;pointer-events:none}
@media(max-width:768px){.ss-counter{right:16px}.ss-arrow-l{left:10px}.ss-arrow-r{right:10px}.ss-arrow{width:40px;height:40px}}

/* Package slider */
.pkg-track::-webkit-scrollbar{display:none}
.pkg-arrow{opacity:0;transition:opacity .3s}
.pkg-slider-wrap:hover .pkg-arrow{opacity:1}
.pkg-arrow-l{left:8px}
.pkg-arrow-r{right:8px}
.pkg-dot{width:8px;height:8px;border-radius:9999px;background:rgba(255,255,255,.25);border:none;cursor:pointer;transition:all .4s}
.pkg-dot.active{background:#c8a84e;width:24px;border-radius:4px}
.about-search-wrap{position:relative;display:flex;justify-content:center;margin-top:32px}
.about-search-icon{width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#c8a84e,#a58530);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(200,168,78,.35);transition:transform .4s cubic-bezier(.22,1,.36,1),box-shadow .4s;border:2px solid rgba(200,168,78,.3);position:relative;z-index:5}
.about-search-icon:hover{transform:scale(1.1);box-shadow:0 6px 30px rgba(200,168,78,.5)}
.about-search-icon svg{transition:transform .4s cubic-bezier(.22,1,.36,1)}
.about-search-wrap.open .about-search-icon svg{transform:rotate(90deg) scale(0)}
.about-search-wrap.open .about-search-icon{transform:scale(0);opacity:0;pointer-events:none}
.about-search-bar{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) scaleX(0) scaleY(0.3);width:0;max-width:600px;height:0;opacity:0;border-radius:9999px;background:white;box-shadow:0 8px 40px rgba(0,0,0,.15);display:flex;align-items:center;padding:0;transition:all .5s cubic-bezier(.22,1,.36,1);transform-origin:center;z-index:10;overflow:hidden}
.about-search-wrap.open .about-search-bar{transform:translate(-50%,-50%) scaleX(1) scaleY(1);width:100%;height:56px;opacity:1;padding:0 8px 0 20px}
.about-search-bar input{flex:1;border:none;outline:none;font-size:15px;font-family:'Mulish',sans-serif;color:#1a1a2e;background:transparent;opacity:0;transition:opacity .3s .2s}
.about-search-wrap.open .about-search-bar input{opacity:1}
.about-search-bar .search-close{width:36px;height:36px;border-radius:50%;border:none;background:#f4efe6;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .3s,transform .3s;flex-shrink:0;margin-right:4px}
.about-search-bar .search-close:hover{background:#e8e0d0;transform:rotate(90deg)}
.about-search-overlay{position:fixed;inset:0;background:rgba(11,22,35,.4);z-index:9;opacity:0;pointer-events:none;transition:opacity .4s;backdrop-filter:blur(4px)}

/* === MOBILE BOTTOM NAV === */
.mobile-bottom-nav {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(11, 22, 35, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-top: 1px solid rgba(200, 168, 78, 0.3);
  z-index: 9999; /* Ensure it stays above everything */
  padding-bottom: env(safe-area-inset-bottom);
  box-shadow: 0 -4px 20px rgba(0,0,0,0.5);
  transform: translateZ(0); /* Force hardware acceleration to prevent detaching on iOS Safari */
  -webkit-transform: translateZ(0);
}
.mbn-item {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 10px 0 8px;
  color: rgba(255,255,255,0.5);
  text-decoration: none;
  gap: 4px;
  transition: all 0.3s;
}
.mbn-item span {
  font-size: 10px;
  font-weight: 600;
}
.mbn-item.active, .mbn-item:hover {
  color: #c8a84e;
}
.mbn-item img {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  object-fit: cover;
  border: 1.5px solid transparent;
  transition: all 0.3s;
}
.mbn-item:hover img {
  border-color: #c8a84e;
}
.mbn-badge {
  position: absolute;
  top: -4px;
  right: -6px;
  background: #c8a84e;
  color: #0b1623;
  font-size: 9px;
  font-weight: 800;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1.5px solid #0b1623;
  line-height: 1;
}

/* Responsive */
@media(max-width:900px){
  .hero-title{font-size:clamp(32px,7vw,56px) !important}
  .nav-links, .nav-search-inline, .nav-lang-btn, .nav-account-btn, .nav-divider { display: none !important; }
  .nav-action-btn, .nav-search-btn { display: none !important; } /* Hide right side action buttons from top on mobile */
  .nav-inner { padding: 0 16px; height: 60px; justify-content: space-between; width: 100%; }
  .nav-actions { margin-left: auto; gap: 8px; }
  .nav-ham { display: flex !important; width: 34px; height: 34px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); align-items: center; justify-content: center; padding: 0; }
  .nav-translate { display: flex !important; align-items: center; height: 100%; }
  .nav-translate-btn { height: 34px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; padding: 0 10px; line-height: 1; }
  .nav-translate-btn::before { line-height: 1; display: flex; align-items: center; }
  .nav-logo { margin-right: 0; gap: 8px; flex-shrink: 0; min-width: max-content; }
  .nav-logo-text { display: flex !important; }
  .nav-logo-title { font-size: 16px !important; letter-spacing: 0.5px; white-space: nowrap !important; line-height: 1.1; display: block !important; visibility: visible !important; opacity: 1 !important; }
  .nav-logo img { height: 46px !important; }
  .nav-logo-badge { width: 46px; height: 46px; }
  
  .top-bar-inner { padding: 0 16px; justify-content: center; }
  .top-bar-right { display: none; }
  .top-bar-left { width: 100%; justify-content: space-between; font-size: 11px; }
  
  .mobile-bottom-nav { display: flex; }
  body { padding-bottom: 60px; } /* Prevent content from hiding behind bottom nav */
  
  .chatbot-toggler { display: none !important; } /* Hidden on mobile in favor of floating-contact-stack */
  .chatbot-window {
    bottom: 16vh !important;
    right: 10px !important;
    left: 10px !important;
    width: auto !important;
    max-width: none !important;
    height: 54vh !important;
    max-height: 470px !important;
    min-height: 300px !important;
    border-radius: 18px !important;
  }
}
@media(max-width:480px){
  .nav-logo { min-width: auto; max-width: 100%; overflow: hidden; }
  .nav-logo-text { display: flex !important; }
  .nav-logo-title { font-size: 15px !important; white-space: normal !important; display: block !important; visibility: visible !important; opacity: 1 !important; letter-spacing: 0.4px; line-height: 1.15; }
  .nav-logo img { height: 46px !important; }
  .nav-logo-badge { width: 46px; height: 46px; flex-shrink: 0; }
  .nav-translate-label { display: none; }
  .nav-translate-btn::before { content: '\1F310'; margin-right: 4px; font-size: 14px; }
}

/* PREMIUM FLOATING SOCIAL BAR (Vertical Middle Right) */
.fs-bar {
  position: fixed; top: 50%; right: 0; transform: translateY(-50%); z-index: 999;
  display: flex; flex-direction: column; gap: 8px; align-items: center;
  background: rgba(11,22,35,.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
  padding: 10px 8px; border-radius: 20px 0 0 20px;
  box-shadow: -6px 0 20px rgba(0,0,0,.2); border: 1px solid rgba(255,255,255,.08); border-right: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.fs-bar:hover { box-shadow: -8px 0 30px rgba(0,0,0,.3); }
.fs-divider { width: 24px; height: 1px; background: rgba(255,255,255,0.12); margin: 2px 0; }
.fs-whatsapp {
  width: 46px; height: 46px; border-radius: 50%;
  background: linear-gradient(135deg, #25D366, #128C7E); color: white; 
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 16px rgba(37, 211, 102, 0.3);
  position: relative; text-decoration: none;
  animation: waPulse 2s infinite; transition: all 0.3s;
}
.fs-whatsapp svg { fill: #ffffff !important; width: 26px; height: 26px; }
.fs-whatsapp:hover { transform: scale(1.1) translateX(-3px); }
@keyframes waPulse {
  0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5); }
  70% { box-shadow: 0 0 0 12px rgba(37, 211, 102, 0); }
  100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
}
.fs-minor {
  width: 34px; height: 34px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  position: relative; text-decoration: none; transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
  color: white;
}
.fs-minor svg { width: 16px; height: 16px; }
.fs-facebook { background: #1877F2; box-shadow: 0 4px 12px rgba(24, 119, 242, 0.15); }
.fs-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); box-shadow: 0 4px 12px rgba(228, 64, 95, 0.15); }
.fs-facebook:hover, .fs-instagram:hover { transform: scale(1.1) translateX(-3px); box-shadow: 0 6px 16px rgba(0,0,0,0.25); }

/* Tooltips */
.fs-whatsapp::before, .fs-minor::before {
  content: attr(data-tip); position: absolute; right: 120%; top: 50%; transform: translateY(-50%) translateX(10px);
  background: rgba(8,16,28,.95); color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;
  white-space: nowrap; opacity: 0; pointer-events: none;
  transition: all 0.3s ease; border: 1px solid rgba(200,168,78,.25); box-shadow: 0 6px 20px rgba(0,0,0,.3);
}
.fs-whatsapp:hover::before, .fs-minor:hover::before { opacity: 1; transform: translateY(-50%) translateX(0); }

@media(max-width:768px){
  .fs-bar {
    display: none !important;
  }
}

/* Mobile Unified Contact Stack */
.floating-contact-stack {
  position: fixed;
  bottom: 80px;
  right: 14px;
  display: flex;
  flex-direction: column;
  background: rgba(11,22,35,0.85);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 30px;
  padding: 6px;
  gap: 8px;
  z-index: 998;
  box-shadow: 0 6px 20px rgba(0,0,0,0.4);
}
.fcs-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  color: #fff;
  text-decoration: none;
  transition: transform 0.2s;
}
.fcs-btn:active {
  transform: scale(0.9);
}
.fcs-wa { background: #25D366; }
.fcs-cb { background: linear-gradient(135deg, #ddb94e, #c8a84e); color: #0b1623; }
.fcs-btn svg { width: 20px; height: 20px; fill: currentColor; }
@keyframes tooltipFloat {
  0%, 100% { transform: translateY(-50%) translateX(0); }
  50% { transform: translateY(-50%) translateX(-4px); }
}

.fcs-tooltip {
  position: absolute;
  right: calc(100% + 10px);
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.95);
  color: #0b1623;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  white-space: nowrap;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  pointer-events: none;
  animation: tooltipFloat 2s ease-in-out infinite;
}
.fcs-tooltip::after {
  content: '';
  position: absolute;
  top: 50%;
  right: -4px;
  transform: translateY(-50%);
  border-width: 5px 0 5px 5px;
  border-style: solid;
  border-color: transparent transparent transparent rgba(255,255,255,0.95);
}

@keyframes waPulse {
  0% { box-shadow: -2px 0 0 0 rgba(37, 211, 102, 0.6); }
  70% { box-shadow: -2px 0 0 12px rgba(37, 211, 102, 0); }
  100% { box-shadow: -2px 0 0 0 rgba(37, 211, 102, 0); }
}
@keyframes waTooltipPop {
  0%, 80%, 100% { opacity: 0; visibility: hidden; transform: translateY(-50%) translateX(10px) scale(0.8); }
  10%, 70% { opacity: 1; visibility: visible; transform: translateY(-50%) translateX(0) scale(1); }
}
@keyframes waButtonPop {
  0%, 80%, 100% { transform: translateY(-50%) scale(1); right: -5px; }
  10%, 70% { transform: translateY(-50%) scale(1.05); right: 0; }
}

.mobile-floating-wa {
  position: fixed;
  top: 50%;
  right: -5px;
  transform: translateY(-50%);
  width: 52px;
  height: 46px;
  background: linear-gradient(135deg, #25D366, #128C7E);
  border-radius: 24px 0 0 24px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-left: 12px;
  color: #fff;
  z-index: 9999;
  box-shadow: -4px 4px 15px rgba(37,211,102,0.4);
  animation: waPulse 2s infinite;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.mobile-floating-wa:hover {
  transform: translateY(-50%) scale(1.08);
  right: 0;
  width: 56px;
  height: 50px;
}
.mobile-floating-wa svg { width: 26px; height: 26px; fill: currentColor; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2)); transition: transform 0.3s; }
.mobile-floating-wa:hover svg { transform: scale(1.1) rotate(-10deg); }

.wa-tooltip {
  position: absolute;
  right: 100%;
  margin-right: 14px;
  top: 50%;
  transform: translateY(-50%) translateX(10px) scale(0.8);
  opacity: 0;
  visibility: hidden;
  background: #25D366;
  color: #fff;
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 800;
  white-space: nowrap;
  box-shadow: -2px 4px 12px rgba(37,211,102,0.5);
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
.wa-tooltip::after {
  content: '';
  position: absolute;
  top: 50%;
  right: -5px;
  transform: translateY(-50%);
  border-width: 5px 0 5px 6px;
  border-style: solid;
  border-color: transparent transparent transparent #25D366;
}
.mobile-floating-wa:hover .wa-tooltip {
  opacity: 1;
  visibility: visible;
  transform: translateY(-50%) translateX(0) scale(1.1);
  animation: none;
}

@media (min-width: 901px) {
  .floating-contact-stack, .mobile-floating-wa { display: none !important; }
}
</style>
</head>
<body>



    @include('partials.header')

    @yield('content')

    @include('partials.footer')


  <!-- New Floating WhatsApp (Mobile Only) -->
  <a href="https://wa.me/1234567890" target="_blank" class="mobile-floating-wa" aria-label="WhatsApp">
    <span class="wa-tooltip">Message us!</span>
    <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
  </a>

  <!-- Mobile Unified Contact Stack -->
  <div class="floating-contact-stack">
    <!-- Chatbot -->
    <div style="position: relative;">
      <span class="fcs-tooltip">Chat with Max!</span>
      <button class="fcs-btn fcs-cb" aria-label="Chatbot" onclick="window.toggleChatbot()">
        <svg viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 1.745.446 3.385 1.222 4.823L2.05 21.95l5.297-1.127A9.957 9.957 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18c-1.523 0-2.964-.34-4.24-.937l-.304-.14-3.14.667.688-3.04-.154-.316C4.168 14.805 3.8 13.435 3.8 12c0-4.523 3.677-8.2 8.2-8.2s8.2 3.677 8.2 8.2-3.677 8.2-8.2 8.2z"/></svg>
      </button>
    </div>
  </div>

<!-- PREMIUM FLOATING SOCIAL BAR -->
<div class="fs-bar">
  <a href="#" target="_blank" class="fs-minor fs-facebook" data-tip="Facebook">
    <svg viewBox="0 0 320 512" fill="currentColor"><path d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"/></svg>
  </a>
  <div class="fs-divider"></div>
  <a href="https://wa.me/1234567890" target="_blank" class="fs-whatsapp" data-tip="WhatsApp">
    <svg viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
  </a>
  <div class="fs-divider"></div>
  <a href="#" target="_blank" class="fs-minor fs-instagram" data-tip="Instagram">
    <svg viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
  </a>
</div>

<script>
function fq(btn){
  var i=btn.parentElement,open=i.classList.contains('open');
  document.querySelectorAll('.faq-item.open').forEach(function(x){x.classList.remove('open')});
  if(!open)i.classList.add('open');
}
function ft2(tag,btn){
  document.querySelectorAll('.ft').forEach(function(t){t.classList.remove('active')});
  btn.classList.add('active');
  document.querySelectorAll('.tour-card').forEach(function(c){
    c.style.display=(tag==='all'||c.dataset.tag===tag)?'':'none';
  });
}
function tw(btn){
  var l=btn.innerHTML==='&#9829;';
  btn.innerHTML=l?'&#9825;':'&#9829;';
  btn.style.color=l?'white':'#ef4444';
}

function toggleAboutSearch(){
  var wrap=document.getElementById('aboutSearch');
  var input=document.getElementById('aboutSearchInput');
  var ov=document.getElementById('aboutOverlay');
  wrap.classList.toggle('open');
  if(wrap.classList.contains('open')){ov.style.opacity='1';ov.style.pointerEvents='auto';setTimeout(function(){input.focus();},400);}else{ov.style.opacity='0';ov.style.pointerEvents='none';}
}
function showMore(){
  var b=document.getElementById('smBtn');
  b.textContent='Loading...';
  setTimeout(function(){b.textContent='All tours loaded \u2713';b.style.borderColor='#16a34a';b.style.color='#16a34a';},1200);
}

/* === PACKAGE SLIDER === */
(function(){
  var track=document.getElementById('pkgTrack');
  var dotsWrap=document.getElementById('pkgDots');
  if(!track||!dotsWrap)return;
  var cards=track.querySelectorAll('.pkg-card');
  var cardW=320;
  var scrollAmt=cardW;
  var maxScroll=track.scrollWidth-track.clientWidth;
  var activeIdx=0;
  function updateDots(){var s=track.scrollLeft;var total=track.scrollWidth-track.clientWidth;var idx=Math.round(s/(total/(cards.length-1)));if(idx!==activeIdx){activeIdx=idx;renderDots();}}
  function renderDots(){dotsWrap.innerHTML='';for(var i=0;i<cards.length;i++){var d=document.createElement('button');d.className='pkg-dot'+(i===activeIdx?' active':'');d.setAttribute('data-idx',i);d.onclick=function(){var n=parseInt(this.getAttribute('data-idx'));track.scrollTo({left:n*cardW,behavior:'smooth'});activeIdx=n;renderDots();};dotsWrap.appendChild(d);}}
  renderDots();
  track.addEventListener('scroll',function(){clearTimeout(track._dt);track._dt=setTimeout(updateDots,80);});
  window.slidePkg=function(dir){var s=track.scrollLeft+dir*scrollAmt;track.scrollTo({left:Math.max(0,Math.min(s,maxScroll)),behavior:'smooth'});};
})();

/* === SMART SLIDER === */
(function(){
  var slider=document.getElementById('smartSlider');
  var track=document.getElementById('ssTrack');
  if(!slider || !track) return;
  var slides=track.querySelectorAll('.ss-slide');
  var bar=document.getElementById('ssBar');
  var numEl=document.getElementById('ssNum');
  var fill=document.getElementById('ssCounterFill');
  var dots=document.querySelectorAll('.ss-dot');
  var total=slides.length;
  var cur=0;
  var AUTO_MS=7000;
  var timer=null;
  var progress=null;
  var progressStart=0;
  var dragging=false;
  var dragStartX=0;
  var dragDelta=0;

  function goTo(idx){
    if(idx<0)idx=total-1;
    if(idx>=total)idx=0;
    if(idx===cur)return;
    var prev=slides[cur];
    var next=slides[idx];
    prev.classList.remove('active');
    prev.classList.add('turning');
    setTimeout(function(){prev.classList.remove('turning');prev.style.opacity='0';},1800);
    next.style.opacity='';
    next.classList.add('active');
    next.classList.add('entering');
    setTimeout(function(){next.classList.remove('entering');},1800);
    track.style.transition='none';
    track.style.transform='none';
    dots.forEach(function(d,i){d.classList.toggle('active',i===idx);});
    numEl.textContent=idx+1<10?'0'+(idx+1):''+(idx+1);
    fill.style.transition='none';fill.style.height='0';
    fill.offsetHeight;
    fill.style.transition='height '+AUTO_MS+'ms linear';
    fill.style.height='100%';
    cur=idx;
    resetTimer();
  }

  function resetTimer(){
    clearTimeout(timer);
    cancelAnimationFrame(progress);
    bar.style.transition='none';bar.style.width='0';
    progressStart=Date.now();
    (function tick(){var elapsed=Date.now()-progressStart;var pct=Math.min(elapsed/AUTO_MS*100,100);bar.style.width=pct+'%';if(pct<100)progress=requestAnimationFrame(tick);})();
    timer=setTimeout(function(){goTo((cur+1)%total);},AUTO_MS);
  }

  window.ssGo=function(dir){goTo(cur+dir);};
  window.ssTo=function(idx){goTo(idx);};

  slider.addEventListener('mousedown',function(e){dragging=true;dragStartX=e.clientX;dragDelta=0;slider.style.cursor='grabbing';});
  document.addEventListener('mousemove',function(e){if(!dragging)return;dragDelta=e.clientX-dragStartX;});
  document.addEventListener('mouseup',function(){if(!dragging)return;dragging=false;slider.style.cursor='';if(Math.abs(dragDelta)>80){goTo(dragDelta<0?cur+1:cur-1);}});

  slider.addEventListener('touchstart',function(e){dragging=true;dragStartX=e.touches[0].clientX;dragDelta=0;},{passive:true});
  slider.addEventListener('touchmove',function(e){if(!dragging)return;dragDelta=e.touches[0].clientX-dragStartX;},{passive:true});
  slider.addEventListener('touchend',function(){if(!dragging)return;dragging=false;if(Math.abs(dragDelta)>60){goTo(dragDelta<0?cur+1:cur-1);}});

  document.addEventListener('keydown',function(e){
    if(e.key==='ArrowLeft')goTo(cur-1);
    if(e.key==='ArrowRight')goTo(cur+1);
    if(e.key==='Escape'){
      var sd=document.getElementById('navSearchDropdown');
      if(sd&&sd.classList.contains('open'))toggleNavSearch();
      var w=document.getElementById('aboutSearch');
      if(w&&w.classList.contains('open'))toggleAboutSearch();
    }
  });

  resetTimer();
  fill.style.transition='height '+AUTO_MS+'ms linear';
  fill.style.height='100%';

  var lastScrollY = window.scrollY;
  window.addEventListener('scroll',function(){
    var nav=document.getElementById('mainNav');
    var currentScrollY = window.scrollY;
    
    /* Background change past 30px */
    if(currentScrollY>30){
      nav.classList.add('scrolled');
    }
    else{
      nav.classList.remove('scrolled');
    }
    
    /* Premium Smart Hide/Show Animation past 200px */
    if(currentScrollY > 200 && currentScrollY > lastScrollY) {
      nav.classList.add('nav-hidden');
    } else {
      nav.classList.remove('nav-hidden');
    }
    lastScrollY = currentScrollY;
  });
})();

/* === DESTINATION SLIDER — Infinite Loop === */
(function(){
  var section=document.getElementById('dsSection');
  var viewport=document.getElementById('dsViewport');
  var track=document.getElementById('dsTrack');
  var dotsWrap=document.getElementById('dsDots');
  var prevBtn=document.getElementById('dsPrev');
  var nextBtn=document.getElementById('dsNext');
  if(!track||!viewport)return;

  var originals=Array.prototype.slice.call(track.querySelectorAll('.ds-card'));
  var total=originals.length;
  var gap=12;
  var idx=0;
  var AUTO_MS=4000;
  var autoTimer=null;
  var dragging=false,startX=0,dragDelta=0;

  /* Clone all cards to end for infinite loop */
  originals.forEach(function(c){
    var clone=c.cloneNode(true);
    track.appendChild(clone);
  });

  var allCards=track.querySelectorAll('.ds-card');
  var cw,visibleCount;

  function layout(){
    var vw=viewport.offsetWidth-48;
    visibleCount=window.innerWidth<=768?1:3;
    cw=Math.floor((vw-gap*(visibleCount-1))/visibleCount);
    allCards.forEach(function(c){c.style.width=cw+'px';c.style.marginRight=gap+'px';});
    idx=0;
    slideTo(idx,false);
  }

  function slideTo(i,animate){
    if(animate===undefined)animate=true;
    if(!animate)track.style.transition='none';
    else track.style.transition='transform .6s cubic-bezier(.25,.46,.45,.94)';
    idx=i;
    var offset=idx*(cw+gap);
    track.style.transform='translateX('+(-offset)+'px)';
    updateDots();
    resetAuto();
    /* When past original set, snap back without animation */
    if(idx>=total){
      setTimeout(function(){
        idx=0;
        track.style.transition='none';
        track.style.transform='translateX(0)';
        updateDots();
      },650);
    }
  }

  function updateDots(){
    dotsWrap.innerHTML='';
    for(var i=0;i<total;i++){
      var d=document.createElement('button');
      var active=(i===idx%total);
      d.className='ds-dot'+(active?' active':'');
      (function(n){d.onclick=function(){slideTo(n);};})(i);
      dotsWrap.appendChild(d);
    }
  }

  function resetAuto(){
    clearTimeout(autoTimer);
    autoTimer=setTimeout(function(){slideTo(idx+1);},AUTO_MS);
  }

  layout();
  resetAuto();

  prevBtn.addEventListener('click',function(){
    if(idx<=0)slideTo(total-1,false);
    else slideTo(idx-1);
  });
  nextBtn.addEventListener('click',function(){slideTo(idx+1);});

  viewport.addEventListener('mousedown',function(e){dragging=true;startX=e.clientX;dragDelta=0;viewport.style.cursor='grabbing';});
  document.addEventListener('mousemove',function(e){if(dragging)dragDelta=e.clientX-startX;});
  document.addEventListener('mouseup',function(){if(!dragging)return;dragging=false;viewport.style.cursor='';if(Math.abs(dragDelta)>60)slideTo(dragDelta<0?idx+1:idx-1);});
  viewport.addEventListener('touchstart',function(e){dragging=true;startX=e.touches[0].clientX;dragDelta=0;},{passive:true});
  viewport.addEventListener('touchmove',function(e){if(dragging)dragDelta=e.touches[0].clientX-startX;},{passive:true});
  viewport.addEventListener('touchend',function(){if(!dragging)return;dragging=false;if(Math.abs(dragDelta)>50)slideTo(dragDelta<0?idx+1:idx-1);});

  section.addEventListener('mouseenter',function(){clearTimeout(autoTimer);});
  section.addEventListener('mouseleave',function(){resetAuto();});
  window.addEventListener('resize',function(){layout();});
})();

/* === MOBILE NAV === */
function toggleMobileNav(){
  var drawer=document.getElementById('navMobileDrawer');
  var ham=document.getElementById('navHam');
  var open=drawer.classList.toggle('open');
  ham.classList.toggle('open',open);
  document.body.style.overflow=open?'hidden':'';
}

/* === PREMIUM NAV SEARCH === */
function toggleNavSearch(){
  var overlay=document.getElementById('navSearchOverlay');
  var dropdown=document.getElementById('navSearchDropdown');
  var input=document.getElementById('navSearchInput');
  var isOpen=dropdown.classList.toggle('open');
  overlay.classList.toggle('open',isOpen);
  if(isOpen){
    document.body.style.overflow='hidden';
    setTimeout(function(){input.focus();},400);
  }else{
    document.body.style.overflow='';
    input.value='';
  }
}
function fillSearch(text){
  var inlineInput=document.getElementById('navSearchInlineInput');
  var dropInput=document.getElementById('navSearchInput');
  if(inlineInput)inlineInput.value=text;
  if(dropInput)dropInput.value=text;
  var dropdown=document.getElementById('navSearchDropdown');
  if(dropdown.classList.contains('open'))toggleNavSearch();
  if(inlineInput)inlineInput.focus();
}
function heroFill(text){
  document.getElementById('heroSearchInput').value=text;
  document.getElementById('heroSearchInput').focus();
  document.getElementById('heroSearchInput').scrollIntoView({behavior:'smooth',block:'center'});
}
function heroSearchGo(){
  var v=document.getElementById('heroSearchInput').value.trim();
  if(v){document.getElementById('tours').scrollIntoView({behavior:'smooth'});}
}

/* === NAVBAR ACTIVE LINK on scroll === */
(function(){
  var sections=[{id:'tours',nav:'navTours'},{id:'faq',nav:'navFaq'}];
  var links=document.querySelectorAll('.nav-links a');
  window.addEventListener('scroll',function(){
    var pos=window.scrollY+120;
    var active='navHome';
    sections.forEach(function(s){
      var el=document.getElementById(s.id);
      if(el&&el.offsetTop<=pos)active=s.nav;
    });
    links.forEach(function(l){l.classList.remove('nav-active');});
    var al=document.getElementById(active);
    if(al)al.classList.add('nav-active');
  });
})();
</script>
<!-- PROJECT CHATBOT -->
<style>
/* Chatbot Toggler - Animated & Glowing */
.chatbot-toggler {
  position: fixed;
  bottom: 24px;
  right: 24px;
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background: linear-gradient(135deg, #c8a84e, #a58530);
  color: #0b1623;
  border: 2px solid rgba(255,255,255,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 0 20px rgba(200, 168, 78, 0.5), inset 0 0 10px rgba(255,255,255,0.3);
  z-index: 1000;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  animation: cbFloat 3s ease-in-out infinite, cbPulse 2s infinite;
}
@keyframes cbFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
}
@keyframes cbPulse {
  0% { box-shadow: 0 0 0 0 rgba(200, 168, 78, 0.6); }
  70% { box-shadow: 0 0 0 15px rgba(200, 168, 78, 0); }
  100% { box-shadow: 0 0 0 0 rgba(200, 168, 78, 0); }
}
.chatbot-toggler:hover {
  transform: scale(1.1) translateY(-5px);
  background: linear-gradient(135deg, #e4c976, #c8a84e);
  animation: none;
}
.chatbot-toggler svg { width: 32px; height: 32px; fill: currentColor; transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
.chatbot-toggler.open { animation: none; transform: scale(0.9); background: #0b1623; color: #c8a84e; border-color: #c8a84e; }
.chatbot-toggler.open svg { transform: rotate(180deg) scale(0); opacity: 0; }
.chatbot-toggler .cb-close { position: absolute; transform: rotate(-180deg) scale(0); opacity: 0; transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55), opacity 0.4s; color: #c8a84e; }
.chatbot-toggler.open .cb-close { transform: rotate(0) scale(1); opacity: 1; font-size: 28px; font-weight: bold; }

/* Chatbot Window - Glassmorphism & Animated Entry */
.chatbot-window {
  position: fixed;
  bottom: 100px;
  right: 24px;
  width: 360px;
  max-width: calc(100vw - 48px);
  height: 500px;
  max-height: calc(100vh - 120px);
  background: rgba(11, 22, 35, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(200, 168, 78, 0.4);
  border-radius: 24px;
  box-shadow: 0 24px 60px rgba(0, 0, 0, 0.7), 0 0 40px rgba(200, 168, 78, 0.15) inset;
  z-index: 999;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transform: translateY(40px) scale(0.9);
  opacity: 0;
  pointer-events: none;
  transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
  transform-origin: bottom right;
}
.chatbot-window.open {
  transform: translateY(0) scale(1);
  opacity: 1;
  pointer-events: auto;
}
.chatbot-window::before {
  content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
  background: conic-gradient(transparent, rgba(200, 168, 78, 0.15), transparent 30%);
  animation: cbRotate 5s linear infinite; pointer-events: none; z-index: -1;
}
@keyframes cbRotate { 100% { transform: rotate(1turn); } }

.cb-header {
  padding: 16px 20px;
  background: linear-gradient(135deg, rgba(200, 168, 78, 0.2), rgba(200, 168, 78, 0.05));
  border-bottom: 1px solid rgba(200, 168, 78, 0.3);
  display: flex;
  align-items: center;
  gap: 12px;
  position: relative;
  flex-shrink: 0;
}
.cb-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, #c8a84e, #e4c976);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #0b1623;
  box-shadow: 0 6px 16px rgba(200, 168, 78, 0.4);
  position: relative;
}
.cb-avatar svg { width: 24px; height: 24px; fill: currentColor; }
.cb-avatar::after {
  content: ''; position: absolute; bottom: 2px; right: 2px; width: 10px; height: 10px;
  background: #22c55e; border: 2px solid #0b1623; border-radius: 50%;
  box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.3);
  animation: cbPing 2.5s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.cb-title-wrap { flex: 1; }
.cb-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 16px;
  font-weight: 800;
  color: #c8a84e;
  margin-bottom: 2px;
  letter-spacing: 0.5px;
}
.cb-status {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.7);
  font-weight: 500;
}
.cb-header-close {
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  color: #fff;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s;
  font-size: 18px;
  line-height: 1;
}
.cb-header-close:hover {
  background: #ef4444;
  border-color: #ef4444;
  transform: scale(1.1);
}

.cb-body {
  flex: 1;
  min-height: 0;
  display: flex;
  flex-direction: column;
}

.cb-body-inner { 
  display: none; 
  flex-direction: column; 
  flex: 1; 
  overflow-y: auto; 
  padding: 16px 20px; 
  gap: 16px; 
  scroll-behavior: smooth; 
}
.cb-body-inner.active { display: flex; animation: cbFadeIn 0.4s ease-out; }
@keyframes cbFadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.cb-body-inner::-webkit-scrollbar { width: 5px; }
.cb-body-inner::-webkit-scrollbar-thumb { background: rgba(200, 168, 78, 0.3); border-radius: 10px; }

/* Home View specific styles */
.cb-card {
  background: linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
  border: 1px solid rgba(200,168,78,0.15);
  border-radius: 20px;
  padding: 20px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
}
.cb-card-title {
  font-size: 14px;
  font-weight: 700;
  color: #c8a84e;
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.cb-action-btn {
  display: flex;
  align-items: center;
  gap: 14px;
  width: 100%;
  padding: 14px 16px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 14px;
  color: #fff;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  margin-bottom: 10px;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
  text-decoration: none;
  text-align: left;
}
.cb-action-btn:last-child { margin-bottom: 0; }
.cb-action-btn:hover {
  background: linear-gradient(90deg, rgba(200,168,78,0.15), rgba(200,168,78,0.05));
  border-color: rgba(200,168,78,0.4);
  transform: translateX(6px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.cb-action-btn .icon { 
  font-size: 18px; 
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)); 
  display: inline-flex; 
  align-items: center; 
  justify-content: center; 
  width: 24px; 
  height: 24px;
}
.cb-action-btn .arr { margin-left: auto; color: rgba(200,168,78,0.6); transition: transform 0.3s; }
.cb-action-btn:hover .arr { transform: translateX(4px); color: #c8a84e; }

.cb-msg-wrapper {
  display: flex;
  flex-direction: column;
  animation: cbSlideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
  opacity: 0;
  transform: translateY(15px);
}
@keyframes cbSlideUp { to { opacity: 1; transform: translateY(0); } }

.cb-msg {
  max-width: 85%;
  padding: 14px 18px;
  border-radius: 18px;
  font-size: 14px;
  line-height: 1.5;
  position: relative;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.cb-msg-wrapper.bot { align-items: flex-start; }
.cb-msg-wrapper.user { align-items: flex-end; }

.cb-msg.bot {
  background: rgba(255, 255, 255, 0.08);
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-bottom-left-radius: 4px;
}
.cb-msg.user {
  background: linear-gradient(135deg, #c8a84e, #a58530);
  color: #0b1623;
  font-weight: 600;
  border-bottom-right-radius: 4px;
}

/* Typing Indicator */
.cb-typing {
  display: flex;
  gap: 4px;
  padding: 16px 20px;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 18px;
  border-bottom-left-radius: 4px;
  align-self: flex-start;
  width: fit-content;
  border: 1px solid rgba(255,255,255,0.1);
}
.cb-dot {
  width: 6px; height: 6px; background: #c8a84e; border-radius: 50%;
  animation: cbTyping 1.4s infinite ease-in-out both;
}
.cb-dot:nth-child(1) { animation-delay: -0.32s; }
.cb-dot:nth-child(2) { animation-delay: -0.16s; }
@keyframes cbTyping { 0%, 80%, 100% { transform: scale(0); } 40% { transform: scale(1); } }

.cb-footer {
  padding: 16px 20px;
  background: rgba(0, 0, 0, 0.3);
  border-top: 1px solid rgba(200, 168, 78, 0.15);
}
.cb-input-wrap {
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(200, 168, 78, 0.2);
  border-radius: 99px;
  padding: 6px 6px 6px 18px;
  transition: all 0.3s;
}
.cb-input-wrap:focus-within {
  background: rgba(255, 255, 255, 0.08);
  border-color: #c8a84e;
  box-shadow: 0 0 15px rgba(200, 168, 78, 0.2);
}
.cb-input {
  flex: 1; background: none; border: none; outline: none;
  color: #fff; font-family: 'Mulish', sans-serif; font-size: 14px;
}
.cb-input::placeholder { color: rgba(255, 255, 255, 0.4); }
.cb-send {
  width: 40px; height: 40px; border-radius: 50%;
  background: linear-gradient(135deg, #c8a84e, #a58530);
  color: #0b1623; border: none;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.cb-input:not(:placeholder-shown) + .cb-send {
  transform: scale(1.05) rotate(-10deg);
  box-shadow: 0 4px 12px rgba(200, 168, 78, 0.4);
}
.cb-send:hover { transform: scale(1.15) rotate(0deg); background: #e4c976; }
.cb-send svg { width: 18px; height: 18px; fill: currentColor; margin-left: 2px; }

/* Bottom Nav */
.cb-bottom-nav {
  display: flex;
  border-top: 1px solid rgba(200,168,78,0.2);
  background: rgba(8,15,28,0.95);
  padding: 12px 0 16px;
}
.cb-nav-btn {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  background: none;
  border: none;
  color: rgba(255,255,255,0.4);
  font-size: 11px;
  font-weight: 600;
  font-family: 'Mulish', sans-serif;
  cursor: pointer;
  transition: all 0.3s;
}
.cb-nav-btn.active, .cb-nav-btn:hover { color: #c8a84e; }
.cb-nav-btn svg { width: 22px; height: 22px; fill: currentColor; transition: transform 0.3s; }
.cb-nav-btn.active svg { transform: scale(1.15); filter: drop-shadow(0 2px 4px rgba(200,168,78,0.4)); }
</style>

<div class="chatbot-window" id="cbWindow">
  
  <div class="cb-header">
    <div class="cb-avatar">
      <svg viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 22.7 456.5 22 458c-1.4 2.8-2 5.8-2 8.8 0 11 9 20 20 20 5.4 0 10.6-2.1 14.6-5.8 47.9-43.9 83-60.5 106.8-68 30.1 11.2 62.7 17.5 96.6 17.5 141.4 0 256-93.1 256-208S397.4 32 256 32zm0 352c-29.3 0-57.9-5.3-84.5-15.1l-14.7-5.4-14 5.3c-24.8 9.5-60.2 24.5-98.8 45.4 12.1-23.7 25.4-53.5 32.8-82.6l4-15.8-11.2-12C36.8 271.7 16 230 16 184c0-99.3 107.5-180 240-180s240 80.7 240 180-107.5 180-240 180z"/></svg>
    </div>
    <div class="cb-title-wrap">
      <div class="cb-title">Aura (Rome Guide)</div>
      <div class="cb-status">Always ready to help!</div>
    </div>
    <button class="cb-header-close" id="cbHeaderClose" aria-label="Close Chat">&times;</button>
  </div>

  <div class="cb-body" id="cbBody">
    <!-- Home View -->
    <div class="cb-body-inner active" id="cbHomeView">
      <div class="cb-card">
        <div class="cb-card-title"><span style="font-size:16px">&#9889;</span> Quick Actions</div>
        <button class="cb-action-btn" onclick="startChat('I want to buy tickets')"><span class="icon">&#127915;</span> Buy Tickets <span class="arr">&rarr;</span></button>
        <button class="cb-action-btn" onclick="startChat('I want to check my booking')"><span class="icon">&#128203;</span> My Booking <span class="arr">&rarr;</span></button>
        <button class="cb-action-btn" onclick="startChat('I want to chat with Max')"><span class="icon">&#128172;</span> Chat with Max <span class="arr">&rarr;</span></button>
        <a href="https://wa.me/39339778400" target="_blank" class="cb-action-btn"><span class="icon">&#128241;</span> WhatsApp <span class="arr">&rarr;</span></a>
      </div>

      <div class="cb-card">
        <div class="cb-card-title"><span style="font-size:16px">&#128161;</span> Popular Questions</div>
        <button class="cb-action-btn" onclick="startChat('How do I book?')"><span class="icon">&#128467;&#65039;</span> How do I book? <span class="arr">&rarr;</span></button>
        <button class="cb-action-btn" onclick="startChat('What\'s included in the tour?')"><span class="icon">&#9989;</span> What's included? <span class="arr">&rarr;</span></button>
        <button class="cb-action-btn" onclick="startChat('What\'s the cancellation policy?')"><span class="icon">&#8617;&#65039;</span> Cancellation policy? <span class="arr">&rarr;</span></button>
      </div>
    </div>

    <!-- Messages View -->
    <div class="cb-body-inner" id="cbMessagesView">
      <div class="cb-msg-wrapper bot">
        <div class="cb-msg bot">Benvenuto! &#127470;&#127481; I'm Aura, your AI travel concierge. How can I assist you today?</div>
      </div>
    </div>
  </div>

  <div class="cb-footer" id="cbFooter" style="display:none;">
    <form class="cb-input-wrap" id="cbForm">
      <input type="text" class="cb-input" id="cbInput" placeholder="Ask Aura about Rome..." autocomplete="off">
      <button type="submit" class="cb-send" aria-label="Send Message">
        <svg viewBox="0 0 512 512"><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
      </button>
    </form>
  </div>

  <!-- Bottom Nav -->
  <div class="cb-bottom-nav">
    <button class="cb-nav-btn active" id="cbNavHome">
      <svg viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
      Home
    </button>
    <button class="cb-nav-btn" id="cbNavMessages">
      <svg viewBox="0 0 512 512"><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>
      Messages
    </button>
    <button class="cb-nav-btn" id="cbNavHelp" onclick="window.open('https://wa.me/39339778400','_blank')">
      <svg viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM169.8 165.3c7.9-22.3 29.1-37.3 52.8-37.3h58.3c34.9 0 63.1 28.3 63.1 63.1c0 22.6-12.1 43.5-31.7 54.8L280 264.4c-.2 .1-.4 .3-.6 .5V288c0 13.3-10.7 24-24 24s-24-10.7-24-24V256c0-7 3.5-13.6 9.4-17.4l32.1-20.6c11.6-7.4 18.7-20 18.7-33.8c0-21.7-17.6-39.2-39.2-39.2H194.7c-9 0-17 5.7-20 14.2l-14 39.5c-4.4 12.5-18.4 19-30.8 14.6s-19-18.4-14.6-30.8l14.4-41zM256 352a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
      Help
    </button>
  </div>
</div>

<button class="chatbot-toggler" id="cbToggler" aria-label="Toggle Chatbot" onclick="window.toggleChatbot(event)">
  <!-- Solid Chat Bubble Icon -->
  <svg viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 22.7 456.5 22 458c-1.4 2.8-2 5.8-2 8.8 0 11 9 20 20 20 5.4 0 10.6-2.1 14.6-5.8 47.9-43.9 83-60.5 106.8-68 30.1 11.2 62.7 17.5 96.6 17.5 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"/></svg>
  <span class="cb-close">&times;</span>
</button>

<script>
(function(){
  // WhatsApp toggle logic removed in favor of static small stack
  
  var toggler = document.getElementById('cbToggler');
  var win = document.getElementById('cbWindow');
  var form = document.getElementById('cbForm');
  var input = document.getElementById('cbInput');
  var homeView = document.getElementById('cbHomeView');
  var messagesView = document.getElementById('cbMessagesView');
  var footer = document.getElementById('cbFooter');
  var closeBtn = document.getElementById('cbHeaderClose');
  
  var navHome = document.getElementById('cbNavHome');
  var navMessages = document.getElementById('cbNavMessages');

  window.toggleChatbot = function(e) {
    if(e) e.preventDefault();
    if (toggler) toggler.classList.toggle('open');
    if (win) win.classList.toggle('open');
    if (win && win.classList.contains('open') && messagesView && messagesView.classList.contains('active')) {
      input.focus();
    }
  };

  if (closeBtn) closeBtn.addEventListener('click', toggleChatbot);

  function switchView(view) {
    if(view === 'home') {
      homeView.classList.add('active');
      messagesView.classList.remove('active');
      footer.style.display = 'none';
      navHome.classList.add('active');
      navMessages.classList.remove('active');
    } else {
      homeView.classList.remove('active');
      messagesView.classList.add('active');
      footer.style.display = 'block';
      navHome.classList.remove('active');
      navMessages.classList.add('active');
      setTimeout(function(){ input.focus(); }, 100);
      messagesView.scrollTop = messagesView.scrollHeight;
    }
  }

  navHome.addEventListener('click', function(){ switchView('home'); });
  navMessages.addEventListener('click', function(){ switchView('messages'); });

  window.startChat = function(text) {
    switchView('messages');
    if(text) {
      handleInput(text);
    }
  };

  function addMsg(text, sender) {
    var wrap = document.createElement('div');
    wrap.className = 'cb-msg-wrapper ' + sender;
    
    var div = document.createElement('div');
    div.className = 'cb-msg ' + sender;
    div.innerHTML = text;
    
    wrap.appendChild(div);
    messagesView.appendChild(wrap);
    messagesView.scrollTop = messagesView.scrollHeight;
  }

  function showTyping() {
    var wrap = document.createElement('div');
    wrap.className = 'cb-msg-wrapper bot';
    wrap.id = 'cbTypingIndicator';
    wrap.innerHTML = '<div class="cb-typing"><div class="cb-dot"></div><div class="cb-dot"></div><div class="cb-dot"></div></div>';
    messagesView.appendChild(wrap);
    messagesView.scrollTop = messagesView.scrollHeight;
  }

  function removeTyping() {
    var indicator = document.getElementById('cbTypingIndicator');
    if(indicator) indicator.remove();
  }

  function handleInput(txt) {
    if(!txt) return;
    addMsg(txt, 'user');
    input.value = '';
    
    showTyping();
    
    setTimeout(function(){
      removeTyping();
      var reply = "That sounds wonderful! Our most popular experience is the <b>Colosseum Skip-the-Line</b> tour. <br><br>Would you like to see the available time slots for this week?";
      var tLower = txt.toLowerCase();
      
      if(tLower.includes('vatican')) {
        reply = "Ah, the Vatican! &#127984; We offer VIP early access to the Sistine Chapel so you can beat the crowds. Highly recommended! Check out our packages.";
      } else if(tLower.includes('price') || tLower.includes('cost') || tLower.includes('deal')) {
        reply = "Our experiences range from €18 for basic entry to €109 for full VIP packages. <br><br>&#127881; <b>Secret tip:</b> Use code <b>ROME15</b> at checkout for 15% off!";
      } else if(tLower.includes('how do i book')) {
        reply = "Booking is easy! Just choose a tour from our website and click 'Book Now', or we can handle the booking right here in this chat or over WhatsApp.";
      } else if(tLower.includes('included')) {
        reply = "Our tours typically include skip-the-line tickets, an expert guide, and headsets. You can check the specific tour details for exact inclusions!";
      } else if(tLower.includes('cancellation')) {
        reply = "We offer a 100% free cancellation policy up to 24 hours before your tour starts. Peace of mind guaranteed! &#9989;";
      } else if(tLower.includes('hi') || tLower.includes('hello')) {
        reply = "Ciao! How can I make your Rome trip unforgettable today?";
      }

      addMsg(reply, 'bot');
    }, 1200 + Math.random() * 800);
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    handleInput(input.value.trim());
  });
})();
</script>
<!-- APP-LIKE MOBILE BOTTOM NAV -->
<nav class="mobile-bottom-nav">
  <a href="#" class="mbn-item active">
    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
    <span>Home</span>
  </a>
  <a href="#" class="mbn-item" onclick="toggleNavSearch(); return false;">
    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
    <span>Search</span>
  </a>
  <a href="#" class="mbn-item">
    <div style="position:relative">
      <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
      <span class="mbn-badge" style="background:#ef4444;">0</span>
    </div>
    <span>Wishlist</span>
  </a>
  <a href="#" class="mbn-item">
    <div style="position:relative">
      <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
      <span class="mbn-badge">3</span>
    </div>
    <span>Cart</span>
  </a>
  <a href="#" class="mbn-item">
    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
    <span>Max</span>
  </a>
</nav>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 600,
    once: true,
    offset: 0,
    mirror: false,
    easing: 'ease-out-cubic'
  });
</script>
</body>
</html>