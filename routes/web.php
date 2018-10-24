<?php

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

// --------------- SUBDOMAIN ROUTES -----------------
Route::group(['domain' => '{site_url}.'.env('ROOT_URL','undangan-mu.herokuapp.com')], function() {
    Route::get('/', 'SiteController@display_site');
});
Route::group(['domain' => '{site_url}.undangan.mu'], function() {
    Route::get('/', 'SiteController@display_site');
});
Route::group(['domain' => '{site_url}.ngundangkamu.co'], function() {
    Route::get('/', 'SiteController@display_site');
});

// --------------- AUTHENTIFICATION ROUTES -----------------

Route::auth();

// --------------- ADMIN AREA ROUTES -----------------
Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    // site management routes
    Route::resource('site', 'SiteController')->except(['show']);
    Route::resource('template', 'TemplateController')->except(['show']);
    Route::resource('user', 'UserController')->except(['show']);
    Route::redirect('/',route('site.index'),301); // set default admin homepage
 });

// --------------- TOP LEVEL ROUTES -----------------
Route::get('/', function () { return view('welcome'); });
Route::get('/{site_url}', 'SiteController@display_site');

