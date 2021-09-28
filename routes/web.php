<?php

// use GuzzleHttp\Psr7\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// bisa menggunakan use illuminate http request
// use Illuminate\Http\Request;

Route::get('/search', "SearchController@post")->name('posts.search');
Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('/', 'PostController@index')->withoutMiddleware('auth')->name('posts.index');

    Route::get('/create', 'PostController@create')->name('posts.create')->middleware('verified');
    Route::post('/store', 'PostController@store')->name('posts.store');

    Route::get('/{post:slug}/edit', 'PostController@edit')->name('posts.edit');
    Route::patch('/{post:slug}/edit', 'PostController@update');

    Route::delete('/{post:slug}/delete', 'PostController@destroy')->name('posts.delete');

    Route::get('/{post:slug}', 'PostController@show')->withoutMiddleware('auth')->name('posts.show');
});

Route::get('/categories/{category:slug}', 'CategoryController@show')->name('category.show');
Route::get('/tags/{tag:slug}', 'TagController@show')->name('tags.show');

Route::get('/change-password', 'Account\AccountController@index')->name('account.index');
Route::patch('/change-password', 'Account\AccountController@update')->name('account.edit');

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::get('email', 'SendMailController@sendEmail');
Route::get('email-queue', 'SendMailController@sendEmailQueues');