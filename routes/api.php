<?php

use App\Http\Controllers\Api\FrontendApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', [FrontendApiController::class, 'home']);
Route::get('/company', [FrontendApiController::class, 'company']);
Route::get('/tours', [FrontendApiController::class, 'tours']);
Route::get('/tickets', [FrontendApiController::class, 'tickets']);
Route::get('/destinations', [FrontendApiController::class, 'destinations']);
Route::get('/destination/{slug}', [FrontendApiController::class, 'destination']);
Route::get('/category/{slug}', [FrontendApiController::class, 'category']);
Route::get('/tour/{slug}', [FrontendApiController::class, 'tour']);
Route::get('/tour/{slug}/reviews', [FrontendApiController::class, 'tourReviews']);
Route::post('/tour/{slug}/reviews', [FrontendApiController::class, 'submitReview']);
Route::get('/services', [FrontendApiController::class, 'services']);
Route::get('/service/{slug}', [FrontendApiController::class, 'serviceDetail']);
Route::get('/blogs', [FrontendApiController::class, 'blogs']);
Route::get('/blog/{slug}', [FrontendApiController::class, 'blogDetail']);
Route::get('/gallery', [FrontendApiController::class, 'gallery']);
Route::post('/contact', [FrontendApiController::class, 'contactSubmit']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
