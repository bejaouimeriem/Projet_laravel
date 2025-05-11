<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quote;
class QuoteController extends Controller
{
    public function create(Request $request)
    {
        $quote = Quote::create($request->all());
        return response()->json($quote, 201);
    }

    public function getAll()
    {
        return response()->json(Quote::all());
    }

    public function get($id)
    {
        $quote = Quote::findOrFail($id);
        return response()->json($quote);
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $quote->update($request->all());
        return response()->json($quote);
    }

    public function delete($id)
    {
        Quote::destroy($id);
        return response()->json(['message' => 'تم حذف الاقتباس بنجاح']);
    }

    public function deleteAll()
    {
        Quote::truncate();
        return response()->json(['message' => 'تم حذف جميع الاقتباسات']);
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()->first();
        if ($quote) {
            return response()->json($quote);
        } else {
            return response()->noContent();
        }
    }
}
