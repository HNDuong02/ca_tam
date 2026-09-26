@extends('layouts.master')

@section('title', 'Giỏ hàng của bạn')

@section('content')
<div class="bg-gray-50 py-12 min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-6xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Giỏ hàng của bạn</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="w-full lg:w-2/3 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6">
                    <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @foreach($cart as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <li class="flex py-6">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img src="{{ Voyager::image($details['image']) }}" alt="{{ $details['name'] }}" class="h-full w-full object-cover object-center">
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>
                                                    <a href="#">{{ $details['name'] }}</a>
                                                </h3>
                                                <p class="ml-4">{{ number_format($details['price']) }} VNĐ</p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">Khối lượng: {{ $details['weight'] }}</p>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <div class="flex items-center gap-2">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-gray-300 rounded">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $id }}">
                                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 border-none text-center p-1" onchange="this.form.submit()">
                                                </form>
                                            </div>

                                            <div class="flex">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $id }}">
                                                    <button type="submit" class="font-medium text-red-600 hover:text-red-500">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">Tóm tắt đơn hàng</h2>
                    
                    <div class="flow-root">
                        <dl class="-my-4 text-sm divide-y divide-gray-200">
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Tạm tính</dt>
                                <dd class="font-medium text-gray-900">{{ number_format($total) }} VNĐ</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Phí vận chuyển</dt>
                                <dd class="font-medium text-green-600">Liên hệ sau</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-base font-bold text-gray-900">Tổng cộng</dt>
                                <dd class="text-xl font-bold text-green-700">{{ number_format($total) }} VNĐ</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-8">
                        <a href="#" class="w-full bg-[#1e5b43] border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-[#164230] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex justify-center">
                            Tiến hành thanh toán
                        </a>
                    </div>
                    
                    <div class="mt-4 flex justify-center text-sm text-gray-500">
                        <p>
                            hoặc <a href="{{ route('products.index') }}" class="text-green-600 font-medium hover:text-green-500">Tiếp tục mua sắm<span aria-hidden="true"> &rarr;</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Giỏ hàng trống</h3>
            <p class="text-gray-500 mb-6">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-700 hover:bg-green-800">
                Khám phá sản phẩm
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
