    <!-- Footer -->
    <footer class="bg-brand text-white pt-10 pb-6 border-t border-emerald-800">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Logo Footer & Info -->
                    <div class="flex items-start space-x-4">
                        @if(setting('site.logo'))
                            <img src="{{ Voyager::image(setting('site.logo')) }}" alt="Logo" class="h-16 w-auto object-contain brightness-0 invert mt-1">
                        @else
                            <svg class="w-16 h-16 text-white mt-1" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>
                            </svg>
                        @endif
                        <div class="flex flex-col space-y-3 max-w-sm">
                            <div>
                                <span class="font-bold text-xl leading-tight tracking-tight uppercase block">{{ setting('site.company_name', 'Công ty CP Nông nghiệp Đông Bắc') }}</span>
                                <span class="text-xs text-emerald-300 font-medium tracking-widest uppercase">Nông Nghiệp & Cá Tầm</span>
                            </div>
                            
                            <div class="text-sm text-gray-300 space-y-2 mt-2">
                                <p class="flex items-start gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>{{ setting('site.company_address', '123 Đường Điện Biên Phủ, Quận 1, TP.HCM') }}</span>
                                </p>
                                <p class="flex items-center gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    <a href="tel:{{ setting('site.hotline', '0988888888') }}" class="hover:text-white transition font-medium">{{ setting('site.hotline', '0988888888') }}</a>
                                </p>
                                @if(setting('site.director'))
                                <p class="flex items-center gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>Giám đốc: {{ setting('site.director') }}</span>
                                </p>
                                @endif
                                @if(setting('site.tax_code'))
                                <p class="flex items-center gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Mã số thuế: {{ setting('site.tax_code') }}</span>
                                </p>
                                @endif
                                @if(setting('site.main_business'))
                                <p class="flex items-center gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span>Ngành nghề: {{ setting('site.main_business') }}</span>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Policies -->
                <div class="flex flex-col text-center md:text-left text-sm text-gray-300 space-y-3">
                    <h4 class="text-white font-bold uppercase tracking-wider mb-1">Chính sách</h4>
                    <a href="{{ route('pages.policy', 'terms') }}" class="hover:text-white transition flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách & Điều khoản
                    </a>
                    <a href="{{ route('pages.policy', 'privacy') }}" class="hover:text-white transition flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách bảo mật
                    </a>
                    <a href="{{ route('pages.policy', 'shipping') }}" class="hover:text-white transition flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Chính sách giao hàng
                    </a>
                    <a href="{{ route('contact.index') }}" class="hover:text-white transition flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Liên hệ
                    </a>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ setting('site.zalo', 'https://zalo.me/0988888888') }}" target="_blank" class="border border-white/30 hover:bg-white/10 rounded-full px-6 py-2.5 text-sm font-medium transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12c0 2.22.73 4.28 1.95 5.92L3 21l3.19-.92C7.75 21.36 9.8 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.89 0-3.66-.54-5.16-1.46l-.37-.22-2.12.61.63-2.03-.24-.39A7.953 7.953 0 014 12c0-4.41 3.59-8 8-8s8 3.59 8-8-3.59 8-8 8zm4.18-5.32c-.23-.11-1.35-.67-1.56-.74-.21-.08-.36-.11-.51.11-.15.23-.59.74-.72.9-.13.15-.27.17-.5.06-1.43-.68-2.61-1.78-3.32-3.13-.08-.16-.01-.24.1-.35.11-.1.23-.27.35-.41.11-.15.15-.25.22-.42.08-.17.04-.32-.02-.43-.06-.11-.51-1.23-.7-1.68-.19-.44-.38-.38-.51-.39H7.6c-.15 0-.4.06-.61.28-.21.23-.81.79-.81 1.93 0 1.14.83 2.24.95 2.39.11.15 1.63 2.49 3.94 3.49 1.5.65 2.1.72 2.85.6.83-.13 1.35-.55 1.54-1.08.19-.53.19-.98.13-1.08-.05-.1-.19-.16-.42-.27z"/></svg>
                        Chat Zalo
                    </a>
                    <a href="{{ setting('site.facebook', 'https://facebook.com') }}" target="_blank" class="border border-white/30 hover:bg-white/10 rounded-full px-6 py-2.5 text-sm font-medium transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        Facebook
                    </a>
                </div>

                <!-- Footer Text -->
                <div class="text-right hidden lg:block">
                    <p class="font-serif italic text-xl text-emerald-300 drop-shadow-sm" style="font-family: 'Times New Roman', Times, serif;">
                        Vì nguồn nước trong lành<br>
                        Vì tương lai bền vững
                    </p>
                </div>
            </div>
            
            <div class="pt-6 border-t border-white/10 text-center text-sm text-emerald-500/70">
                &copy; 2026 Đông Bắc Nông Nghiệp & Cá Tầm. All rights reserved.
            </div>
        </div>
    </footer>
