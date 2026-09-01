<!-- PREMIUM NAVBAR -->
<nav id="mainNav">
  <div class="nav-inner">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="nav-logo" aria-label="{{ $content->com_name ?? 'Journey With Mr. J' }} Home">
      @if(isset($content->logo))
      <img src="{{ asset($content->logo) }}" alt="{{ $content->com_name }}" style="height: 64px; border-radius: 12px; object-fit: contain;">
      @else
      <div class="nav-logo-badge">
        <svg width="32" height="32" viewBox="0 0 40 40" fill="none">
          <circle cx="20" cy="20" r="18" stroke="rgba(255,255,255,0.7)" stroke-width="2"/>
          <text x="20" y="27" text-anchor="middle" font-family="Cormorant Garamond,serif" font-size="18" font-weight="800" fill="#fff">MJ</text>
        </svg>
      </div>
      @endif
      <div class="nav-logo-text">
        <span class="nav-logo-title" style="text-transform: uppercase;">{{ $content->com_name ?? 'JOURNEY WITH MR. J' }}</span>
      </div>
    </a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links" id="navLinks">
      <li><a href="#" class="nav-active" id="navHome">Home</a></li>
      <li><a href="#" id="navAbout">About Us</a></li>
      <li class="nav-dropdown">
        <a href="{{ route('destinations') }}" id="navDestinations" style="display:flex; align-items:center; gap:4px;">
          Destinations
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="dropdown-menu mega-menu">
          @php $navDestinations = \App\Models\Destination::where('status', 1)->get(); @endphp
          @foreach($navDestinations as $d)
          <a href="{{ route('destination.detail', $d->slug) }}" class="mega-menu-item">
            <img src="{{ asset($d->image) }}" alt="{{ $d->name }}" class="mega-img">
            <div class="mega-text">
              <span class="mega-title">{{ $d->name }}</span>
              <span class="mega-subtitle">Explore Tours &rarr;</span>
            </div>
          </a>
          @endforeach
        </div>
      </li>
      <li class="nav-dropdown">
        <a href="{{ route('tours') }}" id="navTours" style="display:flex; align-items:center; gap:4px;">
          Tours
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="dropdown-menu mega-menu">
          @php $navCategories = \App\Models\Category::where('status', 1)->take(6)->get(); @endphp
          @foreach($navCategories as $cat)
          <a href="{{ route('category.detail', $cat->slug) }}" class="mega-menu-item">
            <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}" class="mega-img">
            <div class="mega-text">
              <span class="mega-title" style="font-size: 14px; line-height: 1.3; margin-bottom: 6px;">{{ $cat->name }}</span>
              <span class="mega-subtitle" style="font-size: 11px;">Explore Tours &rarr;</span>
            </div>
          </a>
          @endforeach
        </div>
      </li>
      <li><a href="{{ route('tickets') }}" id="navTickets">Tickets</a></li>
      <li><a href="{{ route('contact') }}" id="navContact">Contact Us</a></li>
    </ul>

    <!-- Right Side Actions -->
    <div class="nav-divider"></div>
    <div class="nav-actions">

      <!-- Search -->
      <button class="nav-search-btn" aria-label="Search tours" onclick="toggleNavSearch()">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      </button>

      <!-- Language -->
      <div class="nav-translate" id="navTranslate">
        <button class="nav-translate-btn" type="button" onclick="toggleLangMenu(event)" aria-haspopup="true" aria-expanded="false">
          <span class="nav-translate-label">Select Language</span>
          <svg class="lang-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="lang-menu" id="langMenu" onclick="event.stopPropagation()">
          <input type="text" id="langSearch" class="lang-search" placeholder="Search language..." autocomplete="off" oninput="filterLangs(this.value)"/>
          <div class="lang-list" id="langList"></div>
        </div>
        <div id="google_translate_element" class="gt-widget"></div>
      </div>

      <!-- Wishlist -->
      <button class="nav-action-btn nav-wishlist-btn" aria-label="Wishlist">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
        </svg>
        <span class="nav-badge" style="background:#ef4444; color:#fff; border-color:#fff;">0</span>
      </button>

      <!-- Cart -->
      <button class="nav-action-btn nav-cart-btn" aria-label="Shopping bag">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span class="nav-badge">3</span>
      </button>

      <a href="#" class="nav-action-btn nav-account-avatar" aria-label="My Account" style="display:flex; align-items:center; gap:6px; padding:0 12px; width:auto; border-radius:20px;">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <span style="font-size:14px; font-weight:600;">Max</span>
      </a>

      <!-- Mobile Menu Toggle -->
      <button class="nav-ham" id="navHam" aria-label="Open menu" onclick="toggleMobileNav()">
        <svg class="ham-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="7" x2="20" y2="7"></line>
          <line x1="10" y1="12" x2="20" y2="12"></line>
          <line x1="6" y1="17" x2="20" y2="17"></line>
        </svg>
        <svg class="close-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>
