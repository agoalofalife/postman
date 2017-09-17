<?php


use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('users', 'DashboardController@listUsers');
});


Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)');