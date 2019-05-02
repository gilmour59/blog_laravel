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

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoryController');

    Route::resource('tags', 'TagController');

    Route::resource('posts', 'PostController');
    Route::put('restore-posts/{post}', 'PostController@restore')->name('posts.restore');
    Route::get('trashed-posts', 'PostController@trashed')->name('posts.trash');
    Route::delete('trashed-posts/{post}', 'PostController@destroyTrash')->name('posts.destroy-trash');
});
