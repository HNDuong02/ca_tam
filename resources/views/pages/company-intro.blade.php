@extends('layouts.master')

@section('title', 'Giới Thiệu Doanh Nghiệp - Đông Bắc')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
            @if(setting('pages.company_intro_image'))
            <div class="w-full h-[400px] overflow-hidden relative">
                <div class="absolute inset-0 bg-brand-dark/20 z-10"></div>
                <img src="{{ Voyager::image(setting('pages.company_intro_image')) }}" alt="Giới Thiệu Doanh Nghiệp" class="w-full h-full object-cover relative z-0">
                <div class="absolute inset-0 z-20 flex items-center justify-center">
                    <h1 class="text-5xl md:text-6xl font-extrabold text-white text-center drop-shadow-lg">Về Chúng Tôi</h1>
                </div>
            </div>
            @else
            <div class="bg-brand py-16 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white">Giới Thiệu Doanh Nghiệp</h1>
            </div>
            @endif
            
            <div class="p-8 md:p-16">
                <div class="prose prose-lg prose-brand max-w-none text-gray-700 leading-relaxed">
                    {!! setting('pages.company_intro') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
