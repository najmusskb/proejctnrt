<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Main</div>
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Shop</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#shopLayouts" aria-expanded="false" aria-controls="shopLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Manage Shop
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="shopLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Route::is('product.index') || Route::is('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}"><i class="sb-mini-icon fas fa-couch"></i> Products</a>
                        <a class="nav-link {{ Route::is('category.index') || Route::is('category.*') ? 'active' : '' }}" href="{{ route('category.index') }}"><i class="sb-mini-icon fas fa-layer-group"></i> Categories</a>
                        <a class="nav-link {{ Route::is('brands.index') || Route::is('brand.*') ? 'active' : '' }}" href="{{ route('brands.index') }}"><i class="sb-mini-icon fas fa-tag"></i> Brands</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Web Contents</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                    Manage Content
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('slider.index') }}"><i class="sb-mini-icon fas fa-sliders-h"></i> Add Slider</a>
                        {{-- <a class="nav-link" href="{{ route('category.index') }}">Add Category</a> --}}
                        {{-- <a class="nav-link" href="{{ route('brands.index') }}">Add Brand</a> --}}
                        {{-- <a class="nav-link" href="{{ route('product.index') }}">Add Product</a> --}}
                        <a class="nav-link" href="{{ route('abouts') }}"><i class="sb-mini-icon fas fa-building"></i> About Us</a>
                        {{-- <a class="nav-link" href="{{ route('management.index') }}"><i class="sb-mini-icon fas fa-user-tie"></i> Management</a> --}}
                        <a class="nav-link" href="{{ route('gallery.index') }}"><i class="sb-mini-icon fas fa-images"></i> Gallery</a>
                        <a class="nav-link" href="{{ route('service.index') }}"><i class="sb-mini-icon fas fa-concierge-bell"></i> Services</a>
                        <a class="nav-link" href="{{ route('testimonial.index') }}"><i class="sb-mini-icon fas fa-comment-dots"></i> Testimonials</a>
                        <a class="nav-link" href="{{ route('faq.index') }}"><i class="sb-mini-icon fas fa-question-circle"></i> FAQ</a>
                        <a class="nav-link" href="{{ route('why_choose_us.index') }}"><i class="sb-mini-icon fas fa-thumbs-up"></i> Why Choose Us</a>
                        <a class="nav-link" href="{{ route('blog.index') }}"><i class="sb-mini-icon fas fa-blog"></i> Blog</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#settingLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="settingLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('company.profile') }}"><i class="sb-mini-icon fas fa-address-card"></i> Company Profile</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Support</div>
                <a class="nav-link {{ Route::is('messages.index') ? 'active' : '' }}" href="{{ route('messages.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                    Public Message
                </a>

            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small text-white-50">Logged in as</div>
            <div class="fw-bold">{{ Auth::user()->name }}</div>
            <a href="{{ route('admin.logout') }}" class="sb-footer-logout"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
        </div>
    </nav>
</div>
