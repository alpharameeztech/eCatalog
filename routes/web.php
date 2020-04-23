<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
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
    return view('home');
})->name('home');

Auth::routes();

Route::get('/about-us', function () {
    return view('pages.about');
})->name('about.us');

Route::get('/home', function(){
    return view('admin.dashboard');
})->name('admin.dashboard')
    ->middleware('auth');

//
//======================== public apis ==========================
Route::group([
    'prefix'        => 'api',
    'namespace'     => 'Api',
], function (Router $router) {
    Route::get('/countries', 'CountryController@index')->name('all.countries');
    Route::post('/countries', 'CountryController@store')->name('add.country');
    Route::patch('/countries', 'CountryController@update')->name('update.country');
});
//======================== public apis end ==========================
