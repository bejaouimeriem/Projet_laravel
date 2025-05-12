<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

Route::get('/pdf/{filename}', function ($filename, Request $request) {
    $path = storage_path('app/public/pdfs/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Access-Control-Allow-Origin' => $request->header('Origin', '*'),
    ]);
});

