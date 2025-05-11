<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ThematicController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\StatisticsController;
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

