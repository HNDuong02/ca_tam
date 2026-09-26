@extends('layouts.master')

@section('title', 'Đông Bắc Nông Nghiệp & Cá Tầm - Trang Chủ')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-brand min-h-[400px] max-[425px]:min-h-[350px] sm:h-[500px] lg:h-[600px] overflow-hidden">
        <!-- Background Image Slider -->
        <div class="absolute inset-0 w-full h-full bg-brand-dark" id="home-slider">
            @php
                $banners = [];
                for ($i = 1; $i <= 3; $i++) {
                    $keySuffix = $i === 1 ? '' : '_' . $i;
                    $desktopKey = 'banner.home_banner' . $keySuffix;
                    $mobileKey = 'banner.home_banner_mobile' . $keySuffix;
                    
                    $desktopImg = setting($desktopKey);
                    $mobileImg = setting($mobileKey);
                    
                    if ($desktopImg) {
                        $banners[] = [
                            'desktop' => Voyager::image($desktopImg),
                            'mobile' => $mobileImg ? Voyager::image($mobileImg) : Voyager::image($desktopImg)
                        ];
                    }
                }

                if (empty($banners)) {
                    $banners[] = [
                        'desktop' => '/images/hero_bg_1790239265469.jpg',
                        'mobile' => '/images/hero_bg_1790239265469.jpg'
                    ];
                }
            @endphp

            @foreach($banners as $index => $banner)
                <picture>
                    <source media="(max-width: 767px)" srcset="{{ $banner['mobile'] }}">
                    <img src="{{ $banner['desktop'] }}" alt="Banner Trang Chủ {{ $index + 1 }}" draggable="false"
                        class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}">
                </picture>
            @endforeach

            <!-- Overlay mỏng giúp dễ đọc chữ -->
            <div class="absolute inset-0 bg-black/30 z-10 pointer-events-none"></div>

            @if(count($banners) > 1)
                <!-- Slider Controls -->
                <button id="slider-prev"
                    class="absolute left-2 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-full bg-black/20 hover:bg-black/40 text-white backdrop-blur-md transition cursor-pointer">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="slider-next"
                    class="absolute right-2 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-full bg-black/20 hover:bg-black/40 text-white backdrop-blur-md transition cursor-pointer">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            @endif
            <div class="relative container mx-auto px-4 lg:px-8 h-full flex flex-col justify-center">
                <div class="flex flex-col items-center justify-center h-full py-8 lg:py-12 text-center">
                    <!-- <div
                            class="w-full max-w-4xl mx-auto text-white z-20 py-8 lg:py-10 px-4 lg:px-12 flex flex-col items-center bg-black/20 backdrop-blur-sm rounded-3xl border border-white/10 shadow-2xl">
                            <h1
                                class="text-3xl max-[425px]:text-2xl lg:text-6xl font-bold leading-snug lg:leading-relaxed mb-4 lg:mb-6 drop-shadow-md uppercase">
                                Cá tầm Đông Bắc
                            </h1>
                            <h3 class="text-2xl max-[425px]:text-xl lg:text-4xl font-bold leading-snug lg:leading-relaxed mb-4 lg:mb-6 drop-shadow-md">
                                Nguồn cá tầm chất lượng từ trang trại đến khách hàng
                            </h3>
                            <p class="text-gray-200 text-sm max-[425px]:text-xs lg:text-lg mb-6 lg:mb-8 max-w-lg leading-relaxed drop-shadow-md">
                                Cá tầm giống, cá sống thương phẩm và cá sơ chế được kiểm soát theo từng lô, minh bạch nguồn gốc.
                            </p>
                            <div class="flex flex-wrap justify-center items-center gap-4 mb-12">
                                <a href="tel:{{ setting('site.hotline', '0988888888') }}"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-md font-medium transition flex items-center shadow-lg">
                                    Nhận báo giá hôm nay
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('products.index') }}"
                                    class="border border-white/40 hover:bg-white/10 text-white px-6 py-3 rounded-md font-medium transition flex items-center backdrop-blur-sm">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Khám phá sản phẩm
                                </a>
                            </div>

                            <div
                                class="flex flex-wrap justify-center items-center gap-6 text-sm text-gray-300 pt-6 border-t border-white/20 w-full max-w-3xl">
                                <div class="flex items-center drop-shadow-md">
                                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                                        </path>
                                    </svg>
                                    Nguồn nước lạnh tự nhiên
                                </div>
                                <div class="hidden lg:block w-px h-4 bg-white/40"></div>
                                <div class="flex items-center drop-shadow-md">
                                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Kiểm soát theo từng lô
                                </div>
                                <div class="hidden lg:block w-px h-4 bg-white/40"></div>
                                <div class="flex items-center drop-shadow-md">
                                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                    Giao cá sống an toàn
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="py-16 bg-brand-bg">
        <div class="container mx-auto px-4 lg:px-8">

            <!-- Products Section -->
            <div class="mb-20">
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Sản phẩm cá tầm</h2>
                    <div class="h-0.5 w-16 bg-emerald-600 ml-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($categories as $category)
                        <!-- Category Item -->
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 group">
                            <div class="relative h-64 overflow-hidden bg-gray-50">
                                @if($category->image)
                                    <img src="{{ Voyager::image($category->image) }}" alt="{{ $category->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $category->name }}</h3>
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                    class="inline-flex items-center text-emerald-700 font-medium hover:text-emerald-800 transition">
                                    <span
                                        class="w-6 h-6 rounded-full border border-emerald-700 flex items-center justify-center mr-2 group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center py-8">Đang cập nhật danh mục sản phẩm...</p>
                    @endforelse
                </div>
            </div>
            <!-- Farm Section -->
            <div
                class="mb-20 bg-[#f8fcf9] rounded-2xl overflow-hidden flex flex-col md:flex-row shadow-sm border border-gray-100">
                <div class="w-full md:w-[55%] relative">
                    @if(setting('farm.image'))
                        <img src="{{ Voyager::image(setting('farm.image')) }}" alt="Trang trại Đông Bắc"
                            class="w-full h-full object-cover min-h-[350px]">
                    @else
                        <img src="https://images.unsplash.com/photo-1583091178652-32a265672e61?auto=format&fit=crop&q=80&w=1200"
                            alt="Trang trại Đông Bắc" class="w-full h-full object-cover min-h-[350px]">
                    @endif
                </div>
                <div class="w-full md:w-[45%] p-10 lg:p-14 flex flex-col justify-center">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                        {!! setting('farm.title', 'Từ trang trại Đông Bắc<br>đến bàn ăn của bạn') !!}
                    </h2>

                    <div class="w-12 h-1 bg-gray-300 mb-8"></div>

                    <ul class="space-y-4 mb-10 text-gray-800 font-medium text-sm lg:text-base">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-800 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>{{ setting('farm.bullet_1', 'Chủ động nguồn cá') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-800 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>{{ setting('farm.bullet_2', 'Quy trình nuôi khép kín kiểm soát khắt khe') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-800 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>{{ setting('farm.bullet_3', 'Cung cấp cá giống, cá thương phẩm') }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-800 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>{{ setting('farm.bullet_4', 'Giao nhận chuyên nghiệp cho đối tác') }}</span>
                        </li>
                    </ul>

                    <div>
                        <a href="{{ route('pages.company_intro') }}"
                            class="inline-flex bg-[#1e5b43] text-white font-semibold px-8 py-3.5 rounded-full hover:bg-[#164230] transition-colors shadow-md">
                            Tìm hiểu về trang trại
                        </a>
                    </div>
                </div>
            </div>

            <!-- Traceability Section -->
            <div
                class="mb-20 bg-[#f8fcf9] rounded-2xl p-8 lg:p-10 flex flex-col md:flex-row items-center gap-8 shadow-sm border border-gray-100">
                <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 shrink-0">
                    <!-- Tạo mã QR dẫn đến https://catam.viontech.vn/ -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://catam.viontech.vn/"
                        alt="QR Code Kiểm tra nguồn gốc" class="w-32 h-32 lg:w-40 lg:h-40">
                </div>
                <div class="flex-grow w-full">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Kiểm tra nguồn gốc cá tầm</h2>
                    <p class="text-gray-600 mb-6 font-medium">Minh bạch thông tin - An tâm sử dụng</p>

                    <form action="https://catam.viontech.vn/" method="GET" target="_blank"
                        class="flex flex-col sm:flex-row gap-4 w-full max-w-2xl">
                        <input type="text" name="code" placeholder="Mã truy xuất (VD: DB-2026-00001)"
                            class="flex-grow px-5 py-3.5 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#1e5b43] focus:border-transparent text-gray-700 bg-white">
                        <button type="submit"
                            class="bg-[#1e5b43] text-white font-semibold px-10 py-3.5 rounded-full hover:bg-[#164230] transition-colors shadow-md whitespace-nowrap">
                            Tra cứu
                        </button>
                    </form>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="mb-20">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <h2 class="text-2xl font-bold text-gray-900">Tin tức - kiến thức</h2>
                        <div class="h-0.5 w-16 bg-emerald-600 ml-4"></div>
                    </div>
                    <a href="{{ route('posts.index') }}"
                        class="text-sm font-medium text-emerald-700 hover:text-emerald-800 transition flex items-center">
                        Xem tất cả
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $post)
                        <div
                            class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 group flex flex-col">
                            <a href="{{ route('posts.show', $post->slug) }}" class="relative h-56 overflow-hidden block">
                                @if($post->image)
                                    <img src="{{ Voyager::image($post->image) }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-xs text-gray-500 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $post->created_at->format('d/m/Y') }}
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-emerald-700 transition">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3 text-center py-8">Chưa có bài viết nào.</p>
                    @endforelse
                </div>
            </div>

            <!-- Farm Capabilities -->
            <div>
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Năng lực từ trang trại</h2>
                    <div class="h-0.5 w-16 bg-emerald-600 ml-4"></div>
                </div>

                <div
                    class="bg-white rounded-xl p-8 shadow-sm border border-gray-100 flex flex-wrap justify-between items-center gap-6 divide-x divide-gray-100">

                    <div class="flex-1 flex flex-col items-center text-center px-4">
                        <div
                            class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4 text-emerald-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                                </path>
                            </svg>
                        </div>
                        <p class="font-medium text-gray-800">Nguồn nước lạnh tự nhiên</p>
                    </div>

                    <div class="flex-1 flex flex-col items-center text-center px-4">
                        <div
                            class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4 text-emerald-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="font-medium text-gray-800">Quy trình nuôi</p>
                    </div>

                    <div class="flex-1 flex flex-col items-center text-center px-4">
                        <div
                            class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4 text-emerald-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <p class="font-medium text-gray-800">Kiểm soát chất lượng</p>
                    </div>

                    <div class="flex-1 flex flex-col items-center text-center px-4">
                        <div
                            class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-4 text-emerald-700">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <p class="font-medium text-gray-800">Vận chuyển</p>
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
                let slideInterval;

                const showSlide = (index) => {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');

                    currentSlide = index;
                    if (currentSlide >= slides.length) currentSlide = 0;
                    if (currentSlide < 0) currentSlide = slides.length - 1;

                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                };

                const nextSlide = () => showSlide(currentSlide + 1);
                const prevSlide = () => showSlide(currentSlide - 1);

                const startSlide = () => {
                    slideInterval = setInterval(nextSlide, 5000);
                };

                const resetSlide = () => {
                    clearInterval(slideInterval);
                    startSlide();
                };

                // Buttons
                const nextBtn = document.getElementById('slider-next');
                const prevBtn = document.getElementById('slider-prev');

                if (nextBtn && prevBtn) {
                    nextBtn.addEventListener('click', () => {
                        nextSlide();
                        resetSlide();
                    });
                    prevBtn.addEventListener('click', () => {
                        prevSlide();
                        resetSlide();
                    });
                }

                // Swipe / Drag Gestures
                let startX = 0;
                let endX = 0;
                const heroSection = document.querySelector('section');

                heroSection.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                }, { passive: true });

                heroSection.addEventListener('touchmove', (e) => {
                    endX = e.touches[0].clientX;
                }, { passive: true });

                heroSection.addEventListener('touchend', () => {
                    if (startX - endX > 50) {
                        nextSlide();
                        resetSlide();
                    } else if (endX - startX > 50) {
                        prevSlide();
                        resetSlide();
                    }
                });

                let isDragging = false;
                heroSection.addEventListener('mousedown', (e) => {
                    isDragging = true;
                    startX = e.clientX;
                    heroSection.style.cursor = 'grabbing';
                });

                heroSection.addEventListener('mousemove', (e) => {
                    if (isDragging) {
                        endX = e.clientX;
                    }
                });

                heroSection.addEventListener('mouseup', () => {
                    if (isDragging) {
                        if (startX - endX > 50) {
                            nextSlide();
                            resetSlide();
                        } else if (endX - startX > 50) {
                            prevSlide();
                            resetSlide();
                        }
                        isDragging = false;
                        heroSection.style.cursor = 'auto';
                    }
                });

                heroSection.addEventListener('mouseleave', () => {
                    isDragging = false;
                    heroSection.style.cursor = 'auto';
                });

                startSlide();
            }
        });
    </script>
@endpush