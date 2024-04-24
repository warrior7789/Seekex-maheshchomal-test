<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/buckets/create', 'App\Http\Controllers\BucketController@create');
Route::post('/buckets', 'App\Http\Controllers\BucketController@store');
Route::get('/balls/create', 'App\Http\Controllers\BallController@create');
Route::post('/balls', 'App\Http\Controllers\BallController@store');
Route::get('/buckets/suggest', 'App\Http\Controllers\BucketController@suggest');
Route::get('/result', 'App\Http\Controllers\ResultController@index');
