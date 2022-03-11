<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::name('front.')->group(function() {
    // home
    Route::get('/', 'Front\FrontController@index')->name('home');
    Route::post('/subscribe', 'Front\FrontController@mailSubscribe')->name('subscription');

    // category detail
    Route::name('category.')->group(function() {
        Route::get('/category/{slug}', 'Front\CategoryController@detail')->name('detail');
    });

    // collection detail
    Route::name('collection.')->group(function() {
        Route::get('/collection/{slug}', 'Front\CollectionController@detail')->name('detail');
    });

    // product detail
    Route::name('product.')->group(function() {
        Route::get('/product/{slug}', 'Front\ProductController@detail')->name('detail');
        Route::post('/size', 'Front\ProductController@size')->name('size');
    });

    // cart
    Route::prefix('cart')->name('cart.')->group(function() {
        Route::get('/', 'Front\CartController@viewByIp')->name('index');
        Route::post('/add', 'Front\CartController@add')->name('add');
        Route::get('/delete/{id}', 'Front\CartController@delete')->name('delete');
        Route::get('/quantity/{id}/{type}', 'Front\CartController@qtyUpdate')->name('quantity');
    });

    // checkout/ order
    Route::prefix('checkout')->name('checkout.')->group(function() {
        Route::get('/', 'Front\CheckoutController@index')->name('index');
        Route::post('/store', 'Front\CheckoutController@store')->name('store');
        Route::view('/complete', 'front.checkout.complete')->name('complete');
    });

    Route::middleware(['guest:web'])->group(function() {
        // user login & registration
        Route::prefix('user/')->name('user.')->group(function() {
            Route::get('/register', 'Front\UserController@register')->name('register');
            Route::post('/create', 'Front\UserController@create')->name('create');
            Route::get('/login', 'Front\UserController@login')->name('login');
            Route::post('/check', 'Front\UserController@check')->name('check');
        });
    });

    Route::middleware(['auth:web'])->group(function() {
        Route::prefix('user/')->name('user.')->group(function() {
            Route::view('profile', 'front.profile.index')->name('profile');
            Route::view('manage', 'front.profile.edit')->name('manage');
            Route::post('manage/update', 'Front\UserController@updateProfile')->name('manage.update');
            Route::post('password/update', 'Front\UserController@updatePassword')->name('password.update');
            Route::get('order', 'Front\UserController@order')->name('order');
            Route::get('coupon', 'Front\UserController@coupon')->name('coupon');
            Route::get('address', 'Front\UserController@address')->name('address');
            Route::view('address/add', 'front.profile.address-add')->name('address.add');
            Route::post('address/add', 'Front\UserController@addressCreate')->name('address.create');
        });
    });

    // mail template test
    Route::view('/mail/1', 'front.mail.register'); 
    Route::view('/mail/2', 'front.mail.order-confirm'); 
});

// Route::view('/login', 'home')->name('login');

Auth::routes();

// common & user guard
// Route::prefix('user')->name('user.')->group(function() {
//     Route::middleware(['guest:web'])->group(function() {
//         Route::view('/register', 'front.auth.register')->name('register');
//         Route::post('/create', 'Front\UserController@create')->name('create');
//         Route::view('/login', 'auth.login')->name('login');
//         Route::post('/check', 'Front\UserController@check')->name('check');
//     });

//     Route::middleware(['auth:web'])->group(function() {
//         Route::view('/home', 'user.home')->name('home');
//     });
// });

