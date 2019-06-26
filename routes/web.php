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
Route::get("/createQR/{id}","QRController@createAndSendQR")->name("createAndSendQR");
Route::get("/sendAllQR","QRController@sendAllQR")->name("sendAllQR");
// Users routes
Route::resource("users", "UsersController");
Route::get("/search","UsersController@search")->name("searchUser");

//Hours Routes
Route::get('/user/{id}/get_in',"HoursController@get_in")->name("entrada");
Route::get('/user/{id}/get_out',"HoursController@get_out")->name("salida");

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

// Booking Articles routes
Route::resource("booking_articles", "BookingArticlesController");
Route::get("/booking_articles/create/{id}", "BookingArticlesController@createByUser")->name('createByUser');
Route::get("/booking_articles/devolver/{id}", "BookingArticlesController@updateAll")->name('updateAll');


Route::resource("booking_cubicules", "BookingCubiculesController");
// Cubicules
Route::resource("cubicules", "CubiculesController");
Route::get('autocomplete', 'WarehouseController@searchArticulo');
Route::post('search', 'WarehouseController@search');


// Route::resource("cubicules", "CubiculesController");