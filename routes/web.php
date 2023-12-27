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
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');
Route::get('logout', Logout::class)->name('logout');
Route::get('/aboutus', AboutUs::class)->name('aboutus');
Route::get('/contactus', ContactUs::class)->name('contactus');
Route::get('/post', Blog::class)->name('blog');

Route::get('/wishlist', WishListDetail::class)->name('wishlist');
Route::get('/cartlist', Cartdetail::class)->name('cartlist');
Route::get('/checkout', Checkout::class)->name('checkout');
// Route::get('/wishlistdetail', WishListDetail::class)->name('wishlistdetail');


Route::get('/product-detail/{slug}', ProductDetail::class)->name('product-detail');
// Route::get('/product-detail/{slug}', [ProductDetail::class, 'productDetail'])->name('product-detail');
// Route::get('', 'ProductDetail@product-detail')->name('product-detail');
// Route::get('/product-detail/{$slug}',ProductDetail::class)->name('product-detail');
// Route::get('blog-cat/{slug}', [Blog::class, 'blogByCategory'])->name('blog.category');

