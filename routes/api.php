<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PageCMSController;
use App\Http\Controllers\Api\FaqController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/blogs', [BlogController::class, 'apiIndex']);
Route::get('/blogs/{id?}', [BlogController::class, 'apiIndex']);

Route::post('/contact', [ContactController::class, 'store']);
Route::get('/events', [EventController::class, 'apiIndex']);
Route::get('/events/{id}', [EventController::class, 'apiShow']);
Route::get('/programs', [ProgramController::class, 'apiIndex']);
Route::get('/programs/{id}', [ProgramController::class, 'apiShow']);
Route::post('/enroll', [EnrollmentController::class, 'store']);


Route::get('/pages/{page_name}', [PageCMSController::class, 'getPageData']);
Route::post('/pages/update', [PageCMSController::class, 'updateSection']);
Route::post('/pages/repeat/store', [PageCMSController::class, 'storeRepeat']);
Route::delete('/pages/repeat/{id}', [PageCMSController::class, 'deleteRepeat']);

Route::get('/faqs', [App\Http\Controllers\FaqController::class, 'apiIndex']);

