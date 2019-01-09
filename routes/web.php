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
    Route::get('/', 'MainController@display_site');
});
Route::group(['domain' => '{site_url}.undangan.mu'], function() {
    Route::get('/', 'MainController@display_site');
});
Route::group(['domain' => '{site_url}.ngundangkamu.co'], function() {
    Route::get('/', 'MainController@display_site');
});

// --------------- AUTHENTIFICATION ROUTES -----------------
Route::auth();

// ---------------- SOCIALITE PAGE ROUTES ---------------
$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\LoginController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\LoginController@getSocialHandle']);


// --------------- MEMBER AREA ROUTES -----------------
Route::prefix('member')->name('member.')->namespace('Member')->middleware(['auth'])->group(function () {
    Route::get('index', 'MainController@index')->name('index');
    Route::get('profile', 'MainController@edit_profile')->name('edit_profile');
    Route::post('profile', 'MainController@update_profile')->name('update_profile');
    Route::get('site', 'MainController@edit_site')->name('edit_site');
    Route::post('site', 'MainController@update_site')->name('update_site');
 });

// --------------- ADMIN AREA ROUTES -----------------
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware(['auth','admin'])->group(function () {
    // site management routes 
    Route::resource('site', 'SiteController')->except(['show']);
    Route::resource('template', 'TemplateController')->except(['show']);
    Route::get('user/{id}/create_custom_template', 'UserController@create_custom_template')->name('user.create_custom_template');
    Route::post('user/{id}/create_custom_template', 'UserController@store_custom_template')->name('user.store_custom_template');
    Route::resource('user', 'UserController')->except(['show']);
    Route::redirect('/',route('admin.site.index'),301); // set default admin homepage
 });

// --------------- TOP LEVEL ROUTES -----------------
Route::get('/', function () { return view('undanganmu.index'); });
Route::get('/{site_url}', 'MainController@display_site');
Route::get('/{site_url}/lokasi', 'MainController@display_site_lokasi');

