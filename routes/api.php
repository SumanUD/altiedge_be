<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\EnrollmentController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{blog}', [BlogController::class, 'show']);
    Route::post('/', [BlogController::class, 'store']);
    Route::post('/{blog}', [BlogController::class, 'update']);
    Route::delete('/{blog}', [BlogController::class, 'destroy']);
});


Route::post('/contact', [ContactController::class, 'store']);
Route::get('/events', [EventController::class, 'apiIndex']);
Route::get('/events/{id}', [EventController::class, 'apiShow']);
Route::get('/programs', [ProgramController::class, 'apiIndex']);
Route::get('/programs/{id}', [ProgramController::class, 'apiShow']);
Route::post('/enroll', [EnrollmentController::class, 'store']);