</nav>

<!-- Header Search Overlay & Dropdown -->
<div class="nav-search-overlay" id="navSearchOverlay" onclick="toggleNavSearch()"></div>
<div class="nav-search-dropdown" id="navSearchDropdown">
  <button class="nav-search-close" onclick="toggleNavSearch()" aria-label="Close search">&#10005;</button>
  <div class="nav-search-inner">
    <div class="nav-search-input-wrap">
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" class="nav-search-input" id="navSearchInput" placeholder="Search tours, destinations, experiences..." onkeydown="if(event.key==='Enter'){toggleNavSearch();document.getElementById('tours').scrollIntoView({behavior:'smooth'});}" autocomplete="off"/>
    </div>
    <div class="nav-search-suggestions">
      <button class="nav-search-tag" onclick="fillSearch('Colosseum')">Colosseum</button>
      <button class="nav-search-tag" onclick="fillSearch('Vatican')">Vatican</button>
      <button class="nav-search-tag" onclick="fillSearch('Roman Forum')">Roman Forum</button>
      <button class="nav-search-tag" onclick="fillSearch('Trevi Fountain')">Trevi Fountain</button>
      <button class="nav-search-tag" onclick="fillSearch('Golf Cart')">Golf Cart</button>
      <button class="nav-search-tag" onclick="fillSearch('St. Peter\'s')">St. Peter's</button>
    </div>
  </div>
</div>

<!-- Mobile Drawer -->
<div class="nav-mobile-drawer" id="navMobileDrawer">
  <button class="nav-mobile-drawer-close" onclick="toggleMobileNav()" aria-label="Close menu">&#10005;</button>
  <a href="#" onclick="toggleMobileNav()">Home</a>
  <a href="#" onclick="toggleMobileNav()">About Us</a>
  <a href="#destinations" onclick="toggleMobileNav()">Destinations</a>
  <a href="#tours" onclick="toggleMobileNav()">Tours</a>
  <a href="#" onclick="toggleMobileNav()">Tickets</a>
  <a href="#" onclick="toggleMobileNav()">Contact Us</a>
</div>


