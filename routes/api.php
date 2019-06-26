<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'LoginController@login');

Route::get('articles','WarehouseController@indexApi');
Route::get('autocomplete', 'WarehouseController@searchArticulo');
Route::get('search', 'WarehouseController@search');

// ROUTE BOOKING ARTICLES
Route::post('booking_articles', 'BookingArticlesController@createByUserApi');

// RUTAS CUBICULOS
Route::get("booking_cubicules","BookingCubiculesController@indexAPI");
Route::get("booking_cubicules","BookingCubiculesController@createAPI");
Route::post("booking_cubicules","BookingCubiculesController@storeAPI");
Route::post("booking_cubicules","BookingCubiculesController@destroyAPI");
