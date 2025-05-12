<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class WorkshopController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'lien' => 'nullable|url',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        $event = Workshop::create($validated);
        return response()->json($event, 201);
    }

    public function get($id)
    {
        $event = Workshop::findOrFail($id);
        return response()->json($event);
    }

    public function getAll()
    {
        return response()->json(Workshop::all());
    }

    public function update(Request $request, $id)
    {
        $event = Workshop::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'lien' => 'nullable|url',
            'image' => 'nullable', // Peut être un fichier ou un chemin
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Conserver l'image actuelle si aucune nouvelle image n'est envoyée
            $validated['image'] = $event->image;
        }

        $event->update($validated);
        return response()->json($event);
    }

    public function delete($id)
    {
        $event = Workshop::findOrFail($id);
        $event->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function deleteAll()
    {
        Workshop::truncate();
        return response()->json(['message' => 'All events deleted']);
    }

    public function deleteExpired()
    {
        $deleted = Workshop::where('date', '<', Carbon::now())->delete();
        return response()->json(['message' => "$deleted expired events deleted"]);
    }
}
