<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ThematicController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\SousChapitreController;
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

//Feedback Routes
Route::group(['prefix'=>'/Feedback'],function(){
    Route::get('/getAll',[FeedbackController::class,'getAllFeedbacks']);
    Route::post('/create',[FeedbackController::class,'createFeedback']);
}); 

//Chapitres Routes
Route::group(['prefix'=>'/chapitres'],function(){
    Route::get('/get/{id}',[ChapitreController::class,'getChapitresByThematic']);
    Route::delete('/delete/{id}',[ChapitreController::class,'deleteChapitre']);
    Route::post('/create',[ChapitreController::class,'addChapitre']);
    Route::post('/update/{id}',[ChapitreController::class,'updateChapitre']);
}); 
//SousChapitres Routes
Route::group(['prefix'=>'/SousChapitres'],function(){
    Route::post('/updateSousChapitre/{id}',[SousChapitreController::class,'updateSousChapitre']);
    Route::delete('/delete/{id}',[ChapitreController::class,'deleteChapitre']);
    Route::post('/create',[ChapitreController::class,'addChapitre']);
    Route::post('/update/{id}',[ChapitreController::class,'updateChapitre']);
}); 