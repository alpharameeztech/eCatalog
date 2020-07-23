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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/{store}/catalogs/{catalog}', 'CatalogController@show');

Route::get('/tag/{tag}', 'TagController@show');

Route::get('/stores', 'StoreController@index');
Route::get('/store/{store}', 'StoreController@show');
Route::get('/store/{store}/catalogs', 'StoreController@showCatalogs');

Route::get('/{store}/{city}/{branch}', 'BranchController@show');

Route::get('/terms', 'TermController@index');

Route::get('/faq', 'FaqController@index');

Route::get('/blog', 'BlogController@index');

Route::get('/blog/{blog}', 'BlogController@show');

Route::get('/catalogs', 'CatalogController@index');

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
    Route::patch('/country/{country}', 'CountryController@update')->name('update.country');

    Route::get('/cities', 'CityController@index')->name('all.cities');
    Route::post('/cities', 'CityController@store')->name('add.city');
    Route::patch('/city/{city}', 'CityController@update')->name('update.city');

    Route::get('/stores', 'StoreController@index')->name('all.stores');
    Route::post('/store', 'StoreController@store')->name('add.store');
    Route::patch('/toggle/store/status', 'StoreController@toggleStatus')->name('toggle.store.status');
    Route::patch('/toggle/store/featured', 'StoreController@toggleFeatured')->name('toggle.store.featured');
    Route::get('/store/{store}/branches', 'StoreController@storeBranches')->name('all.stores');

    Route::get('/malls', 'MallController@index')->name('all.malls');
    Route::post('/mall', 'MallController@store')->name('add.mall');
    Route::patch('/mall/{mall}', 'MallController@update')->name('update.mall');

    Route::get('/branches', 'BranchController@index')->name('all.branches');
    Route::post('/branch', 'BranchController@store')->name('add.branch');
    Route::patch('/branch/{branch}', 'BranchController@update')->name('update.branch');
    Route::patch('/toggle/branch/status', 'BranchController@toggleStatus')->name('toggle.branch.status');

    Route::get('/tags', 'TagController@index')->name('all.tags');
    Route::post('/tag', 'TagController@store')->name('add.tag');
    Route::patch('/tag/{tag}', 'TagController@update')->name('update.tag');
    Route::patch('/toggle/tag/status', 'TagController@toggleStatus')->name('toggle.tag.status');

    Route::get('/catalogs', 'CatalogController@index')->name('all.catalogs');
    Route::post('/catalog', 'CatalogController@store')->name('add.catalog');
    Route::patch('/catalog/{catalog}', 'CatalogController@update')->name('update.catalog');
    Route::patch('/reorder/catalog/images', 'CatalogController@reorderImages')->name('reorder.catalog.images');
    Route::patch('/toggle/catalog/status', 'CatalogController@toggleStatus')->name('toggle.catalog.status');
    Route::post('/catalog/images', 'CatalogController@storeImages')->name('add.catalog.images');
    Route::post('/delete/catalog/image', 'CatalogController@deleteImage')->name('delete.catalog.image');
    Route::post('/toggle/featured/image', 'CatalogController@toggleFeaturedImage')->name('toggle.catalog.featured.image');
    Route::post('/catalog/pdf', 'CatalogController@storePdf')->name('add.catalog.pdf');
    Route::post('/delete/catalog/pdf', 'CatalogController@deletePdf')->name('delete.catalog.pdf');

    Route::get('/faqs', 'FaqController@index')->name('all.faqs');
    Route::post('/faq', 'FaqController@store')->name('add.faq');
    Route::patch('/faq/{faq}', 'FaqController@update')->name('update.faq');
    Route::patch('/toggle/faq/status', 'FaqController@toggleStatus');

    Route::get('/terms', 'TermController@index')->name('all.terms');
    Route::post('/term', 'TermController@store')->name('add.term');
    Route::patch('/term/{term}', 'TermController@update')->name('update.term');
    Route::patch('/toggle/term/status', 'TermController@toggleStatus');

    Route::get('/blogs', 'BlogController@index')->name('all.blogs');
    Route::post('/blog', 'BlogController@store')->name('add.blog');
    Route::post('/blog/upload/image', 'BlogController@uploadImage');
    Route::patch('/blog/{blog}', 'BlogController@update')->name('update.blog');
    Route::patch('/toggle/blog/{blog}/status', 'BlogController@toggleStatus');

    Route::get('/account/details', 'AuthController@index');
    Route::patch('/account/details', 'AuthController@update');

    Route::get('/home', 'HomeController@index');
    Route::post('/home/page', 'HomeController@store');
    Route::patch('/home/page/{home}', 'HomeController@update');

    Route::get('/social', 'SocialController@index');
    Route::post('/social', 'SocialController@store');
    Route::patch('/social/{social}', 'SocialController@update');

    Route::get('/banners', 'BannerController@index')->name('all.banners');
    Route::post('/banner', 'BannerController@store')->name('add.banner');
    Route::patch('/toggle/banner/status', 'BannerController@toggleStatus')->name('toggle.banner.status');
    // Route::patch('/toggle/store/featured', 'StoreController@toggleFeatured')->name('toggle.store.featured');
    // Route::get('/store/{store}/branches', 'StoreController@storeBranches')->name('all.stores');

    Route::get('/advertisements', 'AdvertisementController@index')->name('all.advertisements');
    Route::post('/advertisements', 'AdvertisementController@store')->name('add.advertisement');
    Route::post('/toggle/advertisements/status', 'AdvertisementController@toggleStatus')->name('toggle.advertisement.status');

});
//======================== public apis end ==========================

Route::get('/{city}/{mall}', 'MallController@show');
