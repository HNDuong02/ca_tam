@extends('layouts.master')

@section('title', $title . ' - Đông Bắc Nông Nghiệp & Cá Tầm')

@section('content')
<div class="bg-brand-bg py-12 lg:py-20 min-h-screen">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-brand text-white px-8 py-10 text-center">
                <h1 class="text-3xl lg:text-4xl font-bold mb-4">{{ $title }}</h1>
                <p class="text-emerald-100">Đông Bắc Nông Nghiệp & Cá Tầm</p>
            </div>
            
            <!-- Content -->
            <div class="p-8 lg:p-12 prose prose-emerald max-w-none prose-img:rounded-xl">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>
@endsection
