<?php

use App\Notifications\FollowNotification;

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
// Route::get('/', function () {
//     $user = App\User::first();
//     $user->notify(new FollowNotification);
//     return 'Done';
// });

Route::resource('posts', 'PostController')->except(['index', 'create', 'show', 'update', 'edit']);
Route::resource('users', 'UserController')->except(['index', 'create', 'store', 'destroy']);
Route::post('users/follow/{user_id}', 'FollowController@follow');
Route::post('users/unfollow/{user_id}', 'FollowController@unfollow');
Route::get('/notifications', 'NotificationController@index');