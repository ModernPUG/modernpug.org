<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\V1\Posts\IndexController as PostsIndexController;
use App\Http\Controllers\Api\V1\Posts\WeeklyBestController as PostsWeeklyBestController;
use App\Http\Controllers\Api\V1\RecruitController;

Route::group(['as' => 'api.'], function () {
    Route::group(['as' => 'v1.', 'prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
        Route::resource('recruits', RecruitController::class);
        Route::get('posts', PostsIndexController::class)->name('posts.index');
        Route::get('posts/weekly-best', PostsWeeklyBestController::class)->name('posts.weekly-best');
    });
});
