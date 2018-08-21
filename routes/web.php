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
    return view('templates.undanganmu.index');
});

Route::domain('main.undangan-mu.herokuapp.com')->group(function () {
    Route::get('/', function () {
        return view('welcome_main');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('site', 'SiteController')->except(['show']);
    Route::redirect('/',route('site.index'),301); // set default admin homepage
 });

Route::get('/{site_url}', 'SiteController@display_site');



