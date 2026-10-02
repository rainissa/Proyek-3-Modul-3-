<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('activities', ActivityController::class);
Route::resource('categories', CategoryController::class)->only(['index', 'destroy']);
Route::post('activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::post('activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');