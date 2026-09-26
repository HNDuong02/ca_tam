@extends('layouts.master')

@section('title', $post->title . ' - Đông Bắc Nông Nghiệp & Cá Tầm')
@section('meta_description', $post->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 100))

@section('content')
<div class="bg-brand-bg py-10 min-h-screen">
    <div class="container mx-auto px-4 lg:px-8 max-w-7xl">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-6 font-medium">
            <a href="/" class="hover:text-emerald-700 transition">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('posts.index') }}" class="hover:text-emerald-700 transition">Tin tức</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 truncate">{{ $post->title }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content: Post Detail -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @if($post->image)
                    <div class="w-full h-[300px] md:h-[450px] relative">
                        <img src="{{ Voyager::image($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                    @endif

                    <div class="p-8 md:p-12">
                        <div class="flex items-center text-sm text-gray-500 mb-6">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $post->created_at->format('d/m/Y') }}</span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 leading-tight">{{ $post->title }}</h1>

                        <div class="prose prose-emerald max-w-none prose-img:rounded-xl prose-img:shadow-sm">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($related_posts->count() > 0)
                <div class="mt-16">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-emerald-600 pl-4">Bài viết liên quan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($related_posts as $related)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 group flex flex-col">
                            <a href="{{ route('posts.show', $related->slug) }}" class="relative h-48 overflow-hidden block">
                                @if($related->image)
                                <img src="{{ Voyager::image($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                <div class="w-full h-full bg-gray-100"></div>
                                @endif
                            </a>
                            <div class="p-5 flex flex-col flex-grow">
                                <h4 class="text-base font-bold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('posts.show', $related->slug) }}" class="hover:text-emerald-700 transition">
                                        {{ $related->title }}
                                    </a>
                                </h4>
                                <div class="text-xs text-gray-500 mt-auto">
                                    {{ $related->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-28">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-l-4 border-brand pl-3">Bài viết nổi bật</h3>
                    
                    @if($featured_posts->count() > 0)
                        <div class="space-y-6">
                            @foreach($featured_posts as $fpost)
                            <div class="flex gap-4 group">
                                <a href="{{ route('posts.show', $fpost->slug) }}" class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden relative">
                                    @if($fpost->image)
                                    <img src="{{ Voyager::image($fpost->image) }}" alt="{{ $fpost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                    <div class="w-full h-full bg-gray-100"></div>
                                    @endif
                                </a>
                                <div class="flex flex-col">
                                    <a href="{{ route('posts.show', $fpost->slug) }}" class="text-sm font-bold text-gray-900 group-hover:text-brand transition line-clamp-2 mb-2 leading-snug">
                                        {{ $fpost->title }}
                                    </a>
                                    <div class="text-xs text-gray-500 mt-auto flex items-center">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $fpost->created_at->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Chưa có bài viết ghim nổi bật.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
