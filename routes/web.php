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

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\Mypage\BlogController as MypageBlogController;
use App\Http\Controllers\Mypage\DashboardController;
use App\Http\Controllers\Mypage\PostController as MypagePostController;
use App\Http\Controllers\Mypage\ProfileController as MypageProfileController;
use App\Http\Controllers\Mypage\RoleController as MypageRoleController;
use App\Http\Controllers\Mypage\UserController as MypageUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecruitController;
use App\Http\Controllers\ReleaseNewsController;
use App\Http\Controllers\SlackController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WeeklyBestController;

Auth::routes(['verify' => true]);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('login/{driver}', [LoginController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::group(['middleware' => ['auth:web'], 'prefix' => 'mypage', 'as' => 'mypage.'], function () {
    Route::group(['middleware' => ['verified']], function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('users', MypageUserController::class);
        Route::patch('users/{user}/restore', [MypageUserController::class, 'restore'])->name('users.restore');
        Route::resource('roles', MypageRoleController::class);

        Route::resource('blogs', MypageBlogController::class);
        Route::resource('posts', MypagePostController::class);
    });

    Route::get('profile', [MypageProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [MypageProfileController::class, 'update'])->name('profile.update');
});

Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
    Route::resource('releases', ReleaseNewsController::class);
});

Route::resource('blogs', BlogController::class);
Route::patch('blogs/{blog}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

Route::get('posts/search/{tag?}', [PostController::class, 'search'])->name('posts.search');
Route::get('posts/weekly-best/{weeklyBest?}', WeeklyBestController::class)->name('posts.weekly');
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::resource('posts', PostController::class);

Route::get('tags', TagController::class)->name('tags.index');

Route::get('aboutus', AboutUsController::class)->name('modernpug.aboutus');
Route::get('logos', LogoController::class)->name('modernpug.logo');

Route::get('sponsors', SponsorController::class)->name('sponsors.index');

Route::resource('recruits', RecruitController::class);
Route::patch('recruits/{recruit}/restore', [RecruitController::class, 'restore'])->name('recruits.restore');

Route::resource('slack', SlackController::class);
