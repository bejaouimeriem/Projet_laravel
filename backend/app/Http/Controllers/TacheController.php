<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class TacheController extends Controller
{
    /**
     * Create a new task.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'nomTache' => 'required|string',
            'done' => 'required|boolean',
            'date' => 'required|date',
            'userId' => 'required|exists:utilisateurs,id'
        ]);

        $user = Utilisateur::findOrFail($request->userId);

        $tache = Tache::create([
            'nomTache' => $request->nomTache,
            'done' => $request->done,
            'date' => $request->date,
            'user_id' => $user->id
        ]);

        return response()->json($tache, 201);
    }

    /**
     * Get all tasks for a user on a specific date.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function get(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $user = Utilisateur::findOrFail($id);
        $date = Carbon::parse($request->date)->toDateString();

        $taches = Tache::where('user_id', $user->id)
                      ->whereDate('date', $date)
                      ->get();

        return response()->json($taches);
    }

    /**
     * Update a task's status.
     *
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $request->validate([
            'done' => 'required|boolean'
        ]);

        $tache = Tache::findOrFail($id);
        $tache->update([
            'done' => $request->done
        ]);

        return response()->json($tache);
    }
}