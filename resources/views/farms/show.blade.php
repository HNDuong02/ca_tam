@extends('layouts.master')

@section('title', $farm->name . ' - ' . setting('site.title', 'Đông Bắc'))

@section('content')
<div class="bg-gray-50 min-h-screen pb-12 lg:pb-20">
    <!-- Hero Header -->
    <div class="relative bg-[#0f2e1f] h-[300px] lg:h-[400px] w-full overflow-hidden">
        @php
            $images = is_string($farm->images) ? json_decode($farm->images, true) : $farm->images;
        @endphp
        @if(is_array($images) && count($images) > 0)
            <img src="{{ Voyager::image($images[0]) }}" alt="{{ $farm->name }}" class="w-full h-full object-cover opacity-40">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0f2e1f] via-transparent to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full">
            <div class="container mx-auto px-4 lg:px-8 max-w-5xl pb-10">
                <nav class="flex text-sm text-gray-300 mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:text-white transition">Trang chủ</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('farms.index') }}" class="hover:text-white transition">Hệ thống trang trại</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-brand-light font-medium">{{ $farm->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl lg:text-5xl font-bold text-white mb-2">{{ $farm->name }}</h1>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 lg:px-8 max-w-5xl -mt-6 relative z-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-10 mb-8">
            <div class="flex flex-col md:flex-row gap-8 mb-10 border-b border-gray-100 pb-8">
                <div class="flex-1 space-y-4">
                    <h2 class="text-xl font-bold text-gray-800">Thông tin chung</h2>
                    @if($farm->description)
                        <p class="text-gray-600">{{ $farm->description }}</p>
                    @endif
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        @if($farm->address)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-brand/10 text-brand flex items-center justify-center shrink-0 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 font-medium">Địa chỉ</div>
                                <div class="text-gray-800">{{ $farm->address }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($farm->area)
                        <div class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-brand/10 text-brand flex items-center justify-center shrink-0 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 font-medium">Diện tích</div>
                                <div class="text-gray-800 font-semibold">{{ $farm->area }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($farm->video)
                <!-- Video Section -->
                <div class="w-full md:w-1/3 shrink-0">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Video giới thiệu</h2>
                    @php
                        // media_picker in Voyager returns a JSON string containing an array of objects
                        $videos = json_decode($farm->video);
                        $videoUrl = null;
                        if(is_array($videos) && count($videos) > 0 && isset($videos[0]->download_link)) {
                            $videoUrl = Voyager::image($videos[0]->download_link);
                        } elseif(is_string($farm->video) && !empty($farm->video) && $farm->video != '[]') {
                            $videoUrl = Voyager::image($farm->video);
                        }
                    @endphp
                    @if($videoUrl)
                        <div class="rounded-xl overflow-hidden shadow-sm aspect-video bg-gray-900">
                            <video src="{{ $videoUrl }}" controls class="w-full h-full object-cover"></video>
                        </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Content -->
            @if($farm->content)
            <div class="prose prose-emerald max-w-none mb-12">
                {!! $farm->content !!}
            </div>
            @endif

            <!-- Image Gallery -->
            @if(is_array($images) && count($images) > 0)
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Thư viện hình ảnh
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($images as $image)
                    <a href="{{ Voyager::image($image) }}" data-fancybox="gallery" class="group block relative aspect-square md:aspect-video rounded-xl overflow-hidden shadow-sm bg-gray-100 cursor-zoom-in">
                        <img src="{{ Voyager::image($image) }}" alt="{{ $farm->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if(typeof Fancybox !== 'undefined') {
            Fancybox.bind("[data-fancybox]", {
                // custom options
            });
        }
    });
</script>
@endsection
