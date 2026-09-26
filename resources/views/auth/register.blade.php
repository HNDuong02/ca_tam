@extends('layouts.master')
@section('title', 'Đăng ký tài khoản')
@section('content')
<div class="bg-gray-50 py-16 min-h-[60vh] flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Đăng ký tài khoản</h2>
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Họ và tên</label>
                <input type="text" name="fullname" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-green-600" value="{{ old('fullname') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại</label>
                <input type="text" name="phone" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-green-600" value="{{ old('phone') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Mật khẩu</label>
                <input type="password" name="password" required minlength="6" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-green-600">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ</label>
                <input type="text" name="address" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-green-600" value="{{ old('address') }}">
            </div>
            <button type="submit" class="w-full bg-[#1e5b43] text-white font-bold py-3 rounded-md hover:bg-[#164230] transition">
                Đăng ký
            </button>
        </form>
        
        <p class="mt-6 text-center text-sm text-gray-600">
            Đã có tài khoản? <a href="{{ route('login') }}" class="text-green-700 hover:underline font-medium">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
