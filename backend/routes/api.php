<?php

use App\Http\Controllers\ThematicController;
use App\Http\Controllers\UtilisateurController;
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

Route::group(['prefix'=>'/Utilisateur'],function(){
    Route::post('/login',[UtilisateurController::class,'login']);
    Route::post('/register',[UtilisateurController::class,'register']);
}); 
