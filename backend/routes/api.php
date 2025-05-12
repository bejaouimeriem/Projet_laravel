<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ThematicController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\SousChapitreController;
use App\Http\Controllers\UserSousChapitreProgressController;
use App\Http\Controllers\PersonnaliteController;
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
    
    Route::get('/getAll', 'getAll');
    Route::get('/get/{id}', 'get');
    Route::delete('/delete/{id}', 'delete');
    Route::delete('/deleteAll', 'deleteAll');
    Route::put('/update-profile/{id}', 'updateProfile');
    Route::post('/setPersonnalite', 'setPersonnalite');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password', 'resetPassword');
});
Route::group(['prefix'=>'/Utilisateur'],function(){
    Route::post('/login',[UtilisateurController::class,'login']);
    Route::post('/register',[UtilisateurController::class,'register']);
}); 


//Feedback Routes
Route::group(['prefix'=>'/Feedback'],function(){
    Route::get('/getAll',[FeedbackController::class,'getAllFeedbacks']);
    Route::post('/create',[FeedbackController::class,'createFeedback']);
}); 

Route::prefix('Test')->group(function () {
    Route::post('/create', [TestController::class, 'create']);
    Route::delete('/delete/{id}', [TestController::class, 'delete']);
    Route::get('/get/{id}', [TestController::class, 'getTestById']);
    Route::get('/getTestUtilisable', [TestController::class, 'getTestUtilisable']);
    Route::get('/getAll', [TestController::class, 'getAll']);
    Route::put('/update/{id}', [TestController::class, 'update']);
    Route::delete('/deleteAll', [TestController::class, 'deleteAll']);
});

Route::prefix('Question')->group(function () {
    Route::post('/create', [QuestionController::class, 'create']);
    Route::delete('/delete/{id}', [QuestionController::class, 'delete']);
    Route::get('/get/{id}', [QuestionController::class, 'get']);
    Route::put('/update/{id}', [QuestionController::class, 'update']);
    Route::delete('/deleteAll', [QuestionController::class, 'deleteAll']);
    Route::post('/getQuestionsTest', [QuestionController::class, 'getQuestionsTest']);
});

Route::prefix('Reponse')->group(function () {
    Route::post('/create', [ReponseController::class, 'create']);
    Route::delete('/delete/{id}', [ReponseController::class, 'delete']);
    Route::get('/get/{id}', [ReponseController::class, 'get']);
    Route::get('/getAll', [ReponseController::class, 'getAll']);
    Route::put('/update/{id}', [ReponseController::class, 'update']);
    Route::delete('/deleteAll', [ReponseController::class, 'deleteAll']);
    Route::get('/getByQuestion/{questionId}', [ReponseController::class, 'getByQuestion']);
});
Route::get('/statistics', [StatisticsController::class, 'getStatistics']);

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
    Route::get('/getByChapitreId/{id}',[SousChapitreController::class,'getSousChapitres']);
    Route::delete('/delete/{id}',[SousChapitreController::class,'deleteSousChapitre']);
    Route::post('/createSousChapitre ',[SousChapitreController::class,'createSousChapitres']);
}); 

// UserSousChapitreProgress Routes
Route::group(['prefix'=>'/UserSousChapitreProgress'],function(){
    Route::post('/get/{id}',[UserSousChapitreProgressController::class,'createUserSousChapitreProgressIfNotExists']);
    Route::post('/getLastReadPage',[UserSousChapitreProgressController::class,'getLastReadPage']);
    Route::put('/setLastPageRead',[UserSousChapitreProgressController::class,'setLastPageRead']);
}); 

// Personnalite Routes
Route::post('/Personnalite/create', [PersonnaliteController::class, 'create']);
Route::delete('/Personnalite/delete/{id}', [PersonnaliteController::class, 'delete']);
Route::get('/Personnalite/get/{id}', [PersonnaliteController::class, 'get']);
Route::get('/Personnalite/getAll', [PersonnaliteController::class, 'getAll']);
Route::put('/Personnalite/update/{id}', [PersonnaliteController::class, 'update']);
Route::delete('/Personnalite/deleteAll', [PersonnaliteController::class, 'deleteAll']);
