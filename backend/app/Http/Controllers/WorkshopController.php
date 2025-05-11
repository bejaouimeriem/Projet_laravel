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
        $event = Workshop::create($request->all());
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
        $event->update($request->all());
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
