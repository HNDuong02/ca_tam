@extends('layouts.master')

@section('title', 'Hệ Thống Trang Trại - ' . setting('site.title', 'Đông Bắc'))

@section('content')
<div class="bg-gray-50 py-12 lg:py-20 min-h-screen">
    <div class="container mx-auto px-4 lg:px-8 max-w-7xl">
        <div class="text-center mb-12 lg:mb-16">
            <h1 class="text-3xl lg:text-4xl font-bold text-[#0f2e1f] mb-4">Hệ Thống Trang Trại</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Khám phá các trang trại nuôi cá tầm đạt chuẩn của chúng tôi, nơi khởi nguồn cho những sản phẩm chất lượng nhất.</p>
            <div class="h-1 w-20 bg-brand mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($farms as $farm)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col">
                    <div class="relative aspect-video overflow-hidden bg-gray-100">
                        @php
                            $images = is_string($farm->images) ? json_decode($farm->images, true) : $farm->images;
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            <img src="{{ Voyager::image($images[0]) }}" alt="{{ $farm->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-brand shadow-sm">
                            Đang hoạt động
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-brand transition-colors"><a href="{{ route('farms.show', $farm->slug) }}">{{ $farm->name }}</a></h3>
                        
                        <div class="flex items-start text-sm text-gray-500 mb-4 mt-2">
                            <svg class="w-4 h-4 mr-2 mt-0.5 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="line-clamp-2">{{ $farm->address ?: 'Đang cập nhật địa chỉ' }}</span>
                        </div>
                        
                        @if($farm->area)
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-2 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            <span>Diện tích: <strong class="text-gray-700">{{ $farm->area }}</strong></span>
                        </div>
                        @endif

                        <p class="text-gray-600 text-sm line-clamp-3 mb-6">{{ $farm->description }}</p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('farms.show', $farm->slug) }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-brand/10 text-brand font-medium rounded-lg group-hover:bg-brand group-hover:text-white transition-colors">
                                Xem chi tiết
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Chưa có dữ liệu</h3>
                    <p class="text-gray-500">Hệ thống trang trại đang được cập nhật.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
