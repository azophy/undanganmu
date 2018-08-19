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

Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches The "/admin/users" URL
     });
 });

Route::get('/{site_url}', 'SiteController@display_site');



