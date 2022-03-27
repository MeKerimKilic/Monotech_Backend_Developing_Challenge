<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/unauthenticated', function () {
    return response()->json(['message' => 'Unauthenticated.','success'=>false], 403);
})->name('unauthenticated');
Route::post('backoffice/login', '\App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('backoffice/register', '\App\Http\Controllers\Auth\RegisterController@register')->name('register');
Route::middleware('auth:api')->group(function () {
    Route::get('backoffice/promotion-codes','\App\Http\Controllers\PromotionCodeController@list')->name('promotion-code-list');
    Route::post('backoffice/promotion-codes','\App\Http\Controllers\PromotionCodeController@create')->name('promotion-code-create');
    Route::post('assign-promotion','\App\Http\Controllers\PromotionCodeController@assign')->name('promotion-code-assign');
    Route::get('backoffice/promotion-codes/{id}','\App\Http\Controllers\PromotionCodeController@index')->name('promotion-code-index');

});
