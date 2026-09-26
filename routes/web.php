<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    $categories = TCG\Voyager\Models\Category::orderBy('order', 'asc')->take(3)->get();
    $posts = App\Models\Post::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->take(3)->get();
    return view('welcome', compact('categories', 'posts'));
});

Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/bai-viet', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/bai-viet/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::get('/cau-chuyen-san-pham', [\App\Http\Controllers\PageController::class, 'productStory'])->name('pages.product_story');
Route::get('/gioi-thieu-doanh-nghiep', [\App\Http\Controllers\PageController::class, 'companyIntro'])->name('pages.company_intro');
Route::get('/chinh-sach/{type}', [\App\Http\Controllers\PageController::class, 'policy'])->name('pages.policy');

Route::get('/lien-he', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/lien-he', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/link-storage', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return 'Storage linked successfully!';
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Cart routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Auth routes
Route::get('/dang-nhap', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/dang-nhap', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/dang-ky', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/dang-ky', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/dang-xuat', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