<!-- Google Translate -->
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    autoDisplay: false
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
var LANG_LIST=[
  ['en','English'],['af','Afrikaans'],['sq','Shqip (Albanian)'],['am','አማርኛ (Amharic)'],['ar','العربية (Arabic)'],
  ['hy','Հայերեն (Armenian)'],['az','Azərbaycan (Azerbaijani)'],['eu','Euskara (Basque)'],['be','Беларуская (Belarusian)'],
  ['bn','বাংলা (Bengali)'],['bs','Bosanski (Bosnian)'],['bg','Български (Bulgarian)'],['ca','Català (Catalan)'],
  ['zh-CN','中文 (Chinese Simplified)'],['zh-TW','中文 (Chinese Traditional)'],['co','Corsican'],['hr','Hrvatski (Croatian)'],
  ['cs','Čeština (Czech)'],['da','Dansk (Danish)'],['nl','Nederlands (Dutch)'],['eo','Esperanto'],['et','Eesti (Estonian)'],
  ['tl','Filipino'],['fi','Suomi (Finnish)'],['fr','Français (French)'],['fy','Frisian'],['gl','Galego (Galician)'],
  ['ka','ქართული (Georgian)'],['de','Deutsch (German)'],['el','Ελληνικά (Greek)'],['gu','ગુજરાતી (Gujarati)'],
  ['ht','Kreyòl (Haitian Creole)'],['ha','Hausa'],['he','עברית (Hebrew)'],['hi','हिन्दी (Hindi)'],['hu','Magyar (Hungarian)'],
  ['is','Íslenska (Icelandic)'],['ig','Igbo'],['id','Bahasa Indonesia'],['ga','Gaeilge (Irish)'],['it','Italiano (Italian)'],
  ['ja','日本語 (Japanese)'],['jv','Javanese'],['kn','ಕನ್ನಡ (Kannada)'],['kk','Қазақ (Kazakh)'],['km','ខ្មែរ (Khmer)'],
  ['rw','Kinyarwanda'],['ko','한국어 (Korean)'],['ku','Kurdish'],['ky','Kyrgyz'],['lo','ລາວ (Lao)'],['lv','Latviešu (Latvian)'],
  ['lt','Lietuvių (Lithuanian)'],['lb','Lëtzebuergesch (Luxembourgish)'],['mk','Македонски (Macedonian)'],['mg','Malagasy'],
  ['ms','Bahasa Melayu'],['ml','മലയാളം (Malayalam)'],['mt','Malti (Maltese)'],['mi','Māori'],['mr','मराठी (Marathi)'],
  ['mn','Mongolian'],['my','မြန်မာ (Myanmar)'],['ne','नेपाली (Nepali)'],['no','Norsk (Norwegian)'],['or','ଓଡ଼ିଆ (Odia)'],
  ['ps','Pashto'],['fa','فارسی (Persian)'],['pl','Polski (Polish)'],['pt','Português (Portuguese)'],['pa','ਪੰਜਾਬੀ (Punjabi)'],
  ['ro','Română (Romanian)'],['ru','Русский (Russian)'],['sm','Samoan'],['gd','Gàidhlig (Scottish Gaelic)'],['sr','Srpski (Serbian)'],
  ['st','Sesotho'],['sn','Shona'],['sd','Sindhi'],['si','සිංහල (Sinhala)'],['sk','Slovenčina (Slovak)'],
  ['sl','Slovenščina (Slovenian)'],['so','Somali'],['es','Español (Spanish)'],['su','Sundanese'],['sw','Kiswahili (Swahili)'],
  ['sv','Svenska (Swedish)'],['tg','Tajik'],['ta','தமிழ் (Tamil)'],['tt','Tatar'],['te','తెలుగు (Telugu)'],['th','ไทย (Thai)'],
  ['tr','Türkçe (Turkish)'],['tk','Turkmen'],['uk','Українська (Ukrainian)'],['ur','اردو (Urdu)'],['ug','Uyghur'],
  ['uz','O‘zbek (Uzbek)'],['vi','Tiếng Việt (Vietnamese)'],['cy','Cymraeg (Welsh)'],['xh','Xhosa'],['yi','ייִדיש (Yiddish)'],
  ['yo','Yoruba'],['zu','Zulu']
];
var mymemBusy=false;
var mymemQueue=[];
var mymemCounter=0;

