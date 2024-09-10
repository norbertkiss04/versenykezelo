<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Round;

class RoundController extends Controller
{
    private function isAdmin(Request $request)
    {
        return $request->header('X-User-Role') === 'admin';
    }

    public function newRound(Request $request)
    {
        if (!$this->isAdmin($request)) {
            return response()->json(['success' => false, 'message' => 'Only admins can add rounds'], 403);
        }

        $validator = Validator::make($request->all(), [
            'competition_id' => 'required|exists:competitions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 403);
        }

        try {
            $totalRounds = Round::withTrashed()->where('competition_id', $request->input('competition_id'))->count();
            $nextRoundNumber = $totalRounds + 1;

            $round = Round::create([
                'competition_id' => $request->input('competition_id'),
                'round_number' => $nextRoundNumber,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'New round added successfully!',
                'round' => $round,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
