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

// Views Routes
Route::view('/', 'test');
// QR routes
Route::resource("qr", "QRController");
// Users routes
Route::resource("users", "UsersController");
// Import Excel Routes
Route::get('/import', 'UserData@index')->name("usersData.index");
Route::post('/import', 'UserData@importUsers')->name("usersData.import");
// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('loginForm');
Route::post('login', 'Auth\LoginController@login')->name("login");
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes
Route::get('password/reset/', 'Auth\ResetPasswordController@showResetForm')->name('showResetForm');
Route::post('password/reset/', 'Auth\ResetPasswordController@resetPassword')->name('resetPassword');
// Warehouse routes
Route::resource("warehouse", "WarehouseController");
// Lending routes
Route::resource("lendings", "LendingsController");
// Lending routes
Route::resource("cubicules", "CubiculesController");