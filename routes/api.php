<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', App\Http\Controllers\Post\IndexController::class);
    Route::post('/', App\Http\Controllers\Post\StoreController::class);
    Route::get('/{post}', App\Http\Controllers\Post\ShowController::class);
    Route::patch('/{post}', App\Http\Controllers\Post\UpdateController::class);
});

Route::group(['prefix' => 'docs'], function () {
    Route::get('/', App\Http\Controllers\Doc\IndexController::class);
    Route::post('/', App\Http\Controllers\Doc\StoreController::class);
    Route::get('/{doc}', App\Http\Controllers\Doc\ShowController::class);
    Route::patch('/{doc}', App\Http\Controllers\Doc\UpdateController::class);
    Route::delete('/{doc}', App\Http\Controllers\Doc\DestroyController::class);
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', App\Http\Controllers\Comment\IndexController::class);
    Route::post('/', App\Http\Controllers\Comment\StoreController::class);
    Route::get('/{comment}', App\Http\Controllers\Comment\ShowController::class);
    Route::patch('/{comment}', App\Http\Controllers\Comment\UpdateController::class);
    Route::delete('/{comment}', App\Http\Controllers\Comment\DestroyController::class);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', App\Http\Controllers\Category\IndexController::class);
    Route::get('/{category}', App\Http\Controllers\Category\ShowController::class);
});

Route::group(['prefix' => 'departments'], function () {
    Route::get('/', App\Http\Controllers\Department\IndexController::class);
    Route::get('/{department}', App\Http\Controllers\Department\ShowController::class);
});

Route::group(['prefix' => 'likes'], function () {
    Route::post('/', App\Http\Controllers\Like\StoreController::class);
});

Route::group(['prefix' => 'views'], function () {
    Route::post('/', App\Http\Controllers\View\StoreController::class);
});

Route::group(['prefix' => 'downloads'], function () {
    Route::post('/', App\Http\Controllers\Download\StoreController::class);
});

