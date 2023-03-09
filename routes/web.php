<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
Route::post('/posts', 'App\Http\Controllers\PostController@store')->name('posts.store');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('posts.edit');
Route::put('/posts/{post}', 'App\Http\Controllers\PostController@update')->name('posts.update');
Route::delete('/posts/{post}', 'App\Http\Controllers\PostController@destroy')->name('posts.destroy');

Route::post('/posts/{post}/comments', 'App\Http\Controllers\CommentController@store')->name('comments.store');
Route::delete('/comments/{comment}', 'App\Http\Controllers\CommentController@destroy')->name('comments.destroy');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
