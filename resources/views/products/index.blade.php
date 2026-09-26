@extends('layouts.master')

@section('title', 'Sản phẩm của chúng tôi - Đông Bắc Nông Nghiệp & Cá Tầm')

@section('content')
<div class="bg-brand-bg py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Banner -->
        <div class="relative w-full h-[300px] md:h-[400px] rounded-xl overflow-hidden mb-8 shadow-lg">
            @if(setting('product.banner_image'))
                <img src="{{ Voyager::image(setting('product.banner_image')) }}" alt="Sản phẩm cá tầm" class="w-full h-full object-cover">
            @else
                <img src="https://images.unsplash.com/photo-1524185962737-ea7c028a12cd?auto=format&fit=crop&q=80&w=2000" alt="Sản phẩm cá tầm" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-black/50 flex flex-col justify-center px-8 md:px-16">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-md">SẢN PHẨM CÁ TẦM</h1>
                <p class="text-lg md:text-2xl text-white drop-shadow-md font-medium">Chất lượng từ trang trại - An toàn cho người tiêu dùng</p>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-12">
            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-medium transition {{ !request()->has('category') ? 'bg-[#1e5b43] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">Tất cả</a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="px-6 py-2.5 rounded-lg text-sm font-medium transition {{ request('category') == $cat->slug ? 'bg-[#1e5b43] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">{{ $cat->name }}</a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('products.index') }}" method="GET" class="w-full lg:w-auto relative flex-shrink-0">
                @if(request()->has('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..." class="w-full lg:w-72 pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:ring-1 focus:ring-[#1e5b43] focus:border-[#1e5b43] transition">
                <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#1e5b43]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col border border-gray-100">
                <a href="{{ route('products.show', $product->slug) }}" class="relative h-64 overflow-hidden bg-gray-100 block">
                    @if($product->image)
                        <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">Chưa có ảnh</div>
                    @endif
                    <div class="absolute top-4 right-4 bg-brand-accent text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">
                        {{ $product->category->name ?? 'Nông sản' }}
                    </div>
                </a>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-brand-dark mb-2 line-clamp-2"><a href="{{ route('products.show', $product->slug) }}" class="hover:text-brand-accent transition-colors">{{ $product->name }}</a></h2>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-3">{{ $product->short_description }}</p>
                    </div>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-bold text-brand-light">{{ $product->price_text ?: 'Liên hệ' }}</span>
                        <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center justify-center px-4 py-2 bg-brand text-white text-sm font-medium rounded-lg hover:bg-brand-dark transition-colors shadow-sm hover:shadow">
                            Chi tiết
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Hiện tại chưa có sản phẩm nào. Vui lòng quay lại sau.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
