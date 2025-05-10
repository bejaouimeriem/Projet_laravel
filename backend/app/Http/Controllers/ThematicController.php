<?php

namespace App\Http\Controllers;

use App\Models\Thematic;
use Illuminate\Http\Request;

class ThematicController extends Controller
{
    public function getAllThematics(){
        $thematics = Thematic::all();
        return response()->json( $thematics);
    }
    public function getThematicById($id){
        $thematic = Thematic::find($id);
        if ($thematic) {
            return response()->json($thematic);
        } else {
            return response()->json(['message' => 'Thematic not found'], 404);
        }
    }
    public function createThematic(Request $request){
        $thematic = Thematic::create([
            'nom' => $request->nom
        ]);
        return response()->json($thematic);
    }
    public function updateThematic(Request $request, $id){
        $thematic = Thematic::find($id);
        if ($thematic) {
            $thematic->update([
                'nom' => $request->nom
            ]);
            $thematic->save();
            return response()->json($thematic);
        } else {
            return response()->json(['message' => 'لم يتم العثور على الموضوع'], 404);
        }
    }
    public function deleteThematic($id){
        $thematic = Thematic::find($id);
        if ($thematic) {
            $thematic->delete();
            return response()->json(['message' => 'تم حذف الموضوع بنجاح']);
        } else {
            return response()->json(['message' => 'لم يتم العثور على الموضوع'], 404);
        }
    }
}
