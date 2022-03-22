<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware("auth")
    ->namespace("Admin")
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
        Route::resource('comments', 'PostController');
    });

    Route::get('/guest.home', 'Auth\LoginController@logout');
               
Route::get("{any?}", function() {
    return view("guest.home");
})->where("any", ".*");