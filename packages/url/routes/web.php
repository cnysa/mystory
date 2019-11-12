<?php

Route::domain('url.' . config('session.domain'))->name('url.')->group(function () {
    Route::resource('urls', '\Url\Controllers\UrlController')->middleware(['web', 'auth', 'api']);
    Route::get('urls/{id}/details', '\Url\Controllers\UrlController@getUrlDetail')->middleware(['web', 'auth', 'api']);
    Route::group(['middleware' => 'web'], function() {
        Route::get('/', '\Url\Controllers\AppController@index')->name('index');
        Route::get('/{slug}', '\Url\Controllers\AppController@redirect')->name('redirect');
    });
});
