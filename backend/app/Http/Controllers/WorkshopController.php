<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Carbon\Carbon;
class WorkshopController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'lien' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = Workshop::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'date' => $request->date,
            'lien' => $request->lien,
        ]);
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        }
        $event->image = $image;
        $event->save();
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
        $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
            'lien' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = Workshop::find($id);
        if ($event) {
            $event->nom = $request->nom;
            $event->description = $request->description;
            $event->date = $request->date;
            $event->lien = $request->lien;

            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('images', 'public');
                $event->image = $image;
            }

            $event->save();
            return response()->json($event, 200);
        } else {
            return response()->json(['message' => 'Event not found'], 404);
        }
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
