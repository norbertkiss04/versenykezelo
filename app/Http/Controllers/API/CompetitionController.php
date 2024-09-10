<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Competition;

class CompetitionController extends Controller
{
    public function renderCompetitionCards()
    {
        $competitions = Competition::with('round')->get();
        return view('components.competition-cards', compact('competitions'))->render();
    }

    private function isAdmin(Request $request)
    {
        return $request->header('X-User-Role') === 'admin';
    }

    public function newCompetition(Request $request)
    {
        if (!$this->isAdmin($request)) {
            return response()->json(['success' => false, 'message' => 'Only admins can create competitions'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:24',
            'year' => 'required|integer|min:0|max:2024',
            'prize_pool' => 'required|numeric|min:0|max:100000000',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Hiba történt validálás során'
            ], 403);
        }

        try {
            $competition = Competition::create([
                'name' => $request->input('name'),
                'year' => $request->input('year'),
                'prize_pool' => $request->input('prize_pool'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Competition created successfully',
            ], 201);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' =>  $e->getMessage(),
            ], 500);
        }
    }
}
