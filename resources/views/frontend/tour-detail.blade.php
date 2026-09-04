@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<style>
/* Smooth scrolling for tab navigation */
html { scroll-behavior: smooth; }

/* Hide scrollbar for gallery and tabs */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

/* Custom radio and checkbox styling if needed */
.custom-radio:checked + div { border-color: #c69c27; background-color: rgba(198, 156, 39, 0.05); }
.custom-radio:checked + div .radio-inner { background-color: #c69c27; border-color: #c69c27; }

/* Itinerary vertical line */
.itinerary-line::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    bottom: -10px;
    width: 2px;
    background: #e5e7eb; /* gray-200 */
    z-index: 0;
}
.itinerary-item:last-child .itinerary-line::before { display: none; }

/* Tab active state */
.tab-link.active {
    background-color: #c69c27;
    color: white;
    border-color: #c69c27;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease;
}
</style>

{{-- TOP SPACING FOR FIXED HEADER (adjust as needed based on your app layout) --}}
<div class="pt-[100px] bg-gray-50 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- BREADCRUMBS & ACTIONS --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between py-4">
            <nav class="flex items-center text-[13px] font-medium text-gray-500 mb-4 md:mb-0">
                <a href="{{ route('index') }}" class="hover:text-[#c69c27] transition">Home</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="{{ route('index') }}#tours" class="hover:text-[#c69c27] transition">Tours</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-gray-900 truncate max-w-[200px] sm:max-w-xs">{{ $tour->name }}</span>
            </nav>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-100 transition text-[13px] font-semibold text-gray-700">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg>
                    Share
                </button>
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 hover:bg-gray-100 transition text-[13px] font-semibold text-gray-700">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    Save
                </button>
            </div>
        </div>

        {{-- HERO TITLE --}}
        <div class="mb-6">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-3">{{ $tour->name }}</h1>
            @if($tour->rating)
            <div class="flex flex-wrap items-center gap-4 text-[14px] text-gray-600">
                <div class="flex items-center gap-1">
                    <span class="text-[#c69c27]">{!! str_repeat('&#9733;', round($tour->rating)) !!}</span>
                    <span class="font-bold text-gray-900 ml-1">{{ $tour->rating }}</span>
                    <span>({{ $tour->reviews_count ?? 0 }} reviews)</span>
                </div>
                @if($tour->meeting_point)
                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                <div class="flex items-center gap-1.5">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $tour->meeting_point }}
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- INFO PILLS --}}
        <div class="flex flex-wrap items-center gap-3 mb-8">
            <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Duration</div>
                    <div class="text-[13px] font-bold text-gray-900">{{ $tour->duration ?? '2 hours' }}</div>
                </div>
            </div>
            <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Group Size</div>
                    <div class="text-[13px] font-bold text-gray-900">{{ $tour->group_size ?? 'Small group' }}</div>
                </div>
            </div>
            <div class="bg-white border border-gray-100 shadow-sm rounded-full px-4 py-2.5 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <div>
                    <div class="text-[11px] text-gray-500 font-medium uppercase tracking-wide">Tour Type</div>
                    <div class="text-[13px] font-bold text-gray-900">{{ $tour->category->name ?? 'Guided Tour' }}</div>
                </div>
            </div>
        </div>

        {{-- GALLERY --}}
        @php
            $gallery = [asset($tour->image ?? 'images/no.png')];
            foreach($tour->images as $img) {
                $gallery[] = asset($img->image);
            }
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
            @foreach($gallery as $img)
            <a href="{{ $img }}" data-fancybox="gallery" class="relative cursor-pointer hover:opacity-95 transition group h-[300px] sm:h-[400px] md:h-[480px] rounded-[24px] overflow-hidden block">
                <img src="{{ $img }}" class="w-full h-full object-cover" alt="Gallery image">
                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition duration-300"></div>
            </a>
            @endforeach
        </div>

        {{-- BODY LAYOUT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- LEFT CONTENT COLUMN --}}
            <div class="lg:col-span-8">
                
                {{-- STICKY TABS --}}
                <div class="sticky top-[80px] z-40 bg-gray-50/90 backdrop-blur-md py-4 border-b border-gray-200 mb-8 overflow-x-auto no-scrollbar">
                    <div class="flex items-center gap-2 min-w-max">
                        <a href="#overview" class="tab-link active px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Overview</a>
                        @if(!empty(json_decode($tour->itinerary, true)))
                        <a href="#itinerary" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Tour Plan</a>
                        @endif
                        <a href="#included" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Included</a>
                        @if($tour->map_iframe || $tour->meeting_point)
                        <a href="#location" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">Location</a>
                        @endif
                        @if(!empty(json_decode($tour->faqs, true)))
                        <a href="#faq" class="tab-link px-5 py-2.5 rounded-full border border-gray-200 text-[14px] font-semibold text-gray-700 hover:border-gray-300 transition">FAQ</a>
                        @endif
                    </div>
                </div>

                {{-- SECTION: OVERVIEW --}}
                <section id="overview" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-5">Tour Overview</h2>
                    <div class="prose prose-gray max-w-none text-[15px] text-gray-600 leading-relaxed">
                        {!! $tour->description !!}
                    </div>
                </section>

                <hr class="border-gray-200 mb-12">

                {{-- SECTION: ITINERARY --}}
                @php
                  $itineraryData = json_decode($tour->itinerary, true);
                @endphp
                @if(!empty($itineraryData) && count($itineraryData) > 0)
                <section id="itinerary" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Tour Plan</h2>
                    <div class="relative space-y-6 ml-2">
                        @foreach($itineraryData as $i => $item)
                        <div class="itinerary-item relative flex items-start gap-5">
                            <div class="itinerary-line relative z-10 shrink-0 w-10 h-10 rounded-full bg-white border-2 border-[#c69c27] flex items-center justify-center text-[#c69c27] font-bold text-[14px] shadow-sm">
                                {{ $i + 1 }}
                            </div>
                            <div class="flex-1 pt-2 pb-6">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-2">{{ $item }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                <hr class="border-gray-200 mb-12">
                @endif

                {{-- SECTION: INCLUDED / EXCLUDED --}}
                @php
                  $includedData = json_decode($tour->included, true);
                  $excludedData = json_decode($tour->excluded, true);
                @endphp
                @if((!empty($includedData) && count($includedData) > 0) || (!empty($excludedData) && count($excludedData) > 0))
                <section id="included" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">What's Included</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        @if(!empty($includedData) && count($includedData) > 0)
                        <div>
                            <ul class="space-y-4">
                                @foreach($includedData as $it)
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-6 h-6 rounded-full bg-[#10b981]/10 flex items-center justify-center shrink-0">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    </div>
                                    <span class="text-[15px] text-gray-700 font-medium">{{ $it }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(!empty($excludedData) && count($excludedData) > 0)
                        <div>
                            <ul class="space-y-4">
                                @foreach($excludedData as $it)
                                <li class="flex items-start gap-3">
                                    <div class="mt-0.5 w-6 h-6 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </div>
                                    <span class="text-[15px] text-gray-700 font-medium">{{ $it }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                </section>
                <hr class="border-gray-200 mb-12">
                @endif

                {{-- SECTION: LOCATION --}}
                @if($tour->map_iframe || $tour->meeting_point)
                <section id="location" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Location & Meeting Point</h2>
                    @if($tour->meeting_point)
                    <div class="flex items-start gap-3 mb-6 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-[15px] mb-1">Meeting Point</h3>
                            <p class="text-[14px] text-gray-600">{{ $tour->meeting_point }}</p>
                        </div>
                    </div>
                    @endif

                    @if($tour->map_iframe)
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-200">
                        <iframe src="{{ $tour->map_iframe }}" width="100%" height="400" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </section>
                <hr class="border-gray-200 mb-12">
                @endif

                {{-- SECTION: CANCELLATION POLICY --}}
                @php
                  $cancelData = json_decode($tour->cancellation_policy, true);
                @endphp
                @if(!empty($cancelData) && count($cancelData) > 0)
                <section id="cancellation" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Cancellation Policy</h2>
                    <div class="bg-gray-100 rounded-2xl p-6">
                        <ul class="space-y-3 list-disc pl-5">
                            @foreach($cancelData as $cp)
                            <li class="text-[14.5px] text-gray-700 leading-relaxed">{{ $cp }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <hr class="border-gray-200 mb-12">
                @endif

                {{-- SECTION: FAQ --}}
                @php
                  $faqs = json_decode($tour->faqs, true);
                @endphp
                @if(!empty($faqs) && count($faqs) > 0)
                <section id="faq" class="scroll-mt-[150px] mb-12">
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Frequently Asked Questions</h2>
                    <div class="space-y-4">
                        @foreach($faqs as $i => $faq)
                        <div class="faq-item bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition hover:shadow-md">
                            <button class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left bg-transparent cursor-pointer outline-none" onclick="toggleFaq(this)">
                                <span class="text-[15px] font-bold text-gray-900 pr-4">{{ $faq['q'] }}</span>
                                <span class="faq-icon text-gray-400 text-[20px] shrink-0 transition-transform duration-300">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </button>
                            <div class="faq-answer text-[14.5px] text-gray-600 leading-relaxed px-6 pb-0" style="max-height: 0;">
                                <div class="pb-5">{{ $faq['a'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- RIGHT WIDGET COLUMN --}}
            <div class="lg:col-span-4">
                <div class="sticky top-[100px] bg-white rounded-[24px] border border-gray-200 shadow-xl p-6">
                    
                    {{-- Price Header --}}
                    <div class="mb-6">
                        <span class="text-[13px] text-gray-500 font-medium block mb-1">From</span>
                        <div class="flex items-end gap-2">
                            <span class="text-3xl font-extrabold text-gray-900">€{{ $tour->price }}</span>
                            <span class="text-[14px] text-gray-500 mb-1 font-medium">per person</span>
                        </div>
                        @if($tour->old_price && $tour->old_price > $tour->price)
                        <div class="mt-1 text-[12px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-md inline-block">
                            Save €{{ $tour->old_price - $tour->price }} today!
                        </div>
                        @endif
                    </div>

                    {{-- Form / Inputs --}}
                    <div class="space-y-4 mb-6">
                        {{-- Date Select --}}
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Select Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <input type="date" id="bkDate" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-[14px] text-gray-700 focus:outline-none focus:border-[#c69c27] focus:ring-1 focus:ring-[#c69c27]" min="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        {{-- Guests Select --}}
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Guests</label>
                            <div class="border border-gray-300 rounded-xl p-3 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-[14px] font-bold text-gray-900">Adults</div>
                                        <div class="text-[11px] text-gray-500">Age 12+</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button onclick="updateGuests('adult', -1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c69c27] hover:text-[#c69c27] transition focus:outline-none">-</button>
                                        <span id="qtyAdult" class="w-4 text-center text-[15px] font-bold text-gray-900">1</span>
                                        <button onclick="updateGuests('adult', 1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c69c27] hover:text-[#c69c27] transition focus:outline-none">+</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-[14px] font-bold text-gray-900">Children</div>
                                        <div class="text-[11px] text-gray-500">Under 12</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button onclick="updateGuests('child', -1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c69c27] hover:text-[#c69c27] transition focus:outline-none">-</button>
                                        <span id="qtyChild" class="w-4 text-center text-[15px] font-bold text-gray-900">0</span>
                                        <button onclick="updateGuests('child', 1)" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#c69c27] hover:text-[#c69c27] transition focus:outline-none">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Total Price --}}
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-[15px] font-bold text-gray-700">Total Price</span>
                            <span id="totalPrice" class="text-[18px] font-extrabold text-gray-900">€{{ $tour->price }}</span>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="space-y-3">
                        <a href="https://wa.me/1234567890?text={{ urlencode('Hello! I want to book: '.$tour->name) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#c69c27] text-white py-3.5 rounded-xl text-[15px] font-bold shadow-lg shadow-[#c69c27]/30 hover:bg-[#b08820] hover:-translate-y-0.5 transition-all">
                            Check Availability
                        </a>
                        <p class="text-center text-[12px] text-gray-500 mt-2">You won't be charged yet</p>
                    </div>

                    {{-- Trust features --}}
                    <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                        <div class="flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                            <span class="text-[13px] font-medium text-gray-700">Free Cancellation (24h before)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                            <span class="text-[13px] font-medium text-gray-700">Secure & simple booking</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
Fancybox.bind('[data-fancybox="gallery"]', {
    // optional fancybox config
});

// FAQ Accordion
function toggleFaq(btn) {
    const item = btn.parentElement;
    const answer = item.querySelector('.faq-answer');
    const icon = btn.querySelector('.faq-icon svg');
    
    // Close all others
    document.querySelectorAll('.faq-answer').forEach(el => {
        if (el !== answer) {
            el.style.maxHeight = null;
            el.parentElement.querySelector('.faq-icon svg').style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle current
    if (answer.style.maxHeight) {
        answer.style.maxHeight = null;
        icon.style.transform = 'rotate(0deg)';
    } else {
        answer.style.maxHeight = answer.scrollHeight + "px";
        icon.style.transform = 'rotate(180deg)';
    }
}

// Guest Counter & Price Calc
const basePrice = {{ $tour->price }};
const childPrice = Math.round(basePrice * 0.7);

function updateGuests(type, delta) {
    const el = document.getElementById(type === 'adult' ? 'qtyAdult' : 'qtyChild');
    let val = parseInt(el.textContent) + delta;
    
    if (val < 0) val = 0;
    if (type === 'adult' && val < 1) val = 1; // Minimum 1 adult
    
    el.textContent = val;
    
    // update total
    const adults = parseInt(document.getElementById('qtyAdult').textContent);
    const children = parseInt(document.getElementById('qtyChild').textContent);
    
    const total = (adults * basePrice) + (children * childPrice);
    document.getElementById('totalPrice').textContent = '€' + total;
}

// Active Tab highlight on scroll
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.tab-link');

    window.addEventListener('scroll', () => {
        let current = '';
        const scrollY = window.scrollY;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - 200; // offset for sticky header
            const sectionHeight = section.offsetHeight;
            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });

        if (current) {
            navLinks.forEach(link => {
                link.classList.remove('active', 'bg-[#c69c27]', 'text-white');
                link.classList.add('text-gray-700');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active', 'bg-[#c69c27]', 'text-white');
                    link.classList.remove('text-gray-700');
                }
            });
        }
    });

    // Handle click to set active immediately (prevents jitter)
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => {
                l.classList.remove('active', 'bg-[#c69c27]', 'text-white');
                l.classList.add('text-gray-700');
            });
            this.classList.add('active', 'bg-[#c69c27]', 'text-white');
            this.classList.remove('text-gray-700');
        });
    });
});
</script>
@endsection
