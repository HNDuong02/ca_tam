@extends('layouts.master')

@section('title', 'Bài viết - Đông Bắc Nông Nghiệp & Cá Tầm')

@section('content')
<div class="bg-brand-bg py-12 lg:py-20 min-h-screen">
    <div class="container mx-auto px-4 lg:px-8">
        
        <div class="flex items-center justify-center mb-12">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 text-center">Tin tức & Bài viết</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 group flex flex-col">
                <a href="{{ route('posts.show', $post->slug) }}" class="relative h-56 overflow-hidden block">
                    @if($post->image)
                    <img src="{{ Voyager::image($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    @endif
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs text-gray-500 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
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
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center text-emerald-700 font-medium hover:text-emerald-800 transition text-sm mt-auto">
                        Đọc tiếp
                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Chưa có bài viết nào.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
