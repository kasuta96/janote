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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Post\PostController@showPosts');
// show Posts
Route::get('/posts', 'Post\PostController@showPosts')->name('posts');
// Create new post
Route::post('/post/create', 'Post\PostController@create')->name('createPost');
// delete Post
Route::get('/post/delete/{id}', 'Post\PostController@delete')->name('deletePost');

// show category's Notes
Route::get('/category/{id}', 'Note\NoteController@index')->name('notes');

// show Categories
Route::get('/categories', 'Category\CategoryController@show')->name('categories');

//create Categories
Route::get('/categories/create', 'Category\CategoryController@create');
Route::post('/categories', 'Category\CategoryController@store')->name('createCategory');

//delete Category
Route::get('/categories/delete/{id}', 'Category\CategoryController@delete')->name('deleteCategory');

//edit & update Category
Route::get('/categories/edit', 'Category\CategoryController@edit')->name('editCategory');
Route::patch('/categories', 'Category\CategoryController@update')->name('updateCategory');
