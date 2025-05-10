<?php

use App\Http\Controllers\ThematicController;
use App\Models\Thematic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/thematics',[ThematicController::class,'getAllThematics']);
