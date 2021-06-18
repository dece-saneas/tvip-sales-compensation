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

Route::get('/', 'DashboardController@index')->name('dashboard');

Auth::routes(['reset' => false, 'verify' => false, 'confirm' => false]);

Route::prefix('super-admin')->group(function () {
    Route::resource('users','Core\UserController', ['as' => 'core'])->except(['show']);
    Route::resource('roles','Core\RoleController', ['as' => 'core'])->except(['show']);
    Route::resource('permissions','Core\PermissionController', ['as' => 'core'])->except(['show']);
});

Route::resource('settings','SettingsController')->except(['show']);

Route::post('/products/filter', 'ProductsController@filter')->name('products.filter');
Route::resource('products','ProductsController')->except(['show']);