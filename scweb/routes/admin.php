<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BlogCategoriesController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AdminController::class, 'index'])->middleware('auth:admin')->name('admin.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth:admin'], function(){
    
    Route::controller(ServiceController::class)
    ->name('admin.services.')
    ->group(function () {
        Route::get('/services', 'index')->name('index');
        Route::get('/services/create', 'create')->name('create');
        Route::post('/services', 'store')->name('store');
        Route::get('/services/{service}', 'edit')->name('edit');
        Route::put('/services/{service}', 'update')->name('update');
        Route::delete('/services/{service}', 'delete')->name('delete');
    });

    //memebers routes
    Route::controller(MemberController::class)
    ->name('admin.members.')
    ->group(function () {
        Route::get('/members', 'index')->name('index');
        Route::get('/members/create', 'create')->name('create');
        Route::post('/members', 'store')->name('store');
        Route::get('/members/{member}', 'edit')->name('edit');
        Route::put('/members/{member}', 'update')->name('update');
        Route::delete('/members/{member}', 'delete')->name('delete');
    });


    //Blogs routes
    Route::group(['prefix' => 'blog', 'as' => 'admin.blog.'], function(){
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function(){
           //Blog
            Route::controller(BlogCategoriesController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{blog_category}', 'edit')->name('edit');
                Route::put('/{blog_category}', 'update')->name('update');
                Route::delete('/{blog_category}', 'delete')->name('delete');

                Route::get('{blog_category}', 'categoryViaId')->name('categoryviaId');
            });
        });

        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function(){
            Route::controller(BlogPostController::class)
            ->group(function () {
                Route::get('/posts', 'index')->name('index');
                Route::get('/posts/create', 'create')->name('create');
                Route::post('/posts', 'store')->name('store');
                Route::get('/posts/{post}', 'edit')->name('edit');
                Route::put('/posts/{post}', 'update')->name('update');
                Route::delete('delete/{post}', 'delete')->name('delete');
            });
        });
    });

    //Pages routes
    Route::controller(PageController::class)->group(function(){
        Route::get('pages/home', 'home')->name('pages.home');
        Route::get('contacts/list', 'contact_list')->name('contact.list');
        Route::get('is-replied', 'is_replied')->name('contact.isReplied');
       
    });

    Route::controller(SettingController::class)->group(function(){       
        Route::get('settings', 'settings')->name('settings');
        Route::put('settings', 'update_settings')->name('settings');
    });

    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function(){
        Route::controller(PageController::class)->group(function(){
            Route::put('/home/content/update', 'update')->name('update');
            Route::get('/about', 'about')->name('about');
        });
    });
});
