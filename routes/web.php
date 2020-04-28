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

    Route::get('/cities', 'CityController@index')->name('all.cities');
    Route::post('/cities', 'CityController@store')->name('add.city');
    Route::patch('/cities', 'CityController@update')->name('update.city');

    Route::get('/stores', 'StoreController@index')->name('all.stores');
    Route::post('/store', 'StoreController@store')->name('add.store');
    Route::patch('/toggle/store/status', 'StoreController@toggleStatus')->name('toggle.store.status');

    Route::get('/malls', 'MallController@index')->name('all.malls');
    Route::post('/mall', 'MallController@store')->name('add.mall');
    Route::patch('/mall', 'MallController@update')->name('update.mall');

    Route::get('/branches', 'BranchController@index')->name('all.branches');
    Route::post('/branch', 'BranchController@store')->name('add.branch');
    Route::patch('/branch', 'BranchController@update')->name('update.branch');
    Route::patch('/toggle/branch/status', 'BranchController@toggleStatus')->name('toggle.branch.status');

    Route::get('/tags', 'TagController@index')->name('all.tags');
    Route::post('/tag', 'TagController@store')->name('add.tag');
    Route::patch('/tag', 'TagController@update')->name('update.tag');
    Route::patch('/toggle/tag/status', 'TagController@toggleStatus')->name('toggle.tag.status');

    Route::get('/catalogs', 'CatalogController@index')->name('all.catalogs');
    Route::post('/catalog', 'CatalogController@store')->name('add.catalog');
    Route::patch('/catalog', 'CatalogController@update')->name('update.catalog');
    Route::patch('/toggle/catalog/status', 'CatalogController@toggleStatus')->name('toggle.catalog.status');
});
//======================== public apis end ==========================
