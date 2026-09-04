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
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700;800;900&family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('engine1/style.css') }}" />
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
html{scroll-behavior:smooth;overflow-x:hidden;}
body{font-family:'Mulish',sans-serif;background:#f4efe6;color:#1a1a2e;overflow-x:hidden;max-width:100%;}

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
  gap:8px;
  text-decoration:none;
  flex-shrink:0;
  margin-right:36px;
}
.nav-logo-badge{
  width:34px;height:34px;
  border-radius:8px;
  background:linear-gradient(135deg,#c8a84e 0%,#a58530 100%);
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 4px 18px rgba(200,168,78,.4);
  transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s;
  position:relative;
  overflow:hidden;
  flex-shrink:0;
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
  font-size:16px;
  font-weight:900;
  letter-spacing:1px;
  display:block;
  color:#fff;
  filter: drop-shadow(0px 2px 8px rgba(0,0,0,0.5));
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
.nav-links a:hover::after,.nav-links a.nav-active::after, .nav-links a.router-link-active::after{
  transform:scaleX(1);
}
.nav-links a.nav-active, .nav-links a.router-link-active{
  color:#c8a84e;
  background:rgba(200,168,78,.1);
  font-weight:600;
}

/* Nav Dropdown */
.nav-dropdown { position: relative; }
.nav-dropdown:hover .dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateX(-50%) translateY(0);
  pointer-events: auto;
}
.dropdown-menu {
  position: absolute;
  top: calc(100% + 5px);
  left: 50%;
  transform: translateX(-50%) translateY(10px);
  background: rgba(12,22,38,.98);
  backdrop-filter: blur(24px) saturate(180%);
  -webkit-backdrop-filter: blur(24px) saturate(180%);
  border: 1px solid rgba(200,168,78,.15);
  border-radius: 16px;
  box-shadow: 0 10px 40px rgba(0,0,0,.5);
  padding: 8px 0;
  min-width: 220px;
  opacity: 0;
  visibility: hidden;
  transition: all .3s cubic-bezier(.22,1,.36,1);
  z-index: 200;
  pointer-events: none;
  display: flex;
  flex-direction: column;
}
.dropdown-menu.mega-menu {
  width: 600px;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}
.mega-menu-item {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-start !important;
  padding: 12px !important;
  text-decoration: none;
  border-radius: 12px !important;
  background: rgba(255,255,255,0.03) !important;
  border: 1px solid rgba(255,255,255,0.08) !important;
  transition: all .3s cubic-bezier(.22,1,.36,1) !important;
}
.mega-menu-item::after { display: none !important; }
.mega-menu-item:hover {
  background: rgba(200,168,78,0.08) !important;
  border-color: rgba(200,168,78,0.3) !important;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
.mega-img {
  width: 60px;
  height: 60px;
  border-radius: 10px;
  object-fit: cover;
  flex-shrink: 0;
  margin-right: 16px;
  border: 2px solid rgba(255,255,255,0.1);
  transition: border-color .3s;
}
.mega-menu-item:hover .mega-img {
  border-color: #c8a84e;
}
.mega-text {
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.mega-title {
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  font-family: 'Cormorant Garamond', serif;
  margin-bottom: 4px;
  letter-spacing: 0.5px;
}
.mega-subtitle {
  color: #c8a84e;
  font-size: 12.5px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  opacity: 0.8;
  transition: opacity .3s, transform .3s;
}
.mega-menu-item:hover .mega-subtitle {
  opacity: 1;
  transform: translateX(4px);
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
.lang-list{
  max-height:280px;
  overflow-y:auto;
  scrollbar-width:thin;
  scrollbar-color:#c8a84e #e9e2d3;
}
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
.nav-ham svg.ham-icon { opacity: 1; transform: rotate(0) scale(1); }
.nav-ham svg.close-icon { opacity: 0; transform: rotate(-90deg) scale(0.5); }
.nav-ham.open svg.ham-icon { opacity: 0; transform: rotate(90deg) scale(0.5); }
.nav-ham.open svg.close-icon { opacity: 1; transform: rotate(0) scale(1); }

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

/* === SMART SLIDER (Cinematic Zoom-Blur) === */
.smart-slider{position:relative;width:100%;height:100vh;overflow:hidden;min-height:500px;}
.ss-slides{position:relative;width:100%;height:100%;}
.ss-slide{position:absolute;inset:0;opacity:0;z-index:0;pointer-events:none;transition:opacity 1s ease-in-out;}
.ss-slide.active{opacity:1;z-index:2;pointer-events:auto;}
.ss-slide-bg{position:absolute;inset:0;background-size:cover;background-position:center;}
.ss-slide::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(11,22,35,.72) 0%,rgba(11,22,35,.55) 40%,rgba(11,22,35,.78) 100%);z-index:1}

.ss-dots{position:absolute;bottom:36px;left:50%;transform:translateX(-50%);z-index:10;display:flex;gap:10px}
.ss-dot{width:8px;height:8px;border-radius:9999px;background:rgba(255,255,255,.3);border:none;cursor:pointer;transition:all .4s;padding:0}
.ss-dot.active{background:#c8a84e;width:28px;border-radius:4px}
.ss-arrow{position:absolute;top:50%;z-index:11;width:50px;height:50px;border-radius:50%;background:rgba(255,255,255,.08);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.15);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .35s;opacity:0.8;}
.smart-slider:hover .ss-arrow{opacity:1}
.ss-arrow:hover{background:#c8a84e;color:#0b1623;border-color:#c8a84e;transform:translateY(-50%) scale(1.1)}
.ss-arrow-l{left:24px;top:50%;transform:translateY(-50%)}
.ss-arrow-r{right:24px;top:50%;transform:translateY(-50%)}

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
.ds-frame{
  position:absolute;
  inset:12px;
  border:8px solid rgba(255,255,255,.8);
  border-radius:10px;
  pointer-events:none;
  z-index:3;
}
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
  transition:all .4s;
}
.ds-card:hover .ds-name{
  bottom:auto;
  top:30%;
  transform:translateY(-50%);
}
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
.ds-dots{display:flex;justify-content:center;gap:8px;padding:18px 0 0}
.ds-dot{
  width:10px;height:10px;
  border-radius:50%;
  background:rgba(255,255,255,.2);
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

/* Custom Overlay for Hero */
.custom-wow-overlay {
    position: absolute;
    top: 28%;
    left: 8%;
    z-index: 60;
    width: 90%;
    max-width: 700px;
    pointer-events: none;
}
.custom-slide-text {
    position: relative;
    width: 100%;
    opacity: 1;
    pointer-events: auto;
}
.cst-subtitle { font-size: 14px; font-weight: 800; letter-spacing: 3px; color: #ffffff; text-transform: uppercase; margin-bottom: 12px; line-height: 1.2; text-align: left; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
.cst-title { font-family: "Cormorant Garamond", serif; font-size: clamp(40px, 7vw, 75px); font-weight: 900; line-height: 1.05; margin-bottom: 20px; color: #ffffff; text-shadow: 0 4px 20px rgba(0,0,0,0.8); }
.cst-buttons { display: flex; gap: 16px; margin-top: 15px; justify-content: flex-start; }
.cst-btn { font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 32px; border-radius: 50px; pointer-events: auto; text-transform: uppercase; letter-spacing: 1.5px; font-size: 13px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.cst-btn-primary { background: linear-gradient(135deg, #FFD700, #DAA520); color: #000; box-shadow: 0 6px 20px rgba(218, 165, 32, 0.35); border: 1.5px solid #FFD700; }
.cst-btn-primary:hover { background: transparent; color: #FFD700; transform: translateY(-4px); box-shadow: 0 10px 25px rgba(255, 215, 0, 0.2); }
.cst-btn-secondary { background: rgba(255,255,255,0.15); border: 2px solid #ffffff; color: #ffffff; backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.cst-btn-secondary:hover { background: #ffffff; color: #000; transform: translateY(-6px) scale(1.03); box-shadow: 0 15px 40px rgba(255,255,255,0.5); }

/* Filters on Hero */
.mobile-slide-filter { margin-top: 12px; width: 100%; margin-left: auto; margin-right: auto; padding: 0 10px; }
.msf-form { display: flex; flex-direction: column; gap: 8px; width: 100%; max-width: 270px; margin: 0 auto; align-items: center; background: rgba(11, 22, 35, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.12); padding: 10px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.4); }
.msf-selects { display: flex; gap: 8px; width: 100%; justify-content: space-between; }
.msf-select-wrapper { flex: 1; position: relative; }
.msf-select { width: 100%; background: rgba(255, 255, 255, 0.95); color: #0b1623; font-size: 11px; font-weight: 700; padding: 8px 20px 8px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.8); appearance: none; outline: none; height: 32px; }
.msf-btn { background: linear-gradient(135deg, #FFD700, #DAA520); color: #0b1623; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; border: none; border-radius: 6px; padding: 0 24px; height: 32px; cursor: pointer; }
.desktop-global-filter { display: none; }

/* Hide hero slider prev/next & play controls (managed via custom overlay) */
#wowslider-container1 a.ws_next,
#wowslider-container1 a.ws_prev,
#wowslider-container1 .ws_playpause,
#wowslider-container1 .ws-title { display: none !important; }

@media (min-width: 769px) {
    .mobile-slide-filter { display: none !important; }
    .desktop-global-filter { 
        display: block;
        position: relative;
        margin-top: 30px;
        width: 100%;
        max-width: 700px;
        padding: 0; 
        background-color: transparent; 
        z-index: 65;
    }
    .desktop-global-filter .cst-global-form { display: flex; align-items: center; padding: 8px 12px; border-radius: 12px; background: #fff; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border: none; }
    .desktop-global-filter .cst-global-select { flex: 1; border: none; background: transparent; outline: none; appearance: none; font-size: 14px; padding: 12px 30px 12px 20px; color: #333; cursor: pointer; background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="%23333" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>'); background-repeat: no-repeat; background-position: right 10px center; background-size: 14px; }
    .desktop-global-filter .border-right { border-right: 1px solid #eee; }
    .desktop-global-filter .cst-global-btn { background: linear-gradient(135deg, #ddb94e, #c8a84e); border: none; display: flex; align-items: center; justify-content: center; border-radius: 50%; width: 44px; height: 44px; color: #0b1623; box-shadow: 0 2px 8px rgba(200,168,78,0.4); cursor: pointer; transition: transform 0.2s; flex-shrink: 0; }
}

@media(max-width:900px){
  .nav-links, .nav-divider, .nav-search-btn { display: none !important; }
  .nav-ham { display: flex !important; }
  .nav-inner { padding: 0 16px; height: 60px; }
  .nav-actions { margin-left: auto; gap: 8px; align-items: center; }
  .nav-logo { margin-right: 12px; }
  .nav-translate { margin-left: 0; }
  .nav-translate-label { display: none; }
  .nav-translate-btn { width: 36px; height: 36px; padding: 0; justify-content: center; gap: 2px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); transition: background .2s, border-color .2s, transform .2s; }
  .nav-translate-btn:active { transform: scale(.94); background: rgba(200,168,78,.15); border-color: rgba(200,168,78,.5); }
  .nav-translate-btn::before { content: '\1F310'; font-size: 14px; line-height: 1; filter: brightness(1.1); }
  .nav-translate-btn .lang-chevron { display: block; width: 9px; height: 9px; margin-left: 1px; opacity: .8; }
  .nav-wishlist-btn, .nav-cart-btn, .nav-account-avatar { display: none !important; }
  .nav-ham { width: 36px; height: 36px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 0; transition: background .2s, border-color .2s, transform .2s; }
  .nav-ham:active { transform: scale(.94); background: rgba(200,168,78,.15); border-color: rgba(200,168,78,.5); }
  .nav-ham svg { width: 20px; height: 20px; }
}

/* Floating Contact & Chatbot */
.chatbot-toggler {
  position: fixed; bottom: 24px; right: 24px; width: 64px; height: 64px; border-radius: 50%;
  background: linear-gradient(135deg, #c8a84e, #a58530); color: #0b1623; border: 2px solid rgba(255,255,255,0.2);
  display: flex; align-items: center; justify-content: center; cursor: pointer;
  box-shadow: 0 0 20px rgba(200, 168, 78, 0.5); z-index: 1000; transition: all 0.4s;
}
.chatbot-toggler svg { width: 32px; height: 32px; fill: currentColor; }
.chatbot-toggler .cb-close { position: absolute; opacity: 0; font-size: 28px; font-weight: bold; }
.chatbot-toggler.open { background: #0b1623; color: #c8a84e; border-color: #c8a84e; }
.chatbot-toggler.open svg { opacity: 0; }
.chatbot-toggler.open .cb-close { opacity: 1; }

.chatbot-window {
  position: fixed; bottom: 100px; right: 24px; width: 360px; max-width: calc(100vw - 48px);
  height: 500px; max-height: calc(100vh - 120px); background: rgba(11, 22, 35, 0.95);
  backdrop-filter: blur(20px); border: 1px solid rgba(200, 168, 78, 0.4); border-radius: 24px;
  box-shadow: 0 24px 60px rgba(0,0,0,0.7); z-index: 999; display: flex; flex-direction: column;
  overflow: hidden; opacity: 0; pointer-events: none; transform: translateY(40px) scale(0.9);
  transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
}
.chatbot-window.open { opacity: 1; pointer-events: auto; transform: translateY(0) scale(1); }

.cb-header {
  padding: 16px 20px; background: linear-gradient(135deg, rgba(200, 168, 78, 0.2), rgba(200, 168, 78, 0.05));
  border-bottom: 1px solid rgba(200, 168, 78, 0.3); display: flex; align-items: center; gap: 12px;
}
.cb-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #c8a84e, #e4c976); display: flex; align-items: center; justify-content: center; }
.cb-avatar svg { width: 24px; height: 24px; fill: currentColor; }
.cb-title-wrap { flex: 1; }
.cb-title { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 800; color: #c8a84e; }
.cb-status { font-size: 11px; color: rgba(255, 255, 255, 0.7); }
.cb-header-close { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; width: 28px; height: 28px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; }

.cb-body { flex: 1; min-height: 0; display: flex; flex-direction: column; }
.cb-body-inner { display: none; flex-direction: column; flex: 1; overflow-y: auto; padding: 16px 20px; gap: 16px; }
.cb-body-inner.active { display: flex; }
.cb-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(200,168,78,0.15); border-radius: 20px; padding: 20px; }
.cb-card-title { font-size: 14px; font-weight: 700; color: #c8a84e; margin-bottom: 16px; text-transform: uppercase; }
.cb-action-btn { display: flex; align-items: center; gap: 14px; width: 100%; padding: 12px 14px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; color: #fff; font-size: 13.5px; cursor: pointer; margin-bottom: 8px; text-decoration: none; }
.cb-action-btn:hover { background: rgba(200,168,78,0.15); border-color: rgba(200,168,78,0.4); }
.cb-action-btn .arr { margin-left: auto; color: #c8a84e; }

.cb-msg-wrapper { display: flex; flex-direction: column; }
.cb-msg { max-width: 85%; padding: 12px 16px; border-radius: 18px; font-size: 13.5px; line-height: 1.5; }
.cb-msg-wrapper.bot { align-items: flex-start; }
.cb-msg-wrapper.user { align-items: flex-end; }
.cb-msg.bot { background: rgba(255, 255, 255, 0.08); color: #fff; }
.cb-msg.user { background: linear-gradient(135deg, #c8a84e, #a58530); color: #0b1623; font-weight: 600; }

.cb-footer { padding: 14px 18px; background: rgba(0, 0, 0, 0.3); border-top: 1px solid rgba(200, 168, 78, 0.15); }
.cb-input-wrap { display: flex; align-items: center; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(200, 168, 78, 0.2); border-radius: 99px; padding: 4px 4px 4px 14px; }
.cb-input { flex: 1; background: none; border: none; outline: none; color: #fff; font-size: 13.5px; }
.cb-send { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #c8a84e, #a58530); color: #0b1623; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; }
.cb-send svg { width: 16px; height: 16px; fill: currentColor; }

.cb-bottom-nav { display: flex; border-top: 1px solid rgba(200,168,78,0.2); background: rgba(8,15,28,0.95); padding: 10px 0 14px; }
.cb-nav-btn { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; background: none; border: none; color: rgba(255,255,255,0.4); font-size: 11px; font-weight: 600; cursor: pointer; }
.cb-nav-btn.active { color: #c8a84e; }
.cb-nav-btn svg { width: 20px; height: 20px; fill: currentColor; }

/* Floating Socials Desktop */
.fs-bar { position: fixed; top: 50%; right: 0; transform: translateY(-50%); z-index: 999; display: flex; flex-direction: column; gap: 8px; align-items: center; background: rgba(11,22,35,.85); backdrop-filter: blur(12px); padding: 10px 8px; border-radius: 20px 0 0 20px; border: 1px solid rgba(255,255,255,.08); }
.fs-divider { width: 24px; height: 1px; background: rgba(255,255,255,0.12); }
.fs-whatsapp { width: 46px; height: 46px; border-radius: 50%; background: linear-gradient(135deg, #25D366, #128C7E); color: white; display: flex; align-items: center; justify-content: center; text-decoration: none; }
.fs-whatsapp svg { fill: #fff; width: 26px; height: 26px; }
.fs-minor { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; }
.fs-minor svg { width: 16px; height: 16px; }
.fs-facebook { background: #1877F2; }
.fs-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }

/* Mobile Floating WA */
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
.fcs-cb:hover { transform: scale(1.08); }

/* Mobile Bottom Nav */
.mobile-bottom-nav { display: none; position: fixed; bottom: 0; left: 0; right: 0; background: rgba(11, 22, 35, 0.95); backdrop-filter: blur(20px); border-top: 1px solid rgba(200, 168, 78, 0.3); z-index: 9999; }
.mbn-item { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 10px 0 8px; color: rgba(255,255,255,0.5); text-decoration: none; gap: 4px; font-size: 10px; font-weight: 600; }
.mbn-item.active { color: #c8a84e; }
.mbn-badge { position: absolute; top: -4px; right: -6px; background: #c8a84e; color: #0b1623; font-size: 9px; font-weight: 800; width: 16px; height: 16px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }

@media(max-width:900px){
  .fs-bar { display: none !important; }
  .mobile-bottom-nav { display: flex; }
  body { padding-bottom: 60px; }
  .chatbot-toggler { display: none !important; }
  .chatbot-window { bottom: 16vh !important; right: 10px !important; left: 10px !important; width: auto !important; height: 54vh !important; border-radius: 18px !important; }
}
@media (min-width: 901px) {
  .floating-contact-stack, .mobile-floating-wa { display: none !important; }
}

</style>

<script>
window.__NIRT__ = {
  company: @json($content ?? null)
};
</script>

</head>
<body>

  <!-- VUE SPA ROOT -->
  <div id="app"></div>

  <!-- Vite App Bundle -->
  @php
    $manifestPath = public_path('build/.vite/manifest.json');
    $entryFile = 'build/js/app.js';
    $cssFile = null;
    if (file_exists($manifestPath)) {
      $manifest = json_decode(file_get_contents($manifestPath), true);
      if (isset($manifest['resources/js/app.js']['file'])) {
        $entryFile = 'build/' . $manifest['resources/js/app.js']['file'];
      }
      if (isset($manifest['resources/js/app.js']['css'][0])) {
        $cssFile = 'build/' . $manifest['resources/js/app.js']['css'][0];
      }
    }
  @endphp

  @if($cssFile && file_exists(public_path($cssFile)))
    <link rel="stylesheet" href="{{ asset($cssFile) }}">
  @endif
  <!-- jQuery & WOW Slider Scripts -->
  <script src="{{ asset('engine1/jquery.js') }}"></script>
  <script src="{{ asset('engine1/wowslider.js') }}"></script>
  <script src="{{ asset('engine1/script.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script type="module" src="{{ asset($entryFile) }}"></script>

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
