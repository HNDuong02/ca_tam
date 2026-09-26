<!-- Header -->
<header class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Mobile Menu Button (Left) -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 -ml-2 text-gray-600 hover:text-brand transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>

            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2 group shrink-0">
                @if(setting('site.logo'))
                    <img src="{{ Voyager::image(setting('site.logo')) }}" alt="Logo" class="h-8 md:h-10 w-auto group-hover:opacity-80 transition object-contain">
                @else
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-brand group-hover:text-brand-light transition" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z" />
                    </svg>
                @endif
                <div class="flex-col group-hover:opacity-80 transition hidden min-[1440px]:flex">
                    <span class="font-bold text-base md:text-lg text-brand leading-tight tracking-tight uppercase line-clamp-1" title="{{ setting('site.company_name', 'Đông Bắc') }}">{{ setting('site.title', setting('site.company_name', 'Đông Bắc')) }}</span>
                    <span class="text-[9px] md:text-[10px] text-gray-500 font-medium tracking-widest uppercase">Nông Nghiệp & Cá Tầm</span>
                </div>
            </a>

            <!-- Navigation (Desktop) -->
            <nav class="hidden lg:flex items-center space-x-6 text-sm font-medium text-gray-600">
                <a href="/"
                    class="{{ request()->is('/') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Trang chủ</a>
                <a href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.*') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Sản phẩm</a>
                <a href="{{ route('pages.product_story') }}" class="{{ request()->routeIs('pages.product_story') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Câu chuyện sản phẩm</a>
                <a href="{{ route('pages.company_intro') }}" class="{{ request()->routeIs('pages.company_intro') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Giới thiệu</a>
                <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Tin tức</a>
                <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'text-brand border-b-2 border-brand' : 'hover:text-brand transition' }} pb-1">Liên hệ</a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center space-x-2 md:space-x-4 shrink-0">
                @php
                    $cartCount = 0;
                    $cart = session()->get('cart', []);
                    foreach($cart as $item) {
                        $cartCount += $item['quantity'];
                    }
                @endphp
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-brand transition p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex items-center justify-center bg-red-500 text-white text-[10px] font-bold h-4 w-4 rounded-full border-2 border-white">{{ $cartCount }}</span>
                    @endif
                </a>
                
                <!-- User Account / Login Button -->
                @if(Auth::guard('taikhoan')->check())
                    <div class="relative group">
                        <button class="bg-brand text-white px-3 md:px-5 py-2 md:py-2.5 rounded-md text-xs md:text-sm font-medium hover:bg-brand-dark transition shadow-md focus:outline-none flex items-center">
                            <svg class="w-4 h-4 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <span class="hidden md:inline">{{ Auth::guard('taikhoan')->user()->fullname }}</span>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 hidden group-hover:block">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-brand text-white px-3 md:px-5 py-2 md:py-2.5 rounded-md text-xs md:text-sm font-medium hover:bg-brand-dark transition shadow-md flex items-center">
                        <svg class="w-4 h-4 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="hidden md:inline">Đăng nhập</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden lg:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 shadow-md">
        <nav class="flex flex-col px-4 py-2 text-sm font-medium text-gray-600">
            <a href="/" class="block py-3 {{ request()->is('/') ? 'text-brand font-bold' : 'hover:text-brand' }} border-b border-gray-50">Trang chủ</a>
            <a href="{{ route('products.index') }}" class="block py-3 {{ request()->routeIs('products.*') ? 'text-brand font-bold' : 'hover:text-brand' }} border-b border-gray-50">Sản phẩm</a>
            <a href="{{ route('pages.product_story') }}" class="block py-3 {{ request()->routeIs('pages.product_story') ? 'text-brand font-bold' : 'hover:text-brand' }} border-b border-gray-50">Câu chuyện sản phẩm</a>
            <a href="{{ route('pages.company_intro') }}" class="block py-3 {{ request()->routeIs('pages.company_intro') ? 'text-brand font-bold' : 'hover:text-brand' }} border-b border-gray-50">Giới thiệu</a>
            <a href="{{ route('posts.index') }}" class="block py-3 {{ request()->routeIs('posts.*') ? 'text-brand font-bold' : 'hover:text-brand' }} border-b border-gray-50">Tin tức</a>
            <a href="{{ route('contact.index') }}" class="block py-3 {{ request()->routeIs('contact.*') ? 'text-brand font-bold' : 'hover:text-brand' }}">Liên hệ</a>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>