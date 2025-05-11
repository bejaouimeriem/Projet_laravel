<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ThematicController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Thematic Routes
Route::get('/thematics',[ThematicController::class,'getAllThematics']);
Route::get('/thematics/{id}',[ThematicController::class,'getThematicById']);
Route::post('/thematics',[ThematicController::class,'createThematic']);
Route::put('/thematics/{id}',[ThematicController::class,'updateThematic']);
Route::delete('/thematics/{id}',[ThematicController::class,'deleteThematic']);

Route::prefix('Utilisateur')->controller(UtilisateurController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::get('/getAll', 'getAll');
    Route::get('/get/{id}', 'get');
    Route::delete('/delete/{id}', 'delete');
    Route::delete('/deleteAll', 'deleteAll');
    Route::put('/update-profile/{id}', 'updateProfile');
    Route::post('/setPersonnalite', 'setPersonnalite');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password', 'resetPassword');
});

Route::group(['prefix'=>'/Feedback'],function(){
    Route::get('/getAll',[FeedbackController::class,'getAllFeedbacks']);
    Route::post('/create',[FeedbackController::class,'createFeedback']);
}); 

Route::prefix('WorkshopEvents')->group(function () {
    Route::post('/create', [WorkshopController::class, 'create']);
    Route::get('/get/{id}', [WorkshopController::class, 'get']);
    Route::get('/getAll', [WorkshopController::class, 'getAll']);
    Route::put('/update/{id}', [WorkshopController::class, 'update']);
    Route::delete('/delete/{id}', [WorkshopController::class, 'delete']);
    Route::delete('/deleteAll', [WorkshopController::class, 'deleteAll']);
    Route::delete('/deleteExpired', [WorkshopController::class, 'deleteExpired']);
});

Route::prefix('Quote')->group(function () {
    Route::post('/create', [QuoteController::class, 'create']);
    Route::get('/getAll', [QuoteController::class, 'getAll']);
    Route::get('/get/{id}', [QuoteController::class, 'get']);
    Route::put('/update/{id}', [QuoteController::class, 'update']);
    Route::delete('/delete/{id}', [QuoteController::class, 'delete']);
    Route::delete('/deleteAll', [QuoteController::class, 'deleteAll']);
    Route::get('/random', [QuoteController::class, 'random']);
});