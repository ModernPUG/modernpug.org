<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('pages.index');
    });

    Route::get('about', function () {
        return redirect('wiki/modernpug');
    });
});
