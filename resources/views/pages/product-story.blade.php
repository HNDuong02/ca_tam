@extends('layouts.master')

@section('title', 'Câu Chuyện Sản Phẩm - Đông Bắc')

@section('content')
<div class="bg-brand-bg py-16 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            @if(setting('pages.product_story_image'))
            <div class="w-full h-[400px] overflow-hidden">
                <img src="{{ Voyager::image(setting('pages.product_story_image')) }}" alt="Câu Chuyện Sản Phẩm" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="p-8 md:p-16">
                <div class="text-center mb-12">
                    <span class="text-brand-accent font-bold tracking-widest uppercase text-sm mb-2 block">Về Sản Phẩm Của Chúng Tôi</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-brand-dark">Câu Chuyện Sản Phẩm</h1>
                    <div class="w-24 h-1 bg-brand-light mx-auto mt-6 rounded-full"></div>
                </div>
                
                <div class="prose prose-lg prose-brand max-w-none text-gray-700 leading-relaxed">
                    {!! setting('pages.product_story') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
