@extends('layouts.master')

@section('title', 'Đông Bắc Nông Nghiệp & Cá Tầm - Trang Chủ')

@section('content')

    <!-- Hero Section -->
    <section class="relative w-full h-[550px] lg:h-[700px] bg-brand-dark overflow-hidden">
        <!-- Background Image Slider -->
        <div class="absolute inset-0 w-full h-full" id="home-slider">
            @php
                $banners = [];
                for ($i = 1; $i <= 3; $i++) {
                    $keySuffix = $i === 1 ? '' : '_' . $i;
                    $mobileKey = 'banner.home_banner_mobile' . $keySuffix;
                    $desktopKey = 'banner.home_banner' . $keySuffix;
                    
                    $mobileImg = setting($mobileKey);
                    $desktopImg = setting($desktopKey);
                    
                    if ($mobileImg || $desktopImg) {
                        $banners[] = [
                            'desktop' => $desktopImg ? Voyager::image($desktopImg) : Voyager::image($mobileImg),
                            'mobile' => $mobileImg ? Voyager::image($mobileImg) : Voyager::image($desktopImg)
                        ];
                    }
                }

                if (empty($banners)) {
                    $banners[] = [
                        'desktop' => '/images/hero_bg_1790239265469.jpg', // Fallback
                        'mobile' => '/images/hero_bg_1790239265469.jpg'
                    ];
                }
            @endphp

            @foreach($banners as $index => $banner)
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ $banner['mobile'] }}">
                    <img src="{{ $banner['desktop'] }}" alt="Banner Trang Chủ {{ $index + 1 }}" draggable="false"
                        class="absolute inset-0 w-full h-full object-cover object-[70%_center] lg:object-center transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                </picture>
            @endforeach
            
            <!-- Dark Overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/30 to-[#032014]/90 lg:bg-gradient-to-r lg:from-[#032014]/90 lg:via-[#032014]/50 lg:to-transparent z-10 pointer-events-none"></div>
        </div>

        <!-- Desktop Farm Image Overlay -->
        <div class="hidden lg:block absolute right-12 top-1/2 -translate-y-1/2 w-[450px] h-[350px] z-20 rounded-tl-[60px] rounded-bl-[20px] rounded-tr-[20px] rounded-br-[60px] overflow-hidden border-[6px] border-white/10 shadow-2xl">
            <img src="{{ setting('banner.farm_image_overlay') ? Voyager::image(setting('banner.farm_image_overlay')) : 'https://images.unsplash.com/photo-1583091178652-32a265672e61?auto=format&fit=crop&q=80&w=800' }}" alt="Trang trại" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a2618]/90 via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white text-3xl font-[cursive] leading-snug drop-shadow-lg">
                Từ núi rừng<br>đến những bữa ăn lành mạnh
            </div>
            <!-- Leaf graphic -->
            <svg class="absolute bottom-4 right-4 w-12 h-12 text-[#8cceb0]/50 transform -rotate-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22C12 22 20 18 20 12V5L12 2L4 5V12C4 18 12 22 12 22Z"></path><path d="M12 22V12"></path></svg>
        </div>

        <!-- Hero Content -->
        <div class="absolute inset-0 z-20 flex flex-col justify-end lg:justify-center px-5 lg:px-16 pb-16 lg:pb-0">
            <div class="lg:w-3/5 xl:w-1/2">
                <div class="flex items-center text-white text-xs lg:text-sm font-medium tracking-wide uppercase mb-3 lg:mb-5">
                    TỪ NGUỒN NƯỚC SẠCH ĐÔNG BẮC 
                    <span class="hidden lg:inline-block w-16 h-[2px] bg-[#2e8b57] ml-4"></span>
                    <span class="inline-block lg:hidden w-10 h-[1px] bg-white/60 ml-3"></span>
                </div>
                
                <h1 class="text-[32px] lg:text-5xl xl:text-6xl font-bold text-white leading-tight mb-3 lg:mb-6">
                    Cá tầm sạch từ<br>trang trại đến bàn ăn
                </h1>
                
                <p class="text-[15px] lg:text-lg text-gray-200 mb-6 lg:mb-8 lg:max-w-md">
                    Cá tầm giống, cá sống thương phẩm và cá sơ chế được kiểm soát theo từng lô, minh bạch nguồn gốc.
                </p>
                
                <div class="flex flex-col lg:flex-row lg:items-center gap-4 lg:gap-6 mb-5 lg:mb-12">
                    <a href="tel:{{ setting('site.hotline', '0988888888') }}" class="bg-[#2e8b57] hover:bg-[#257348] text-white rounded-lg lg:rounded-full py-3 px-6 lg:px-8 inline-flex items-center justify-between lg:justify-center w-[250px] lg:w-auto font-medium transition shadow-lg">
                        Nhận báo giá hôm nay
                        <svg class="w-5 h-5 ml-2 lg:ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    
                    <a href="{{ route('pages.company_intro') }}" class="inline-flex items-center lg:border lg:border-white/40 lg:hover:bg-white/10 lg:rounded-full lg:px-6 lg:py-3 text-white text-[15px] font-medium w-fit transition">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="1.5"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 8l6 4-6 4V8z"></path>
                        </svg>
                        Khám phá trang trại
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Feature Bar -->
        <div class="absolute bottom-0 left-0 w-full lg:w-auto lg:bottom-12 lg:left-16 bg-[#0a2618]/60 lg:bg-transparent backdrop-blur-md lg:backdrop-blur-none z-20 border-t border-white/20 lg:border-none py-3 px-4 lg:p-0 flex justify-between lg:justify-start lg:gap-8 items-center text-white text-[11px] lg:text-sm font-medium">
            <div class="flex items-center">
                <svg class="w-4 h-4 lg:w-5 lg:h-5 mr-1.5 lg:mr-2 text-white" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg>
                Nguồn nước lạnh <span class="hidden lg:inline">&nbsp;tự nhiên</span>
            </div>
            <div class="w-px h-4 bg-white/30 lg:h-6 lg:bg-white/40"></div>
            <div class="flex items-center">
                <svg class="w-4 h-4 lg:w-5 lg:h-5 mr-1.5 lg:mr-2 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
                <span class="lg:hidden">Theo dõi từng lô</span>
                <span class="hidden lg:inline">Kiểm soát theo từng lô</span>
            </div>
            <div class="w-px h-4 bg-white/30 lg:h-6 lg:bg-white/40"></div>
            <div class="flex items-center">
                <svg class="w-4 h-4 lg:w-5 lg:h-5 mr-1.5 lg:mr-2 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                Giao cá <span class="hidden lg:inline">&nbsp;sống&nbsp;</span> an toàn
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-10 lg:py-16 bg-[#f8f9fa]">
        <div class="px-5 lg:px-12 max-w-[1400px] mx-auto">
            
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-10 mb-12">
                <!-- Products Section -->
                <div class="lg:w-7/12 xl:w-2/3">
                    <div class="flex items-center mb-6 lg:mb-8">
                        <h2 class="text-xl lg:text-3xl font-bold text-[#0f2e1f]">Sản phẩm chủ lực</h2>
                        <div class="h-[2px] w-12 lg:w-16 bg-[#8c9c94] lg:bg-[#2e8b57] ml-4"></div>
                    </div>

                    <div class="flex flex-col md:grid md:grid-cols-3 gap-4 lg:gap-6">
                        @php
                            $displayCategories = [
                                [
                                    'title' => 'Cá tầm giống',
                                    'action' => 'Xem chi tiết',
                                    'img' => '/images/product-1.jpg',
                                    'route' => route('products.index', ['category' => 'ca-tam-giong'])
                                ],
                                [
                                    'title' => 'Cá tầm sống nguyên con',
                                    'action' => 'Nhận báo giá',
                                    'img' => '/images/product-2.jpg',
                                    'route' => route('products.index', ['category' => 'ca-tam-song'])
                                ],
                                [
                                    'title' => 'Cá tầm sơ chế & cắt khúc',
                                    'action' => 'Đặt hàng',
                                    'img' => '/images/product-3.jpg',
                                    'route' => route('products.index', ['category' => 'ca-tam-so-che'])
                                ]
                            ];
                        @endphp

                        @foreach($displayCategories as $index => $cat)
                            @php 
                                $realCat = isset($categories) && count($categories) > $index ? $categories[$index] : null;
                                $imgSrc = $realCat && $realCat->image ? Voyager::image($realCat->image) : $cat['img'];
                            @endphp
                            <a href="{{ $cat['route'] }}" class="bg-white rounded-2xl lg:rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)] hover:shadow-lg lg:border-none border border-gray-100 flex flex-row md:flex-col overflow-hidden group transition-all duration-300">
                                <div class="w-[35%] md:w-full min-h-[90px] md:h-[180px] lg:h-[220px]">
                                    <img src="{{ $imgSrc }}" alt="{{ $cat['title'] }}" class="w-full h-full object-cover">
                                </div>
                                <div class="w-[65%] md:w-full p-3.5 pl-4 md:p-5 flex items-center md:items-start justify-between md:flex-col">
                                    <div class="flex flex-col justify-center md:mb-4">
                                        <h3 class="font-bold text-[#1a2b22] text-[15px] lg:text-[17px] mb-2 md:mb-1 leading-tight">{{ $cat['title'] }}</h3>
                                        <div class="text-[13px] lg:text-[14px] text-[#3d5a49] flex items-center md:hidden">
                                            <div class="w-5 h-5 rounded-full border border-[#83978c] flex items-center justify-center mr-2">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                            {{ $cat['action'] }}
                                        </div>
                                    </div>
                                    <!-- Action section on desktop -->
                                    <div class="hidden md:flex items-center text-[14px] text-gray-700 font-medium group-hover:text-[#2e8b57] transition-colors">
                                        <div class="w-6 h-6 rounded-full border border-gray-300 group-hover:border-[#2e8b57] flex items-center justify-center mr-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                        {{ $cat['action'] }}
                                    </div>
                                    <!-- Action circle on mobile -->
                                    <div class="w-8 h-8 rounded-full bg-[#f4f7f5] flex items-center justify-center flex-shrink-0 text-[#2e8b57] md:hidden">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Traceability Section -->
                <div class="lg:w-5/12 xl:w-1/3 flex flex-col justify-end">
                    <div class="bg-[#163f2d] rounded-[20px] p-5 lg:p-8 relative overflow-hidden text-white flex flex-col h-full lg:min-h-[300px] justify-center shadow-lg">
                        <!-- Background pattern/image -->
                        <div class="absolute inset-0 opacity-50 mix-blend-overlay">
                            <img src="{{ setting('site.traceability_bg') ? Voyager::image(setting('site.traceability_bg')) : 'https://images.unsplash.com/photo-1583091178652-32a265672e61?auto=format&fit=crop&q=80&w=600' }}" alt="bg" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#113223]/95 via-[#163f2d]/80 to-[#163f2d]/60"></div>
                        
                        <div class="relative z-10 flex flex-row lg:flex-col xl:flex-row gap-4 lg:gap-6 items-center lg:items-start xl:items-center">
                            <div class="w-[90px] h-[90px] lg:w-[120px] lg:h-[120px] bg-white p-2 lg:p-3 rounded-xl shrink-0 shadow-md">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://catam.viontech.vn/" alt="QR Code" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-grow">
                                <h2 class="text-[17px] lg:text-[22px] font-bold mb-1.5 lg:mb-3 leading-tight">Truy xuất nguồn gốc<br class="hidden lg:block"> trong vài giây</h2>
                                <p class="text-[12px] lg:text-[14px] text-gray-200 leading-snug mb-3 lg:mb-5 opacity-90 max-w-xs">
                                    Quét mã QR để kiểm tra lô nuôi, ngày xuất trại và thông tin sản phẩm.
                                </p>
                                <a href="https://catam.viontech.vn/" target="_blank" class="bg-[#0f2e1f] hover:bg-[#1a4b33] text-white text-[13px] lg:text-[14px] font-medium px-4 lg:px-6 py-2 lg:py-3 rounded-lg lg:rounded-full inline-flex items-center transition shadow-sm border border-white/10">
                                    Kiểm tra mã sản phẩm
                                    <svg class="w-4 h-4 ml-1.5 lg:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                        <!-- Signature/Watermark -->
                        <div class="absolute bottom-4 right-4 z-0 opacity-40 transform -rotate-[5deg] text-right hidden lg:block">
                            <span class="font-[cursive] text-3xl">Minh bạch<br>Tạo niềm tin</span>
                        </div>
                        <div class="absolute -bottom-2 -right-4 z-0 opacity-30 transform rotate-[-5deg] lg:hidden">
                            <span class="font-[cursive] text-4xl">Minh bạch Tạo niềm tin</span>
                        </div>
                        <svg class="absolute bottom-4 right-10 w-12 h-12 text-[#8cceb0]/20 z-0 hidden lg:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M12 22C12 22 20 18 20 12V5L12 2L4 5V12C4 18 12 22 12 22Z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Farm Capabilities Section -->
            <div class="mb-12">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 lg:mb-8 gap-4">
                    <div class="flex items-center">
                        <h2 class="text-xl lg:text-2xl font-bold text-[#0f2e1f]">Năng lực từ trang trại</h2>
                        <div class="h-[2px] w-12 lg:w-16 bg-[#8c9c94] lg:bg-[#2e8b57] ml-4 hidden sm:block"></div>
                    </div>
                    <a href="{{ route('farms.index') }}" class="inline-flex items-center justify-center bg-[#f0f6f3] text-brand px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand hover:text-white transition-colors group w-fit">
                        Hệ thống trang trại 
                        <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <!-- Mobile Grid -->
                <div class="grid grid-cols-2 gap-3 md:hidden">
                    <div class="bg-[#fcfdfd] border border-gray-100 rounded-xl p-4 flex items-center shadow-sm">
                        <div class="w-9 h-9 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-3 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-[#1a2b22] leading-tight">Nguồn nước</span>
                    </div>
                    <div class="bg-[#fcfdfd] border border-gray-100 rounded-xl p-4 flex items-center shadow-sm">
                        <div class="w-9 h-9 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-3 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-[#1a2b22] leading-tight">Quy trình nuôi</span>
                    </div>
                    <div class="bg-[#fcfdfd] border border-gray-100 rounded-xl p-4 flex items-center shadow-sm">
                        <div class="w-9 h-9 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-3 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-[#1a2b22] leading-tight">Kiểm soát chất lượng</span>
                    </div>
                    <div class="bg-[#fcfdfd] border border-gray-100 rounded-xl p-4 flex items-center shadow-sm">
                        <div class="w-9 h-9 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-3 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                        <span class="text-[13px] font-medium text-[#1a2b22] leading-tight">Vận chuyển</span>
                    </div>
                </div>

                <!-- Desktop Flex Row -->
                <div class="hidden md:flex bg-white rounded-2xl shadow-sm border border-gray-100 divide-x divide-gray-100 py-6 px-4">
                    <div class="flex-1 flex items-center justify-center px-4">
                        <div class="w-10 h-10 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg>
                        </div>
                        <span class="text-[15px] font-bold text-[#1a2b22]">Nguồn nước lạnh tự nhiên</span>
                    </div>
                    <div class="flex-1 flex items-center justify-center px-4">
                        <div class="w-10 h-10 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-[15px] font-bold text-[#1a2b22]">Quy trình nuôi</span>
                    </div>
                    <div class="flex-1 flex items-center justify-center px-4">
                        <div class="w-10 h-10 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-[15px] font-bold text-[#1a2b22]">Kiểm soát chất lượng</span>
                    </div>
                    <div class="flex-1 flex items-center justify-center px-4">
                        <div class="w-10 h-10 rounded-full bg-[#f0f6f3] text-[#1c4b37] flex items-center justify-center mr-4 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                        <span class="text-[15px] font-bold text-[#1a2b22]">Vận chuyển</span>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('#home-slider img');
            if (slides.length > 1) {
                let currentSlide = 0;

                const showSlide = (index) => {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');
                    currentSlide = index;
                    if (currentSlide >= slides.length) currentSlide = 0;
                    if (currentSlide < 0) currentSlide = slides.length - 1;
                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                };

                setInterval(() => showSlide(currentSlide + 1), 5000);
            }
        });
    </script>
@endpush