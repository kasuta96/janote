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

Route::get('/home', 'HomeController@index')->name('home');

// showPosts
Route::get('/posts', 'Post\PostController@showPosts')->name('posts');

// Create new post
Route::post('/posts/create', 'Post\PostController@createPost')->name('createPost');