// admin guard
Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware(['guest:admin'])->group(function() {
        Route::view('/login', 'admin.auth.login')->name('login');
        Route::post('/check', 'Admin\AdminController@check')->name('login.check');
    });

    Route::middleware(['auth:admin'])->group(function() {
        // dashboard
        Route::get('/home', 'Admin\AdminController@home')->name('home');

        // category
        Route::prefix('category')->name('category.')->group(function() {
            Route::get('/', 'Admin\CategoryController@index')->name('index');
            Route::post('/store', 'Admin\CategoryController@store')->name('store');
            Route::get('/{id}/view', 'Admin\CategoryController@show')->name('view');
            Route::post('/{id}/update', 'Admin\CategoryController@update')->name('update');
            Route::get('/{id}/status', 'Admin\CategoryController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\CategoryController@destroy')->name('delete');
        });

        // sub-category
        Route::prefix('subcategory')->name('subcategory.')->group(function() {
            Route::get('/', 'Admin\SubCategoryController@index')->name('index');
            Route::post('/store', 'Admin\SubCategoryController@store')->name('store');
            Route::get('/{id}/view', 'Admin\SubCategoryController@show')->name('view');
            Route::post('/{id}/update', 'Admin\SubCategoryController@update')->name('update');
            Route::get('/{id}/status', 'Admin\SubCategoryController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\SubCategoryController@destroy')->name('delete');
        });

        // collection
        Route::prefix('collection')->name('collection.')->group(function() {
            Route::get('/', 'Admin\CollectionController@index')->name('index');
            Route::post('/store', 'Admin\CollectionController@store')->name('store');
            Route::get('/{id}/view', 'Admin\CollectionController@show')->name('view');
            Route::post('/{id}/update', 'Admin\CollectionController@update')->name('update');
            Route::get('/{id}/status', 'Admin\CollectionController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\CollectionController@destroy')->name('delete');
        });

        // coupon
        Route::prefix('coupon')->name('coupon.')->group(function() {
            Route::get('/', 'Admin\CouponController@index')->name('index');
            Route::post('/store', 'Admin\CouponController@store')->name('store');
            Route::get('/{id}/view', 'Admin\CouponController@show')->name('view');
            Route::post('/{id}/update', 'Admin\CouponController@update')->name('update');
            Route::get('/{id}/status', 'Admin\CouponController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\CouponController@destroy')->name('delete');
        });

        // customer
        Route::prefix('customer')->name('customer.')->group(function() {
            Route::get('/', 'Admin\UserController@index')->name('index');
            Route::post('/store', 'Admin\UserController@store')->name('store');
            Route::get('/{id}/view', 'Admin\UserController@show')->name('view');
            Route::post('/{id}/update', 'Admin\UserController@update')->name('update');
            Route::get('/{id}/status', 'Admin\UserController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\UserController@destroy')->name('delete');
        });

        // product
        Route::prefix('product')->name('product.')->group(function() {
            Route::get('/list', 'Admin\ProductController@index')->name('index');
            Route::get('/create', 'Admin\ProductController@create')->name('create');
            Route::post('/store', 'Admin\ProductController@store')->name('store');
            Route::get('/{id}/view', 'Admin\ProductController@show')->name('view');
            Route::post('/size', 'Admin\ProductController@size')->name('size');
            Route::get('/{id}/edit', 'Admin\ProductController@edit')->name('edit');
            Route::post('/{id}/update', 'Admin\ProductController@update')->name('update');
            Route::get('/{id}/status', 'Admin\ProductController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\ProductController@destroy')->name('delete');
            Route::get('/{id}/image/delete', 'Admin\ProductController@destroySingleImage')->name('image.delete');
        });

        // address
        Route::prefix('address')->name('address.')->group(function() {
            Route::get('/', 'Admin\AddressController@index')->name('index');
            Route::post('/store', 'Admin\AddressController@store')->name('store');
            Route::get('/{id}/view', 'Admin\AddressController@show')->name('view');
            Route::post('/{id}/update', 'Admin\AddressController@update')->name('update');
            Route::get('/{id}/status', 'Admin\AddressController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\AddressController@destroy')->name('delete');
        });

        // faq
        Route::prefix('faq')->name('faq.')->group(function() {
            Route::get('/', 'Admin\FaqController@index')->name('index');
            Route::post('/store', 'Admin\FaqController@store')->name('store');
            Route::get('/{id}/view', 'Admin\FaqController@show')->name('view');
            Route::post('/{id}/update', 'Admin\FaqController@update')->name('update');
            Route::get('/{id}/status', 'Admin\FaqController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\FaqController@destroy')->name('delete');
        });

        // settings
        Route::prefix('settings')->name('settings.')->group(function() {
            Route::get('/', 'Admin\SettingsController@index')->name('index');
            Route::post('/store', 'Admin\SettingsController@store')->name('store');
            Route::get('/{id}/view', 'Admin\SettingsController@show')->name('view');
            Route::post('/{id}/update', 'Admin\SettingsController@update')->name('update');
            Route::get('/{id}/status', 'Admin\SettingsController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\SettingsController@destroy')->name('delete');
        });

        // order
        Route::prefix('order')->name('order.')->group(function() {
            Route::get('/', 'Admin\OrderController@index')->name('index');
            Route::post('/store', 'Admin\OrderController@store')->name('store');
            Route::get('/{id}/view', 'Admin\OrderController@show')->name('view');
            Route::post('/{id}/update', 'Admin\OrderController@update')->name('update');
            Route::get('/{id}/status/{status}', 'Admin\OrderController@status')->name('status');
        });

        // transaction
        Route::prefix('transaction')->name('transaction.')->group(function() {
            Route::get('/', 'Admin\TransactionController@index')->name('index');
            Route::get('/{id}/view', 'Admin\TransactionController@show')->name('view');
        });
    });
});

Route::get('/home', 'HomeController@index')->name('home');
