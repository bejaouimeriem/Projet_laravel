<?php

namespace App\Http\Controllers;

use App\Models\AgendaPage;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class AgendaPageController extends Controller
{
    /**
     * Get all agenda pages for a specific user
     *
     * @param int $id User ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPages($id)
    {
        $pages = AgendaPage::where('utilisateur_id', $id)
                           ->orderBy('pageNumber')
                           ->get();
                           
        return response()->json($pages);
    }

    /**
     * Save a new agenda page or update an existing one
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePage(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'pageNumber' => 'required|integer',
            'leftContent' => 'nullable|string',
            'rightContent' => 'nullable|string',
            'utilisateurId' => 'required|integer|exists:utilisateurs,id',
        ]);

        $utilisateur = Utilisateur::findOrFail($request->utilisateurId);
        
        $page = $request->id ? AgendaPage::findOrFail($request->id) : new AgendaPage();
        
        $page->pageNumber = $request->pageNumber;
        $page->leftContent = $request->leftContent;
        $page->rightContent = $request->rightContent;
        $page->utilisateur_id = $utilisateur->id;
        
        $page->save();
        
        return response()->json($page);
    }

    /**
     * Delete an agenda page
     *
     * @param int $id Page ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePage($id)
    {
        $page = AgendaPage::findOrFail($id);
        $page->delete();
        
        return response()->json(['message' => 'Page deleted successfully']);
    }
}