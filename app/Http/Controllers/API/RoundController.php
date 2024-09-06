<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Round;

class RoundController extends Controller
{
    public function newRound(Request $request)
    {
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
            $round = Round::create([
                'competition_id' => $request->input('competition_id'),
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
