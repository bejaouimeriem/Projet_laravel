<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Create a new test.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $test = Test::create($request->all());
        return response()->json($test);
    }

    /**
     * Delete a test by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Test::where('id', $id)->exists()) {
            Test::destroy($id);
            return response()->json(['message' => 'Test supprimé avec succès!']);
        }

        return response()->json(['message' => 'Test non trouvé!']);
    }

    /**
     * Get a test by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTestById($id)
    {
        $test = Test::find($id);

        if ($test) {
            return response()->json($test);
        }

        return response()->json(null);
    }

    /**
     * Get usable test.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTestUtilisable()
    {
        $test = Test::where('typeTest', 'personnalite')
            ->where('utilisable', 1)
            ->first();

        if ($test) {
            return response()->json($test);
        }

        return response()->json(['error' => 'لا يوجد أي اختبار متاح'], 404);
    }

    /**
     * Get all tests.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $tests = Test::all();
        return response()->json($tests);
    }

    /**
     * Update a test.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $test = Test::find($id);
        try {



            if ($test) {
                $test->nomTest = $request->nomTest;
                $test->typeTest = $request->typeTest;
                $test->utilisable = $request->utilisable;
                $test->save();

                return response()->json($test);
            }

            // If test not found, create a new one
            $test = Test::create($request->all());
            return response()->json($test);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete all tests.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(): \Illuminate\Http\JsonResponse
    {
        try {
            // This will trigger the deleting event on each test
            // which will cascade to questions and responses
            Test::all()->each(function ($test) {
                $test->delete();
            });

            return response()->json(['message' => 'Tous les tests sont supprimés!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}