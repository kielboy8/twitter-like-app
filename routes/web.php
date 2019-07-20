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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController')->except(['index', 'create', 'show', 'update', 'edit']);
Route::resource('users', 'UserController')->except(['index', 'create']);
Route::post('users/follow/{user_id}', 'FollowController@follow');
Route::post('users/unfollow/{user_id}', 'FollowController@unfollow');