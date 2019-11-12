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

Auth::routes(['verify' => true]);

Route::group(['prefix' => 'socialite', 'as' => 'socialite.'], function() {
    Route::get('{provider}', 'SocialiteController@redirect')->name('redirect');
    Route::get('{provider}/callback', 'SocialiteController@callback')->name('callback');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('{any}', function() {
        return view('admin');
    })->where('any', '.*')->middleware('can:login,App\Models\User');
});

Route::get('/', 'PostController@index')->name('index');
Route::get('video', 'PostController@indexVideo')->name('indexVideo');
Route::resource('posts', 'PostController')->except([
    'index'
]);
