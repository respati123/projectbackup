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

Route::get('/getslider','APIController@getSliderSejarah');
Route::get('/getmaps','APIController@getMapsSejarah');
Route::get('/getkategori','APIController@getKategoriSejarah');
Route::get('/getlist/{id}','APIController@getListSejarah');
Route::get('/getdetail/{id}','APIController@getDetailSejarah');
