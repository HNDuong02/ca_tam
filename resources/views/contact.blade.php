@extends('layouts.master')

@section('title', 'Liên hệ - Đông Bắc Nông Nghiệp & Cá Tầm')
@section('meta_description', 'Liên hệ với chúng tôi để được tư vấn và giải đáp mọi thắc mắc.')

@section('content')
<div class="bg-brand-bg py-10 min-h-screen">
    <div class="container mx-auto px-4 lg:px-8 max-w-4xl">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-6 font-medium">
            <a href="/" class="hover:text-emerald-700 transition">Trang chủ</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 truncate">Liên hệ</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">Liên hệ với chúng tôi</h1>
                <p class="text-gray-600 mb-8">Vui lòng điền thông tin vào form dưới đây, chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.</p>

                @if(session('success'))
                    <div class="bg-emerald-50 text-emerald-700 p-4 rounded-xl mb-6 font-medium border border-emerald-100">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên *</label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand focus:ring-2 focus:ring-brand-light outline-none transition" placeholder="Nhập họ tên của bạn" value="{{ old('name') }}">
                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand focus:ring-2 focus:ring-brand-light outline-none transition" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                            @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand focus:ring-2 focus:ring-brand-light outline-none transition" placeholder="Nhập email của bạn" value="{{ old('email') }}">
                            @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Nội dung *</label>
                        <textarea name="content" id="content" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand focus:ring-2 focus:ring-brand-light outline-none transition resize-none" placeholder="Nhập nội dung cần liên hệ...">{{ old('content') }}</textarea>
                        @error('content') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="bg-brand text-white font-medium px-8 py-3.5 rounded-xl hover:bg-brand-dark transition shadow-md w-full md:w-auto">
                            Gửi liên hệ
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
