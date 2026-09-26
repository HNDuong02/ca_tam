@extends('layouts.master')

@section('title', $product->meta_title ?: $product->name)
@section('meta_description', $product->meta_description)
@section('meta_keywords', $product->meta_keywords)

@section('content')
<div class="bg-white py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-green-700 transition-colors">Trang chủ</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('products.index') }}" class="hover:text-green-700 transition-colors">Sản phẩm</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-800 font-medium">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Product Images -->
            <div class="flex flex-col gap-3">
                <!-- Main Image Slider -->
                <div class="relative h-[400px] w-full rounded-xl overflow-hidden bg-gray-100 group">
                    @if($product->image)
                        <img id="main-image" src="{{ Voyager::image($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-opacity duration-300">
                    @else
                        <img id="main-image" src="https://via.placeholder.com/600" alt="Placeholder" class="w-full h-full object-cover transition-opacity duration-300">
                    @endif
                    
                    @php
                        $gallery = is_string($product->gallery) ? json_decode($product->gallery, true) : $product->gallery;
                        $allImages = [];
                        if ($product->image) {
                            $allImages[] = Voyager::image($product->image);
                        } else {
                            $allImages[] = 'https://via.placeholder.com/600';
                        }
                        if ($gallery && is_array($gallery)) {
                            foreach ($gallery as $img) {
                                $allImages[] = Voyager::image($img);
                            }
                        }
                        $allImagesJson = json_encode($allImages);
                    @endphp
                    
                    @if(count($allImages) > 1)
                    <!-- Prev Button -->
                    <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <!-- Next Button -->
                    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition-opacity focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    @endif
                </div>
                
                <!-- Thumbnails -->
                <div class="grid grid-cols-5 gap-3 mt-2">
                    <div class="rounded-xl overflow-hidden aspect-square border-2 border-green-700 cursor-pointer" onclick="changeImage('{{ Voyager::image($product->image) }}', this)">
                        <img src="{{ Voyager::image($product->image) ?: 'https://via.placeholder.com/150' }}" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                    @if($gallery && is_array($gallery))
                        @foreach(array_slice($gallery, 0, 4) as $image)
                        <div class="rounded-xl overflow-hidden aspect-square border-2 border-transparent opacity-70 hover:opacity-100 cursor-pointer thumbnail-btn" onclick="changeImage('{{ Voyager::image($image) }}', this)">
                            <img src="{{ Voyager::image($image) }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="text-gray-500 text-sm mt-1">SKU: {{ $product->sku ?? 'DB-2026-00001' }}</p>
                
                <div class="mt-4">
                    @if(isset($product->price) && $product->price)
                        <div class="text-3xl font-bold text-green-700">{{ number_format($product->price) }} VNĐ <span class="text-xl font-normal text-gray-600">/ kg</span></div>
                    @else
                        <div class="text-3xl font-bold text-green-700">{{ $product->price_text ?: 'Yêu cầu báo giá' }}</div>
                    @endif
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="weight" id="selected-weight" value="1kg - 2kg">

                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Khối lượng</h3>
                        <div class="flex gap-3">
                            <button type="button" onclick="selectWeight(this, '1kg - 2kg')" class="weight-btn px-4 py-2 bg-green-700 text-white rounded-md text-sm font-medium">1kg - 2kg</button>
                            <button type="button" onclick="selectWeight(this, '2kg - 3kg')" class="weight-btn px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:border-green-600">2kg - 3kg</button>
                            <button type="button" onclick="selectWeight(this, 'Custom weight')" class="weight-btn px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:border-green-600">Custom weight</button>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Số lượng</h3>
                        <div class="flex items-center w-32 h-10 border border-gray-300 rounded-md">
                            <button type="button" onclick="updateQty(-1)" class="w-10 h-full flex items-center justify-center text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-l-md">-</button>
                            <input type="number" name="quantity" id="quantity-input" value="1" min="1" class="w-12 h-full text-center border-none focus:ring-0 text-sm font-medium" />
                            <button type="button" onclick="updateQty(1)" class="w-10 h-full flex items-center justify-center text-gray-600 bg-gray-50 hover:bg-gray-200 rounded-r-md">+</button>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex flex-col gap-3">
                        <button type="submit" class="w-full bg-[#1e5b43] text-white text-center font-semibold py-3.5 rounded-full hover:bg-[#164230] transition-colors">
                            Thêm vào giỏ hàng
                        </button>
                        <button type="submit" formaction="{{ route('cart.add') }}?checkout=1" class="w-full bg-white text-[#1e5b43] border-2 border-[#1e5b43] text-center font-semibold py-3.5 rounded-full hover:bg-gray-50 transition-colors">
                            Đặt hàng ngay
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Thông tin số</h3>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Mã sản phẩm:</span> <span>{{ $product->sku ?? 'DB-2026-00001' }}</span></li>
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Loại sản phẩm:</span> <span>{{ $product->category->name ?? 'Cá tầm thương phẩm rồng' }}</span></li>
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Trọng lượng:</span> <span>1 kg – 1kkg 2kg</span></li>
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Ngày xuất:</span> <span>20/09/2026</span></li>
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Trọng tải:</span> <span>Đông Bắc</span></li>
                        <li class="flex items-start"><span class="w-6 text-green-600">❖</span> <span class="w-32 font-medium">Hệ thống mộc:</span> <span>Bể cong suối, tuần hoàn nước</span></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Detailed Content Tabs -->
        <div class="mt-16">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-12" aria-label="Tabs">
                    <button class="tab-btn active border-green-700 text-green-800 whitespace-nowrap py-4 px-1 border-b-4 font-bold text-lg transition-colors focus:outline-none" onclick="switchTab('tab-details', this)">
                        Chi tiết sản phẩm
                    </button>
                    <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-4 font-medium text-lg transition-colors focus:outline-none" onclick="switchTab('tab-nutrition', this)">
                        Thành phần dinh dưỡng
                    </button>
                    <button class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-4 font-medium text-lg transition-colors focus:outline-none" onclick="switchTab('tab-reviews', this)">
                        Đánh giá khách hàng
                    </button>
                </nav>
            </div>
            
            <div class="mt-8 pb-12">
                <!-- Chi tiết sản phẩm -->
                <div id="tab-details" class="tab-content block">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Chi tiết sản phẩm</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! $product->body_html ?: '<p>Cá tầm thương phẩm là công chính phần nhỏ giảm tất đan sáng hưu; tắn sức-ống dinh thướng cưỡng, cũng thuộc cả chúng rắn làm của cá tầm. Cùng tiết khách hàng mát sâm linh đin.</p>' !!}
                    </div>
                </div>

                <!-- Thành phần dinh dưỡng -->
                <div id="tab-nutrition" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                           <h2 class="text-2xl font-bold text-gray-900 mb-4">Thành phần dinh dưỡng</h2>
                           @if($product->nutritionalFacts && $product->nutritionalFacts->count() > 0)
                           <div class="overflow-x-auto">
                                <table class="min-w-full bg-[#f0f9f3] rounded-lg overflow-hidden text-sm">
                                    <thead class="bg-[#dcf0e3] text-gray-800">
                                        <tr>
                                            <th class="py-3 px-6 text-left font-bold">Dưỡng chất</th>
                                            <th class="py-3 px-6 text-left font-bold">Hàm lượng</th>
                                            <th class="py-3 px-6 text-left font-bold">% Giá trị hàng ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#dcf0e3]">
                                        @foreach($product->nutritionalFacts as $fact)
                                        <tr>
                                            <td class="py-3 px-6">{{ $fact->nutrient }}</td>
                                            <td class="py-3 px-6">{{ $fact->amount }}</td>
                                            <td class="py-3 px-6">{{ $fact->daily_value ?: '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <p class="text-gray-500">Thông tin thành phần dinh dưỡng đang được cập nhật.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Đánh giá khách hàng -->
                <div id="tab-reviews" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Đánh giá</h2>
                        <a href="#" class="text-green-700 font-medium text-sm flex items-center">Viết đánh giá <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a>
                    </div>
                    
                    @if($product->productReviews && $product->productReviews->count() > 0)
                        @php
                            $avgRating = round($product->productReviews->avg('rating'), 1);
                            
                            // Collect all images from all reviews
                            $allReviewImages = [];
                            foreach($product->productReviews as $review) {
                                if ($review->images) {
                                    $images = is_string($review->images) ? json_decode($review->images, true) : $review->images;
                                    if (is_array($images)) {
                                        foreach($images as $img) {
                                            $allReviewImages[] = Voyager::image($img);
                                        }
                                    } elseif (is_string($review->images)) {
                                        $allReviewImages[] = Voyager::image($review->images);
                                    }
                                }
                            }
                        @endphp
                        <div class="flex items-center gap-2 mb-6">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($avgRating))
                                        ★
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-xl font-bold">{{ $avgRating }}</span>
                            <span class="text-gray-500 text-sm ml-2">({{ $product->productReviews->count() }} đánh giá)</span>
                        </div>
                        
                        @if(count($allReviewImages) > 0)
                        <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
                            @foreach($allReviewImages as $imgSrc)
                                <img src="{{ $imgSrc }}" class="w-32 h-32 object-cover rounded-lg flex-shrink-0 border border-gray-200">
                            @endforeach
                        </div>
                        @endif

                        <div class="space-y-6">
                            @foreach($product->productReviews as $review)
                            <div class="bg-gray-50 rounded-xl p-6 w-full max-w-2xl">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold">
                                            {{ mb_substr($review->customer_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $review->customer_name }}</h4>
                                            <div class="text-yellow-400 text-xs">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating) ★ @else <span class="text-gray-300">★</span> @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-400">{{ $review->created_at->format('d/m/Y') }}</span>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-10 text-center">
                            <p class="text-gray-500 mb-4">Chưa có đánh giá nào cho sản phẩm này.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-8 pt-12 border-t border-gray-100 mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Sản phẩm liên quan</h2>
                <a href="{{ route('products.index') }}" class="text-green-700 hover:text-green-800 font-medium flex items-center gap-1 group">
                    Xem thêm
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group border border-gray-100 flex flex-col">
                    <div class="relative h-48 overflow-hidden bg-gray-100 p-2">
                        @if($related->image)
                            <img src="{{ Voyager::image($related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition-transform duration-500">
                        @else
                            <img src="https://via.placeholder.com/300" class="w-full h-full object-cover rounded-lg">
                        @endif
                    </div>
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="text-xs text-gray-400 mb-1">29/09/2024</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2"><a href="{{ route('products.show', $related->slug) }}" class="hover:text-green-700 transition-colors">{{ $related->name }}</a></h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const images = {!! $allImagesJson ?? '[]' !!};
    let currentIndex = 0;

    function updateMainImage(index) {
        if (images.length === 0) return;
        document.getElementById('main-image').src = images[index];
        
        // Update thumbnail borders
        const btns = document.querySelectorAll('.thumbnail-btn, .aspect-square.border-green-700');
        btns.forEach((b, i) => {
            if (i === index) {
                b.classList.remove('border-transparent', 'opacity-70');
                b.classList.add('border-green-700', 'opacity-100');
            } else {
                b.classList.remove('border-green-700', 'opacity-100');
                b.classList.add('border-transparent', 'opacity-70');
            }
        });
    }

    function prevImage() {
        if (images.length <= 1) return;
        currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
        updateMainImage(currentIndex);
    }

    function nextImage() {
        if (images.length <= 1) return;
        currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
        updateMainImage(currentIndex);
    }

    function changeImage(src, btn) {
        document.getElementById('main-image').src = src;
        
        if(btn) {
            // Find index of clicked btn
            const allBtns = Array.from(document.querySelectorAll('.thumbnail-btn, .aspect-square.border-green-700'));
            const idx = allBtns.indexOf(btn);
            if(idx !== -1) currentIndex = idx;

            // Reset all buttons
            allBtns.forEach(b => {
                b.classList.remove('border-green-700', 'opacity-100');
                b.classList.add('border-transparent', 'opacity-70');
            });
            
            // Set active button
            btn.classList.remove('border-transparent', 'opacity-70');
            btn.classList.add('border-green-700', 'opacity-100');
        }
    }

    function switchTab(tabId, btn) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });
        
        // Show selected tab
        const activeTab = document.getElementById(tabId);
        if (activeTab) {
            activeTab.classList.remove('hidden');
            activeTab.classList.add('block');
        }
        
        // Reset buttons
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('border-green-700', 'text-green-800', 'font-bold');
            el.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'font-medium');
        });
        
        // Active button
        btn.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'font-medium');
        btn.classList.add('border-green-700', 'text-green-800', 'font-bold');
    }

    function selectWeight(btn, weight) {
        document.getElementById('selected-weight').value = weight;
        
        document.querySelectorAll('.weight-btn').forEach(b => {
            b.classList.remove('bg-green-700', 'text-white');
            b.classList.add('border', 'border-gray-300', 'text-gray-700');
        });
        
        btn.classList.remove('border', 'border-gray-300', 'text-gray-700');
        btn.classList.add('bg-green-700', 'text-white');
    }

    function updateQty(change) {
        const input = document.getElementById('quantity-input');
        let val = parseInt(input.value) + change;
        if(val < 1) val = 1;
        input.value = val;
    }
</script>
@endpush
