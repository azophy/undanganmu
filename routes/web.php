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
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

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

