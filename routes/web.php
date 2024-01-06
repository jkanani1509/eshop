<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\AboutUs;
use App\Livewire\Frontend\Blog;
use App\Livewire\Frontend\ContactUs;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Logout;
use App\Livewire\Frontend\ProductDetail;
use App\Livewire\Frontend\WishListDetail;
use App\Livewire\Frontend\Cartdetail;
use App\Livewire\Frontend\Checkout;
use App\Livewire\Backend\Dashboard;
use App\Livewire\Backend\ListBanner;
use App\Livewire\Backend\ListBrand;
use App\Livewire\Backend\ListCategory;
use App\Livewire\Backend\ListProduct;




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

Route::get('/', Home::class)->name('Home');
Route::get('/Home', Home::class)->name('Home');
Route::get('login', Login::class)->name('login')->middleware('isLogin');
Route::get('register', Register::class)->name('register')->middleware('isLogin');
Route::get('logout', Logout::class)->name('logout');
Route::get('/aboutus', AboutUs::class)->name('aboutus');
Route::get('/contactus', ContactUs::class)->name('contactus');
Route::get('/post', Blog::class)->name('blog');

Route::get('/wishlist', WishListDetail::class)->name('wishlist');
Route::get('/cartlist', Cartdetail::class)->name('cartlist');
Route::get('/checkout', Checkout::class)->name('checkout');


Route::get('/product-detail/{slug}', ProductDetail::class)->name('product-detail');
// Route::get('/product-detail/{slug}', [ProductDetail::class, 'productDetail'])->name('product-detail');
// Route::get('', 'ProductDetail@product-detail')->name('product-detail');
// Route::get('/product-detail/{$slug}',ProductDetail::class)->name('product-detail');
// Route::get('blog-cat/{slug}', [Blog::class, 'blogByCategory'])->name('blog.category');

Route::group(['prefix' => 'admin','middleware'=>['web','isAdmin']],function(){
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/banners', ListBanner::class)->name('admin.banners');
    Route::get('/brands', ListBrand::class )->name('admin.brand');
    Route::get('/category', ListCategory::class )->name('admin.category');
    Route::get('/product', ListProduct::class )->name('admin.product');
});

// Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');



