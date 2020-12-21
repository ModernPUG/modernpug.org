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
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::group(['middleware' => ['auth:web'], 'prefix'=>'mypage', 'as'=>'mypage.'], function () {
    Route::group(['middleware' => ['verified']], function () {
        Route::resource('dashboard', 'Mypage\DashboardController');
        Route::resource('users', 'Mypage\UserController');
        Route::patch('users/{user}/restore', 'Mypage\UserController@restore')->name('users.restore');
        Route::resource('roles', 'Mypage\RoleController');

        Route::resource('blogs', 'Mypage\BlogController');
        Route::resource('posts', 'Mypage\PostController');
    });

    Route::get('profile', 'Mypage\ProfileController@show')->name('profile.show');
    Route::put('profile', 'Mypage\ProfileController@update')->name('profile.update');
});

Route::group(['prefix'=>'news', 'as'=>'news.'], function () {
    Route::resource('releases', 'ReleaseNewsController');
});

Route::resource('blogs', 'BlogController');
Route::patch('blogs/{blog}/restore', 'BlogController@restore')->name('blogs.restore');

Route::get('posts/search/{tag?}', 'PostController@search')->name('posts.search');
Route::get('posts/weekly-best/{weeklyBest?}', 'WeeklyBestController')->name('posts.weekly');
Route::patch('posts/{post}/restore', 'PostController@restore')->name('posts.restore');
Route::resource('posts', 'PostController');

Route::get('tags', 'TagController@index')->name('tags.index');

Route::get('aboutus', 'AboutUsController@index')->name('modernpug.aboutus');
Route::get('logos', 'LogoController@index')->name('modernpug.logo');

Route::get('sponsors', 'SponsorController@index')->name('sponsors.index');

Route::resource('recruits', 'RecruitController');
Route::patch('recruits/{recruit}/restore', 'RecruitController@restore')->name('recruits.restore');

Route::resource('slack', 'SlackController');
