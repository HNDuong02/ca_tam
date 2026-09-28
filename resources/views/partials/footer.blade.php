@php
    $mapSetting = setting('site.map_url');
    $mapLink = $mapSetting 
        ? (str_starts_with($mapSetting, 'http') ? $mapSetting : 'https://maps.google.com/?q=' . urlencode($mapSetting))
        : 'https://maps.google.com/?q=' . urlencode(setting('site.company_address', '123 Đường Điện Biên Phủ, Quận 1, TP.HCM'));
@endphp
    <!-- Sticky Contact Banner -->
    <div id="sticky-banner" class="fixed bottom-0 z-50 w-full transition-all duration-500 pointer-events-none">
        <div class="bg-brand border-t border-emerald-800 text-white relative overflow-hidden shadow-[0_-5px_25px_rgba(0,0,0,0.15)] pointer-events-auto transition-transform duration-500" id="sticky-banner-content">
            <div class="px-5 lg:px-12 max-w-[1400px] mx-auto py-4 lg:py-6">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between lg:gap-12">
                    
                    <!-- Mobile view (old contact banner style) -->
                    <div class="md:hidden flex flex-col">
                        <h3 class="text-xl font-bold mb-4 leading-tight">Bạn cần báo giá hoặc<br>tư vấn kỹ thuật?</h3>
                        <a href="tel:{{ setting('site.hotline', '0988888888') }}" class="bg-[#2e8b57] text-white font-medium py-3 px-5 rounded-lg inline-flex items-center justify-between w-fit transition shadow-md z-10">
                            Gửi yêu cầu ngay
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                    
                    <!-- Desktop view (footer style) -->
                    <div class="hidden md:flex items-center lg:w-1/3">
                        @if(setting('site.logo_white'))
                            <img src="{{ Voyager::image(setting('site.logo_white')) }}" alt="Logo" class="h-12 lg:h-14 z-10 relative">
                        @else
                            <!-- Placeholder text logo if no image -->
                            <div class="flex items-center z-10 relative">
                                <svg class="w-8 h-8 lg:w-10 lg:h-10 text-white mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 16V10M11 16V6M15 16V13M19 16V8"></path></svg>
                                <div>
                                    <div class="font-bold text-lg lg:text-xl uppercase tracking-wider">Đông Bắc</div>
                                    <div class="text-[9px] lg:text-[10px] text-gray-300">Nông nghiệp & Cá tầm</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-3 lg:space-x-4 z-10 relative">
                        <a href="{{ setting('site.zalo', '#') }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-4 py-2.5 rounded-full flex items-center text-sm font-medium transition">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 5.52 4.48 10 10 10s10-4.48 10-10C22 6.48 17.52 2 12 2zM11 19.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.22.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path></svg>
                            Chat Zalo
                        </a>
                        <a href="tel:{{ setting('site.hotline') }}" class="border border-emerald-600 hover:bg-white/10 px-4 py-2.5 rounded-full flex items-center text-sm font-medium transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            Gọi tư vấn
                        </a>
                        <a href="{{ $mapLink }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-4 py-2.5 rounded-full flex items-center text-sm font-medium transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Xem bản đồ
                        </a>
                        <a href="{{ setting('site.facebook', 'https://facebook.com') }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-4 py-2.5 rounded-full flex items-center text-sm font-medium transition">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            Facebook
                        </a>
                    </div>
                    
                    <div class="hidden lg:flex flex-col text-right justify-center relative z-10">
                        <div class="text-[17px] font-[cursive] text-emerald-200 drop-shadow-sm">Vì nguồn nước trong lành<br>Vì tương lai bền vững</div>
                    </div>
                </div>
            </div>
            
            <!-- Leaf graphic -->
            <svg class="absolute bottom-1 right-2 md:bottom-auto md:top-1/2 md:-translate-y-1/2 md:right-[15%] w-24 h-24 lg:w-32 lg:h-32 text-[#16402b] z-0 transform rotate-12 opacity-50" viewBox="0 0 24 24" fill="currentColor"><path d="M17.09 3.961c-4.996 0-9.288 3.535-10.36 8.35L5.27 15.65c-.32.32-.42.79-.24 1.21.18.42.61.69 1.07.69h2v2c0 .46.27.89.69 1.07.42.18.89.08 1.21-.24l3.34-3.34c4.815-1.072 8.35-5.364 8.35-10.36V3.961h-4.6z"></path></svg>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-brand text-white pb-6 relative z-0" id="main-footer">
        <div class="container mx-auto px-4 lg:px-8 pt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-10">
                <!-- Cột 1: Thông tin công ty -->
                <div class="flex flex-col space-y-4">
                    <div class="flex items-start space-x-4 mb-2">
                        @if(setting('site.logo'))
                            <img src="{{ Voyager::image(setting('site.logo')) }}" alt="Logo" class="h-16 w-auto object-contain brightness-0 invert mt-1">
                        @else
                            <svg class="w-16 h-16 text-white mt-1" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>
                            </svg>
                        @endif
                        <div class="flex flex-col space-y-1">
                            <span class="font-bold text-lg lg:text-xl leading-tight tracking-tight uppercase block">{{ setting('site.company_name', 'Công ty CP Nông nghiệp Đông Bắc') }}</span>
                            <span class="text-xs text-emerald-300 font-medium tracking-widest uppercase">Nông Nghiệp & Cá Tầm</span>
                        </div>
                    </div>
                    
                    <div class="text-sm text-gray-300 space-y-3">
                        <p class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ setting('site.company_address', '123 Đường Điện Biên Phủ, Quận 1, TP.HCM') }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <a href="tel:{{ setting('site.hotline', '0988888888') }}" class="hover:text-white transition font-medium">{{ setting('site.hotline', '0988888888') }}</a>
                        </p>
                        @if(setting('site.director'))
                        <p class="flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Giám đốc: {{ setting('site.director') }}</span>
                        </p>
                        @endif
                        @if(setting('site.tax_code'))
                        <p class="flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span>Mã số thuế: {{ setting('site.tax_code') }}</span>
                        </p>
                        @endif
                        @if(setting('site.main_business'))
                        <p class="flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>Ngành nghề: {{ setting('site.main_business') }}</span>
                        </p>
                        @endif
                    </div>
                </div>

                <!-- Cột 2: Các nút liên hệ (Khung đỏ) -->
                <div class="flex flex-col space-y-3 justify-center pl-0 lg:pl-8">
                    <a href="{{ setting('site.zalo', '#') }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-5 py-3 rounded-full flex items-center text-sm font-medium transition max-w-xs">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 5.52 4.48 10 10 10s10-4.48 10-10C22 6.48 17.52 2 12 2zM11 19.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.22.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path></svg>
                        Chat Zalo
                    </a>
                    <a href="tel:{{ setting('site.hotline') }}" class="border border-emerald-600 hover:bg-white/10 px-5 py-3 rounded-full flex items-center text-sm font-medium transition max-w-xs">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Gọi tư vấn
                    </a>
                    <a href="{{ $mapLink }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-5 py-3 rounded-full flex items-center text-sm font-medium transition max-w-xs">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Xem bản đồ
                    </a>
                    <a href="{{ setting('site.facebook', 'https://facebook.com') }}" target="_blank" class="border border-emerald-600 hover:bg-white/10 px-5 py-3 rounded-full flex items-center text-sm font-medium transition max-w-xs">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        Facebook
                    </a>
                </div>

                <!-- Cột 3: Chính sách (Khung xanh lá) -->
                <div class="flex flex-col text-sm text-gray-300 space-y-3 justify-center lg:pl-4">
                    <h4 class="text-white font-bold uppercase tracking-wider mb-2">Chính sách</h4>
                    <a href="{{ route('pages.policy', 'terms') }}" class="hover:text-white transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách & Điều khoản
                    </a>
                    <a href="{{ route('pages.policy', 'privacy') }}" class="hover:text-white transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách bảo mật
                    </a>
                    <a href="{{ route('pages.policy', 'shipping') }}" class="hover:text-white transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách giao hàng
                    </a>
                    <a href="{{ route('contact.index') }}" class="hover:text-white transition flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Liên hệ
                    </a>
                </div>

                <!-- Cột 4: Slogan (Khung xanh dương) -->
                <div class="flex flex-col justify-center items-start lg:items-end lg:text-right">
                    <div class="text-[20px] lg:text-[24px] font-[cursive] text-emerald-200 drop-shadow-sm leading-relaxed">
                        Vì nguồn nước trong lành<br>Vì tương lai bền vững
                    </div>
                </div>
            </div>
            
            <div class="pt-6 border-t border-white/10 text-center text-sm text-emerald-500/70">
                &copy; {{ date('Y') }} Đông Bắc Nông Nghiệp & Cá Tầm. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stickyBannerContent = document.getElementById('sticky-banner-content');
            const stickyBannerWrapper = document.getElementById('sticky-banner');
            const footer = document.getElementById('main-footer');
            
            if (stickyBannerContent && footer) {
                const observer = new IntersectionObserver(function(entries) {
                    if (entries[0].isIntersecting) {
                        // Hide sticky banner when footer is visible
                        stickyBannerContent.classList.add('translate-y-full');
                        setTimeout(() => {
                            if (stickyBannerContent.classList.contains('translate-y-full')) {
                                stickyBannerWrapper.classList.add('invisible');
                            }
                        }, 500);
                    } else {
                        // Show sticky banner when scrolled up
                        stickyBannerWrapper.classList.remove('invisible');
                        // Small delay to ensure transition works
                        setTimeout(() => {
                            stickyBannerContent.classList.remove('translate-y-full');
                        }, 10);
                    }
                }, { threshold: 0.1 });
                
                observer.observe(footer);
            }
        });
    </script>
