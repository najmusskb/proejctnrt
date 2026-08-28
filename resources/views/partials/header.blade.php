<!-- PREMIUM NAVBAR -->
<nav id="mainNav">
  <div class="nav-inner">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="nav-logo" aria-label="{{ $content->com_name ?? 'Journey With Mr. J' }} Home">
      @if(isset($content->logo))
      <img src="{{ asset($content->logo) }}" alt="{{ $content->com_name }}" style="height: 48px; border-radius: 12px; object-fit: contain;">
      @else
      <div class="nav-logo-badge">
        <svg width="26" height="26" viewBox="0 0 40 40" fill="none">
          <circle cx="20" cy="20" r="16" stroke="rgba(255,255,255,0.6)" stroke-width="1.5"/>
          <text x="20" y="27" text-anchor="middle" font-family="Playfair Display,serif" font-size="16" font-weight="700" fill="#fff">MJ</text>
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
      <li><a href="#destinations" id="navDestinations">Destinations</a></li>
      <li><a href="#tours" id="navTours">Tours</a></li>
      <li><a href="#" id="navTickets">Tickets</a></li>
      <li><a href="#" id="navContact">Contact Us</a></li>
    </ul>



    <!-- Right Side Actions -->
    <div class="nav-divider"></div>
    <div class="nav-actions">

      <!-- Language -->
      <button class="nav-lang-btn" aria-label="Change language">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
        EN
      </button>

      <!-- Cart -->
      <button class="nav-cart-btn" aria-label="Shopping cart">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        <span class="nav-cart-badge">3</span>
      </button>

      <!-- Account CTA -->
      <a href="#" class="nav-account-btn">
        My Account
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>

      <!-- Hamburger (mobile) -->
      <button class="nav-ham" id="navHam" aria-label="Open menu" onclick="toggleMobileNav()">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

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

