<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSousChapitresProgress;

class UserSousChapitreProgressController extends Controller
{
    public function createUserSousChapitreProgressIfNotExists($id, Request $request)
    {
        $sousChapitreIds = $request->input('sousChapitreIds');

        foreach ($sousChapitreIds as $sousChapitreId) {
            $existing = UserSousChapitresProgress::where('user_id', $id)
                ->where('sous_chapitre_id', $sousChapitreId)
                ->first();

            if (!$existing) {
                UserSousChapitresProgress::create([
                    'user_id' => $id,
                    'sous_chapitre_id' => $sousChapitreId,
                    'pourcentage' => 0,
                    'lastPageRead' => 1,
                ]);
            }
        }

        // Retourner la liste complète après insertion des manquants
        return UserSousChapitresProgress::where('user_id', $id)
            ->whereIn('sous_chapitre_id', $sousChapitreIds)
            ->get();
    }

    public function getLastReadPage(Request $request)
    {
        $userId = $request->input('userId');
        $sousChapitreId = $request->input('sousChapitreId');

        $progress = UserSousChapitresProgress::where('user_id', $userId)
            ->where('sous_chapitre_id', $sousChapitreId)
            ->first();

        return response()->json($progress);
    }

    public function setLastPageRead(Request $request)
    {
        $userId = $request->input('userId');
        $sousChapitreId = $request->input('sousChapitreId');
        $lastPageRead = $request->input('lastPageRead');
        $pourcentage = $request->input('pourcentage');

        $progress = UserSousChapitresProgress::where('user_id', $userId)
            ->where('sous_chapitre_id', $sousChapitreId)
            ->first();
        
        if ($progress) {
            $progress->user_id = $userId;
            $progress->sous_chapitre_id = $sousChapitreId;
            $progress->pourcentage = $pourcentage;
            $progress->lastPageRead = $lastPageRead;
            $progress->save();
            return response()->json(['message' => 'تمت قراءة الصفحة الأخيرة بنجاح']);
        }
        else{
            return response()->json(['message' => 'لم يتم العثور على التقدم'], 404);
        }
        
    }
}
