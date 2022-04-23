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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AboutUsController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\DiscordController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LogoController;
use App\Http\Controllers\Web\Mypage\BannerConfirmController;
use App\Http\Controllers\Web\Mypage\BannerController;
use App\Http\Controllers\Web\Mypage\BannerImageController;
use App\Http\Controllers\Web\Mypage\BlogController as MypageBlogController;
use App\Http\Controllers\Web\Mypage\DashboardController;
use App\Http\Controllers\Web\Mypage\PointController;
use App\Http\Controllers\Web\Mypage\PostController as MypagePostController;
use App\Http\Controllers\Web\Mypage\ProfileController as MypageProfileController;
use App\Http\Controllers\Web\Mypage\RoleController as MypageRoleController;
use App\Http\Controllers\Web\Mypage\TokenController as MypageTokenController;
use App\Http\Controllers\Web\Mypage\UserController as MypageUserController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\RecruitController;
use App\Http\Controllers\Web\ReleaseNewsController;
use App\Http\Controllers\Web\SlackController;
use App\Http\Controllers\Web\SponsorController;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Web\WeeklyBestController;

Auth::routes(['verify' => true]);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('login/{driver}', [LoginController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/', HomeController::class)->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::group(['middleware' => ['auth:web'], 'prefix' => 'mypage', 'as' => 'mypage.'], function () {
    Route::group(['middleware' => ['verified']], function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('users', MypageUserController::class);
        Route::patch('users/{user}/restore', [MypageUserController::class, 'restore'])->name('users.restore');
        Route::resource('roles', MypageRoleController::class);
        Route::resource('points', PointController::class);
        Route::post('tokens', [MypageTokenController::class, 'store'])->name('tokens.store');
        Route::delete('tokens/{id}', [MypageTokenController::class, 'delete'])->name('tokens.delete');

        Route::resource('blogs', MypageBlogController::class);
        Route::resource('posts', MypagePostController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('banners.images', BannerImageController::class);
        Route::post('banners/{banner}/confirm', [BannerConfirmController::class, 'store'])->name('banners.approve');
        Route::delete('banners/{banner}/confirm', [BannerConfirmController::class, 'destroy'])->name('banners.disapprove');
    });

    Route::get('profile', [MypageProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [MypageProfileController::class, 'update'])->name('profile.update');
});

Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
    Route::get('releases', ReleaseNewsController::class)->name('releases.index');
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

Route::patch('recruits/{recruit}/close', [RecruitController::class, 'close'])->name('recruits.close');

Route::patch('recruits/{recruit}/restore', [RecruitController::class, 'restore'])->name('recruits.restore');

Route::resource('slack', SlackController::class);

Route::get('discord', DiscordController::class)->name('discord');
