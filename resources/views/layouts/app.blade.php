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
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
        playfair: ['"Playfair Display"', 'serif'],
        inter: ['"Inter"', 'sans-serif'],
      },
    }
  }
}
</script>
<style>
html{scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;background:#f4efe6;color:#1a1a2e;overflow-x:hidden}

/* ===== PREMIUM NAVBAR ===== */
#mainNav{
  position:fixed;
  top:0;left:0;right:0;
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
  transform: translateY(-100%);
}
#mainNav.scrolled{
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
  width:48px;height:48px;
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
.nav-logo-title{
  font-family:'Playfair Display',serif;
  font-size:24px;
  font-weight:800;
  background: linear-gradient(135deg, #c8a84e 0%, #e8c85a 40%, #ddb94e 60%, #c8a84e 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing:1px;
  display:block;
  filter: drop-shadow(0px 2px 8px rgba(200,168,78,0.35));
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
.nav-cart-btn{
  position:relative;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.14);
  color:rgba(255,255,255,.82);
  width:40px;height:40px;
  border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  transition:all .25s;
}
.nav-cart-btn:hover{
  background:rgba(200,168,78,.12);
  border-color:rgba(200,168,78,.4);
  color:#c8a84e;
  transform:translateY(-1px);
}
.nav-cart-badge{
  position:absolute;
  top:-5px;right:-5px;
  background:#c8a84e;
  color:#0b1623;
  font-size:9px;
  font-weight:800;
  width:17px;height:17px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  border:2px solid #0b1623;
  line-height:1;
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
  flex-direction:column;
  justify-content:center;
  gap:5px;
  width:38px;height:38px;
  background:rgba(255,255,255,.07);
  border:1.5px solid rgba(255,255,255,.14);
  border-radius:9px;
  cursor:pointer;
  padding:8px;
  margin-left:8px;
  transition:background .25s;
}
.nav-ham span{
  display:block;
  height:2px;
  background:#fff;
  border-radius:2px;
  transition:transform .3s,opacity .3s,width .3s;
  transform-origin:center;
}
.nav-ham.open span:nth-child(1){transform:rotate(45deg) translate(4px,4px);}
.nav-ham.open span:nth-child(2){opacity:0;width:60%;}
.nav-ham.open span:nth-child(3){transform:rotate(-45deg) translate(4px,-4px);}

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
  font-family:'Playfair Display',serif;
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
  font-size:12.5px;font-family:'Inter',sans-serif;
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
  font-family:'Inter',sans-serif;
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
  font-size:16px;font-family:'Inter',sans-serif;
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
  background:url('https://images.unsplash.com/photo-1516483638261-f4dbaf036963?w=1920&q=80&fit=crop') center/cover no-repeat fixed;
}
#destinations::before{
  content:'';position:absolute;inset:0;
  background:rgba(11,22,35,.45);
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
  font-family:'Playfair Display',serif;
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
.ss-title{font-family:'Playfair Display',serif;font-size:clamp(42px,8vw,84px);font-weight:700;color:#fff;line-height:1.05;margin-bottom:20px;text-shadow:0 4px 40px rgba(0,0,0,.6),0 2px 60px rgba(200,168,78,.12);opacity:0;transform:translateY(40px) translateX(-30px);transition:opacity 1s .15s,transform 1s .15s cubic-bezier(.22,1,.36,1)}
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
.about-search-bar input{flex:1;border:none;outline:none;font-size:15px;font-family:'Inter',sans-serif;color:#1a1a2e;background:transparent;opacity:0;transition:opacity .3s .2s}
.about-search-wrap.open .about-search-bar input{opacity:1}
.about-search-bar .search-close{width:36px;height:36px;border-radius:50%;border:none;background:#f4efe6;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .3s,transform .3s;flex-shrink:0;margin-right:4px}
.about-search-bar .search-close:hover{background:#e8e0d0;transform:rotate(90deg)}
.about-search-overlay{position:fixed;inset:0;background:rgba(11,22,35,.4);z-index:9;opacity:0;pointer-events:none;transition:opacity .4s;backdrop-filter:blur(4px)}

/* Responsive */
@media(max-width:1100px){.tour-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:900px){.blog-grid{grid-template-columns:1fr 1fr}.footer-grid{grid-template-columns:1fr 1fr}.hero-title{font-size:clamp(32px,7vw,56px) !important}}
@media(max-width:768px){.tour-grid{grid-template-columns:repeat(2,1fr)}.why-grid{grid-template-columns:1fr}}
@media(max-width:580px){.blog-grid{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr}}
@media(max-width:480px){.tour-grid{grid-template-columns:1fr}}

/* PREMIUM FLOATING SOCIAL BAR */
.fs-bar {
  position:fixed; top:50%; right:0; transform:translateY(-50%); z-index:999;
  display:flex; flex-direction:column; gap:10px; align-items:center;
  background:rgba(11,22,35,.75); backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
  padding:15px 12px; border-radius:24px 0 0 24px;
  box-shadow:-8px 0 30px rgba(0,0,0,.25); border:1px solid rgba(255,255,255,.1); border-right:none;
}
.fs-whatsapp {
  width: 54px; height: 54px; border-radius: 50%;
  background: linear-gradient(135deg, #25D366, #128C7E);
  color: white; display:flex; align-items:center; justify-content:center;
  box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
  position:relative; text-decoration:none;
  animation: waPulse 2s infinite;
  transition: transform 0.3s;
}
.fs-whatsapp:hover { transform: scale(1.15) translateX(-5px); }
@keyframes waPulse {
  0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); }
  70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
  100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
}
.fs-minor {
  width: 36px; height: 36px; border-radius: 50%;
  display:flex; align-items:center; justify-content:center;
  position:relative; text-decoration:none;
  transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
  color: white;
}
.fs-facebook { background: #1877F2; box-shadow: 0 4px 15px rgba(24, 119, 242, 0.2); }
.fs-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); box-shadow: 0 4px 15px rgba(228, 64, 95, 0.2); }
.fs-facebook:hover, .fs-instagram:hover { transform: translateX(-5px) scale(1.15); box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
.fs-whatsapp::before, .fs-minor::before {
  content:attr(data-tip); position:absolute; right:110%; background:rgba(8,16,28,.95);
  color:white; padding:6px 12px; border-radius:8px; font-size:12px; font-weight:600;
  white-space:nowrap; opacity:0; pointer-events:none; transform:translateX(10px);
  transition:all .3s ease; border:1px solid rgba(200,168,78,.25);
  box-shadow:0 6px 20px rgba(0,0,0,.3); margin-right: 5px;
}
.fs-whatsapp:hover::before, .fs-minor:hover::before { opacity:1; transform:translateX(0); }
</style>
</head>
<body>



    @include('partials.header')

    @yield('content')

    @include('partials.footer')


<!-- PREMIUM FLOATING SOCIAL BAR -->
<div class="fs-bar">
  <a href="https://wa.me/1234567890" target="_blank" class="fs-whatsapp" data-tip="Chat on WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z'/></svg>
  </a>
  <div style="width:100%; height:1px; background:rgba(255,255,255,0.1); margin: 2px 0;"></div>
  <a href="#" target="_blank" class="fs-minor fs-facebook" data-tip="Follow on Facebook">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
  </a>
  <a href="#" target="_blank" class="fs-minor fs-instagram" data-tip="Follow on Instagram">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
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
    if(currentScrollY>30){nav.classList.add('scrolled');}
    else{nav.classList.remove('scrolled');}
    
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
</body>
</html>