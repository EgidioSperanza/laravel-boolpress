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

Auth::routes();

Route::middleware("auth")
    ->namespace("Admin")
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
    });


Route::get("{any?}", function() {
    return view("guest.home");
})->where("any", ".*");