function renderLangs(filter){
  var list=document.getElementById('langList');
  if(!list)return;
  var f=(filter||'').toLowerCase();
  var html='';
  LANG_LIST.forEach(function(l){
    if(f && l[1].toLowerCase().indexOf(f)===-1 && l[0].indexOf(f)===-1)return;
    html+='<button type="button" class="lang-opt" data-code="'+l[0]+'">'+l[1]+'</button>';
  });
  list.innerHTML=html||'<div class="lang-empty">No language found</div>';
}
function filterLangs(v){ renderLangs(v); }
function toggleLangMenu(e){
  if(e)e.stopPropagation();
  var menu=document.getElementById('langMenu');
  var t=event.currentTarget||e.currentTarget;
  var open=menu.classList.toggle('open');
  if(t)t.setAttribute('aria-expanded',open?'true':'false');
  if(open){ renderLangs(''); var s=document.getElementById('langSearch'); if(s){s.value='';setTimeout(function(){s.focus();},60);} }
}
document.addEventListener('click',function(ev){
  var menu=document.getElementById('langMenu');
  var t=document.querySelector('.nav-translate-btn');
  if(menu&&!ev.target.closest('.nav-translate')){ if(menu.classList.contains('open')){menu.classList.remove('open');if(t)t.setAttribute('aria-expanded','false');} }
});
document.addEventListener('keydown',function(e){ if(e.key==='Escape'){ var m=document.getElementById('langMenu');m.classList.remove('open');var t=document.querySelector('.nav-translate-btn');if(t)t.setAttribute('aria-expanded','false'); } });

document.getElementById('langList').addEventListener('click',function(ev){
  var b=ev.target.closest('.lang-opt');
  if(b){ selectLang(b.getAttribute('data-code')); }
});

function selectLang(code){
  var menu=document.getElementById('langMenu');
  var t=document.querySelector('.nav-translate-btn');
  if(menu)menu.classList.remove('open');
  if(t)t.setAttribute('aria-expanded','false');
  applyLang(code);
}
function applyLang(code){
  if(!code)return;
  try{ localStorage.setItem('nirt_lang',code); }catch(e){}
  var sel=document.querySelector('#google_translate_element select.goog-te-combo');
  if(sel && sel.options && sel.options.length>0){
    try{ sel.value=code; sel.dispatchEvent(new Event('change',{bubbles:true})); }catch(e){}
    return;
  }
  translatePage(code);
}
function translatePage(tl){
  var nodes=[];
  var walker=document.createTreeWalker(document.body,NodeFilter.SHOW_TEXT,{
    acceptNode:function(n){
      var t=n.nodeValue.trim();
      if(t.length<2)return NodeFilter.FILTER_REJECT;
      var p=n.parentElement;
      if(!p)return NodeFilter.FILTER_REJECT;
      if(/SCRIPT|STYLE|NOSCRIPT|TEXTAREA|SELECT|OPTION/.test(p.tagName))return NodeFilter.FILTER_REJECT;
      if(p.closest('#google_translate_element,.lang-menu,.lang-search,.lang-list,.lang-opt,.nav-translate'))return NodeFilter.FILTER_REJECT;
      return NodeFilter.FILTER_ACCEPT;
    }
  });
  while(walker.nextNode()){ nodes.push(walker.currentNode); }
  mymemQueue=[]; mymemCounter=0; mymemBusy=false;
  nodes.forEach(function(n){ mymemQueue.push({node:n,text:n.nodeValue.trim()}); });
  processQueue(tl);
}
function processQueue(tl){
  if(mymemBusy)return;
  if(mymemCounter>=mymemQueue.length)return;
  var item=mymemQueue[mymemCounter];
  mymemBusy=true;
  var url='https://api.mymemory.translated.net/get?q='+encodeURIComponent(item.text.slice(0,430))+'&langpair=en|'+tl;
  fetch(url).then(function(r){return r.json();}).then(function(j){
    if(j&&j.responseData&&j.responseData.translatedText){ item.node.nodeValue=j.responseData.translatedText; }
    mymemCounter++; mymemBusy=false; processQueue(tl);
  }).catch(function(){ mymemCounter++; mymemBusy=false; processQueue(tl); });
}
(function(){
  var saved=null;
  try{ saved=localStorage.getItem('nirt_lang'); }catch(e){}
  if(saved&&saved!=='en'){
    var sel=document.querySelector('#google_translate_element select.goog-te-combo');
    if(sel&&sel.options&&sel.options.length>0){ applyLang(saved); }
    else{
      window.addEventListener('load',function(){ setTimeout(function(){ translatePage(saved); },400); });
    }
  }
})();
</script>
