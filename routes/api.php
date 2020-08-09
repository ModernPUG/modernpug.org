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
    Route::group(['as' => 'v1.', 'prefix' => 'v1', 'middleware' => ['auth:api', 'scope:recruits']], function () {
        Route::resource('recruits', 'Api\V1\RecruitController');
        Route::get('posts/weekly-best', 'Api\V1\WeeklyBestController')->name('posts.weekly-best');
    });
});
