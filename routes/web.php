<?php


use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::get('dashboard.table.column', 'DashboardController@tableColumn');
    Route::get('dashboard.table.tasks', 'DashboardController@index');
});


Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)');