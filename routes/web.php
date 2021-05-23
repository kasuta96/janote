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
// Create note
Route::get('/note/create', 'Note\NoteController@create')->name('createNote');
Route::post('/note/store', 'Note\NoteController@store')->name('storeNote');
// delete Note
Route::get('/note/delete/{id}', 'Note\NoteController@delete')->name('deleteNote');
// Edit Note
Route::get('/note/edit/{id}', 'Note\NoteController@edit')->name('editNote');
Route::post('/note/update', 'Note\NoteController@update')->name('updateNote');
// Trash
Route::get('/trash/notes', 'Note\NoteController@trash')->name('trashNote');
Route::get('/trash/remove/{id}', 'Note\NoteController@remove')->name('removeNote');
Route::get('/trash/restore/{id}', 'Note\NoteController@restore')->name('restoreNote');


// show Categories
Route::get('/categories', 'Category\CategoryController@show')->name('categories');

// change language
Route::get('lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');
