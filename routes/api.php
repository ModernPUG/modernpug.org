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

Route::group(['as' => 'api.'], function () {
    Route::group(['as' => 'v1.', 'prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
        Route::resource('recruits', 'Api\V1\RecruitController');
        Route::get('posts', 'Api\V1\Posts\IndexController')->name('posts.index');
        Route::get('posts/weekly-best', 'Api\V1\Posts\WeeklyBestController')->name('posts.weekly-best');
    });
});
