<?php

namespace App\Http\Controllers;

use App\Models\Personnalite;
use Illuminate\Http\Request;

class PersonnaliteController extends Controller
{
    /**
     * Get a personnalite by id
     */
    public function get($id)
    {
        $personnalite = Personnalite::find($id)->load('criteres');
        
        if ($personnalite) {
            return response()->json($personnalite, 200);
        }
        
        return response()->json(['message' => 'Personnalité non trouvée'], 404);
    }

}