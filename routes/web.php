<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('activities/trash', [ActivityController::class, 'trash'])->name('activities.trash');
Route::post('activities/{activity}/restore', [ActivityController::class, 'restore'])->name('activities.restore')->withTrashed();
Route::resource('activities', ActivityController::class);
Route::resource('categories', CategoryController::class)->only(['index', 'destroy']);
Route::post('activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::post('activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');
Route::post('activities/{activity}/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
