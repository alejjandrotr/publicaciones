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
    return view('login');
})->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate2');
Route::any('/logout', 'Auth\LoginController@logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/publicationsHola', 'PostController@holaAndAproved');
    Route::get('/home', 'PostController@seeAllPosts');
    Route::get('/post_{id}', 'PostController@seePost');
    Route::get('/add/comment', 'PostController@addComment');
});

