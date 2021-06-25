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

Route::get('/{home}', 'HomeController@index')->name('home')->where('home','(home)?');

// show Posts
Route::get('/posts', 'Post\PostController@showPosts')->name('posts');
// Create new post
Route::post('/post/create', 'Post\PostController@create')->name('createPost');
// delete Post
Route::get('/post/delete/{id}', 'Post\PostController@delete')->name('deletePost');

// show category's Notes
Route::get('/notes', 'Note\NoteController@index')->name('notes');
// Create note
Route::get('/note/create', 'Note\NoteController@create')->name('createNote');
Route::post('/note/store', 'Note\NoteController@store')->name('storeNote');
// delete Note
Route::get('/note/delete/{id}', 'Note\NoteController@delete')->name('deleteNote');
// Edit Note
Route::get('/note/edit/{id}', 'Note\NoteController@edit')->name('editNote');
Route::post('/note/update', 'Note\NoteController@update')->name('updateNote');
// Trash
Route::get('/trash', 'TrashController@index')->name('trash');
Route::get('/trash/remove/{id}', 'Note\NoteController@remove')->name('removeNote');
Route::get('/trash/restore/{id}', 'Note\NoteController@restore')->name('restoreNote');
Route::get('/trash/restore2/{id}', 'Category\CategoryController@restore')->name('restoreCategory');
Route::get('/trash/remove2/{id}', 'Category\CategoryController@remove')->name('removeCategory');

// show Categories
Route::get('/categories', 'Category\CategoryController@show')->name('categories');

//create Categories
Route::post('/categories', 'Category\CategoryController@store')->name('createCategory');

//delete Category
Route::get('/categories/delete/{id}', 'Category\CategoryController@delete')->name('deleteCategory');

//edit & update Category
Route::get('/categories/edit/{id}', 'Category\CategoryController@edit')->name('editCategory');
Route::post('/categories/{id}', 'Category\CategoryController@update')->name('updateCategory');

// change language
Route::get('lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');

//show Hashtag
Route::get('/hashtag', 'Hashtag\HashtagController@show')->name('hashtag');
Route::get('/hashtag/{id}', 'Hashtag\HashtagController@wordtag')->name('wordtag');


// profile
Route::get('profile', 'Auth\ProfileController@index')->name('profile');
Route::get('profile/edit', 'Auth\ProfileController@edit')->name('editProfile');
Route::post('profile/update', 'Auth\ProfileController@update')->name('updateProfile');
