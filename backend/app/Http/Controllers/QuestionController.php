<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Create a new question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{

        
        $validated = $request->validate([
            'contenu' => 'required|string',
            'test_id' => 'required|exists:tests,id',
        ]);

        $question = Question::create([
            'contenu' => $request->contenu,
            'test_id' => $request->test_id,
        ]);

        return response()->json($question, 201);
        }catch(\Exception $e){
           return response()->json([
            'message' => 'حدث خطأ أثناء إنشاء الشخصية',
            'error' => $e->getMessage()
        ], 500);
        }
    }

    /**
     * Delete a question by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {


            $question = Question::find($id);

            if (!$question) {
                return response()->json(['message' => 'Question non trouvé!'], 404);
            }

            $question->delete();
            return response()->json(['message' => 'Question supprimé avec succès!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la suppression de la question!'], 500);

        }
    }

    /**
     * Get a question by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $question = Question::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question non trouvé!'], 404);
        }

        return response()->json($question);
    }

    /**
     * Update a question by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'contenu' => 'required|string',
            'test_id' => 'required|exists:tests,id',
        ]);

        $question = Question::find($id);

        if (!$question) {
            // If question doesn't exist, create a new one (similar to Java service's behavior)
            $question = Question::create([
                'contenu' => $request->contenu,
                'test_id' => $request->test_id,
            ]);

            return response()->json($question, 201);
        }

        // Update existing question
        $question->update([
            'contenu' => $request->contenu,
            'test_id' => $request->test_id,
        ]);

        return response()->json($question);
    }

    /**
     * Delete all questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        Question::all()->each(function ($question) {
            $question->delete();
        });
        return response()->json(['message' => 'Tous les questions sont supprimés!']);
    }

    /**
     * Get all questions for a test.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getQuestionsTest(Request $request)
{
    try {
        // Validate the request
        $validated = $request->validate([
            'id' => 'required|exists:tests,id'
        ]);
        
        $testId = $request->id;
        
        // Get questions for this test
        $questions = Question::where('test_id', $testId)->get();
        
        // Return questions (even if empty array)
        return response()->json($questions);
    }
    catch(\Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
}