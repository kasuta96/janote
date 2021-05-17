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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// show Posts
Route::get('/posts', 'Post\PostController@showPosts')->name('posts');
// Create new post
Route::post('/post/create', 'Post\PostController@create')->name('createPost');
// delete Posts
Route::get('/post/delete/{id}', 'Post\PostController@delete')->name('deletePost');

// show Notes
Route::get('/notes', 'Post\PostController@showPosts')->name('notes');

// show Categories
Route::get('/categories', 'Category\CategoryController@show')->name('categories');

