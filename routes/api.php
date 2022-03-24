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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'Api\PostController@index');
Route::get('/post/{slug}', 'Api\PostController@show');
Route::get('/create', 'Api\PostController@create');
Route::get('/post/{id}/edit', 'Api\PostController@edit');
Route::put('/post/{id}/update', 'Api\PostController@update');
Route::delete('/delete/{id}', 'Api\PostController@destroy');
Route::delete('delete/{id}', 'Api\PostController@destroy')->prefix('post');
Route::post('/posts', 'Api\PostController@store');
Route::post('/contacts', 'Api\ContactController@store');
Route::post('/logout', 'Api\PostController@logout');