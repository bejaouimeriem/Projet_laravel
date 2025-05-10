<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function getAllFeedbacks()
    {
        $feedbacks = Feedback::all();
        return response()->json($feedbacks, 200);
    }
    public function createFeedback(Request $request)
    {
        if(!$request->has('message')) {
            return response()->json('Message is required', 400);
        }
        $feedback = Feedback::create([
            'message' => $request->message,
        ]);
        if($request->has('utilisateurId')) {
            $feedback->utilisateur_id = $request->utilisateurId;
            $feedback->save();
        }

        return response()->json($feedback, 201);
    }
}
