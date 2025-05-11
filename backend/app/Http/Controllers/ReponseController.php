<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReponseController extends Controller
{
    /**
     * Create a new response
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'question_id' => 'required|exists:questions,id',
        ]);

        $question = Question::findOrFail($request->question_id);
        
        $reponse = new Reponse();
        $reponse->contenu = $request->contenu;
        $reponse->question()->associate($question);
        $reponse->save();

        return response()->json($reponse, Response::HTTP_CREATED);
    }

    /**
     * Delete a response by ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $reponse = Reponse::find($id);
        
        if (!$reponse) {
            return response()->json("Réponse non trouvée", Response::HTTP_NOT_FOUND);
        }
        
        $reponse->delete();
        return response()->json("Réponse supprimé avec succès!", Response::HTTP_OK);
    }

    /**
     * Get a response by ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        $reponse = Reponse::find($id);
        
        if (!$reponse) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }
        
        return response()->json($reponse);
    }

    /**
     * Get all responses
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $reponses = Reponse::all();
        return response()->json($reponses);
    }
    public function getByQuestion($questionId)
    {
        $reponses = Reponse::where('question_id', $questionId)->get();
        return response()->json($reponses);
    }

    /**
     * Update a response by ID
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'question_id' => 'required|exists:questions,id',
        ]);

        $reponse = Reponse::find($id);
        $question = Question::findOrFail($request->question_id);
        
        if (!$reponse) {
            // If not found, create a new one as per your Java logic
            $reponse = new Reponse();
        }
        
        $reponse->contenu = $request->contenu;
        $reponse->question()->associate($question);
        $reponse->save();
        
        return response()->json($reponse);
    }

    /**
     * Delete all responses
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll()
    {
        Reponse::truncate();
        return response()->json("Tous les réponses sont supprimés!");
    }
}