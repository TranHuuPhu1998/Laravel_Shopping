<?php

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

Route::get('/admin', 'AdminController@loginAdmin');

Route::post('/admin', 'AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index', // name router
            'uses' => 'CategoryController@index',
        ]);
        Route::get('/create', [
            'as' => 'categories.create', // name router
            'uses' => 'CategoryController@create',
        ]);
        Route::post('/store', [
            'as' => 'categories.store', // name router
            'uses' => 'CategoryController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit', // name router
            'uses' => 'CategoryController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update', // name router
            'uses' => 'CategoryController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete', // name router
            'uses' => 'CategoryController@delete',
        ]);
    });
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index', // name router
            'uses' => 'MenuController@index',
        ]);
        Route::get('/create', [
            'as' => 'menus.create', // name router
            'uses' => 'MenuController@create',
        ]);
        Route::post('/store', [
            'as' => 'menus.store', // name router
            'uses' => 'MenuController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit', // name router
            'uses' => 'MenuController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update', // name router
            'uses' => 'MenuController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete', // name router
            'uses' => 'MenuController@delete',
        ]);
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index', // name router
            'uses' => 'AdminProductController@index',
        ]);
        Route::get('/create', [
            'as' => 'product.create', // name router
            'uses' => 'AdminProductController@create',
        ]);
        Route::post('/store', [
            'as' => 'product.store', // name router
            'uses' => 'AdminProductController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'product.edit', // name router
            'uses' => 'AdminProductController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'product.update', // name router
            'uses' => 'AdminProductController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'product.delete', // name router
            'uses' => 'AdminProductController@delete',
        ]);
    });
    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'slider.index', // name router
            'uses' => 'SliderAdminController@index',
        ]);
        Route::get('/create', [
            'as' => 'slider.create', // name router
            'uses' => 'SliderAdminController@create',
        ]);
        Route::post('/store', [
            'as' => 'slider.store', // name router
            'uses' => 'SliderAdminController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'slider.edit', // name router
            'uses' => 'SliderAdminController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'slider.update', // name router
            'uses' => 'SliderAdminController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'slider.delete', // name router
            'uses' => 'SliderAdminController@delete',
        ]);
    });
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index', // name router
            'uses' => 'AdminSettingController@index',
        ]);
        Route::get('/create', [
            'as' => 'settings.create', // name router
            'uses' => 'AdminSettingController@create',
        ]);
        Route::post('/store', [
            'as' => 'settings.store', // name router
            'uses' => 'AdminSettingController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit', // name router
            'uses' => 'AdminSettingController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'settings.update', // name router
            'uses' => 'AdminSettingController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'settings.delete', // name router
            'uses' => 'AdminSettingController@delete',
        ]);
    });

});
