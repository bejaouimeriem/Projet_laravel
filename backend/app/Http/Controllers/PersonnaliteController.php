<?php

namespace App\Http\Controllers;

use App\Models\Personnalite;
use Illuminate\Http\Request;

class PersonnaliteController extends Controller
{
    /**
     * Create a new personnalite
     */
    public function create(Request $request)
    {
        try{

        
        $validated = $request->validate([
            'nom' => 'required|string',
            'contenu' => 'required|string',
            'nomEnglish'=>'nullable|string',
            'icon' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        
        return Personnalite::create($validated);
        }catch(\Exception $e){
           return response()->json([
            'message' => 'حدث خطأ أثناء إنشاء الشخصية',
            'error' => $e->getMessage()
        ], 500);
        }
    }

    /**
     * Delete a personnalite by id
     */
    public function delete($id)
    {
        $personnalite = Personnalite::find($id);
        
        if ($personnalite) {
            $personnalite->delete();
            return response()->json(['message' => 'Personnalité supprimée avec succès!'], 200);
        }
        
        return response()->json(['message' => 'Personnalité non trouvée'], 404);
    }

    /**
     * Get a personnalite by id
     */
    public function get($id)
    {
        $personnalite = Personnalite::find($id);
        
        if ($personnalite) {
            return response()->json($personnalite, 200);
        }
        
        return response()->json(['message' => 'Personnalité non trouvée'], 404);
    }

    /**
     * Get all personnalites
     */
    public function getAll()
    {
        return Personnalite::all();
    }

    /**
     * Update a personnalite
     */
    public function update($id, Request $request)
    {
        $personnalite = Personnalite::find($id);
        
        if ($personnalite) {
            $validated = $request->validate([
                'nom' => 'required|string',
                'contenu' => 'required|string',
                // Add other validations as needed
            ]);
            
            $personnalite->nom = $validated['nom'];
            $personnalite->contenu = $validated['contenu'];
            $personnalite->save();
            
            return response()->json($personnalite, 200);
        }
        
        // If personnalite not found, create a new one
        return $this->create($request);
    }

    /**
     * Delete all personnalites
     */
    public function deleteAll()
    {
        Personnalite::truncate();
        return response()->json(['message' => 'Toutes les personnalités sont supprimées!'], 200);
    }
}