<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/feed/new', 'NewFeedController@index')->name('feed.new');
Route::post('/feed/new', 'NewFeedController@save')->name('feed.new.save');

Route::get('/feed/{id}', 'FeedController@feed')->name('feed.show');
