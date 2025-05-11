<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SousChapitre;

class SousChapitreController extends Controller
{
    public function updateSousChapitre($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'chapitre_id' => 'required|exists:chapitres,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $sousChapitre = SousChapitre::find($id);
        if ($sousChapitre) {
            $sousChapitre->lienVideo = $request->lienVideo;
            $sousChapitre->description = $request->description;
            $sousChapitre->title = $request->title;
            $sousChapitre->chapitre_id = $request->chapitre_id;

            $image = null;
            $pdf = null;
            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf')->store('pdfs', 'public');
                $sousChapitre->pdf = $pdf;
            }
            if($request->hasFile('image')) {
                $image = $request->file('image')->store('images', 'public');
                $sousChapitre->image = $image;
            }
            $sousChapitre->save();
            return response()->json($sousChapitre, 200);
        } else {
            return response()->json(['message' => 'Sous Chapitre not found'], 404);
        }
    }
}
