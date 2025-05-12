<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapitre;
use App\Models\UserSousChapitresProgress;

class ChapitreController extends Controller
{
    public function getChapitresByThematic($id)
    {
        $chapitres = Chapitre::where('thematic_id', $id)
            ->with('souschapitres')
            ->get();
        return response()->json($chapitres);
    }
    public function deleteChapitre($id)
    {
        $chapitre = Chapitre::find($id);
        if ($chapitre) {
            $chapitre->delete();
            return response()->json(['message' => 'تم حذف الفصل بنجاح'], 200);
        } else {
            return response()->json(['message' => 'لم يتم العثور على الفصل'], 404);
        }
    }
    public function addChapitre(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thematic_id' => 'required|exists:thematics,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $chapitre = Chapitre::create([
            'title' => $request->title,
            'description' => $request->description,
            'thematic_id' => $request->thematic_id,
            'pourcentage' => $request->pourcentage ?? 0,
        ]);
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        }
        $chapitre->image = $image;
        $chapitre->save();

        return response()->json($chapitre, 201);
    }
    public function updateChapitre($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thematic_id' => 'required|exists:thematics,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $chapitre = Chapitre::find($id);
        if ($chapitre) {
            $chapitre->title = $request->title;
            $chapitre->description = $request->description;
            $chapitre->thematic_id = $request->thematic_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('images', 'public');
                $chapitre->image = $image;
            }
            $chapitre->save();
            return response()->json($chapitre, 200);
        } else {
            return response()->json(['message' => 'لم يتم العثور على الفصل'], 404);
        }
    }

    public function getProgress(Request $request)
    {
        $userId = $request->input('userId');
        $chapitreId = $request->input('chapitreId');

        $chapitre = Chapitre::with('souschapitres')->findOrFail($chapitreId);
        $sousChapitres = $chapitre->souschapitres;

        if ($sousChapitres->isEmpty()) {
            $chapitre->pourcentage = 0;
            $chapitre->save();
            return response()->json(0);
        }

        $sousChapitreIds = $sousChapitres->pluck('id')->toArray();

        $progressList = UserSousChapitresProgress::where('user_id', $userId)
            ->whereIn('sous_chapitre_id', $sousChapitreIds)
            ->get();

        $sum = $progressList->sum('pourcentage');
        $average = floor($sum / count($sousChapitres));

        $chapitre->pourcentage = $average;
        $chapitre->save();

        return response()->json($average);
    }
}
