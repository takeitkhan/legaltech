<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blog/view/{slug}', 'blog_view')->name('blog.view');
    Route::get('/team', 'team')->name('team');
    Route::post('/contact/send', 'contact_submit')->name('contact.submit');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
