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
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home',function(){
    return redirect('/');
});


Route::group(['middleware' => 'auth:web'], function () {

    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
});

Route::prefix('news/')->as('news.')->group(function () {
    Route::resource('releases','ReleaseNewsController');
});

Route::resource('blogs','BlogController');

Route::get('/posts/search/{tag?}', 'PostController@search')->name('posts.search');

Route::resource('posts','PostController');

Route::resource('tags','TagController');


Route::get('aboutus','AboutUsController@index')->name('modernpug.aboutus');
Route::get('logos','LogoController@index')->name('modernpug.logo');

Route::resource('sponsors','SponsorController');

Route::resource('recruit','RecruitController');

Route::resource('slack','SlackController');

