<?php

namespace App\Http\Controllers;

use App\Models\Thematic;
use Illuminate\Http\Request;

class ThematicController extends Controller
{
    public function getAllThematics(){
        $thematics = Thematic::all();
        return response()->json([ 'thematics' => $thematics]);
    }
}
