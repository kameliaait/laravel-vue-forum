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

Route::get('/','TopicController@index')->name('topic.index');
Route::resource('topic','TopicController')->except(['index']);
Route::post('/comments/{topic}','CommentController@store')->name('comments.store');
Route::post('/commentReply/{comment}','CommentController@storeCommentReply')->name('comments.storeReply');
Route::post('/markedAsSolution/{topic}/{comment}','CommentController@markedAsSolution')->name('comments.markedAsSolution');
Route::get('showFromNotification/{topic}/{notification}','TopicController@showFromNotification')->name('topic.showFromNotification');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
