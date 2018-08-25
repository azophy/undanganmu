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

Route::get('/', function () {
    return view('welcome');
});

Route::domain('main.undangan-mu.herokuapp.com')->group(function () {
    Route::get('/', function () {
        return view('welcome_main');
    });
});
Route::domain('{site_url}.undangan-mu.herokuapp.com', 'SiteController@display_site')

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    // site management routes
    Route::resource('site', 'SiteController')->except(['show']);
    Route::resource('template', 'TemplateController')->except(['show']);
    Route::resource('user', 'UserController')->except(['show']);
    Route::redirect('/',route('site.index'),301); // set default admin homepage
 });

Route::get('/{site_url}', 'SiteController@display_site');



