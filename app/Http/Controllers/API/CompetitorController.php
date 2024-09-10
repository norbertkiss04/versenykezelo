<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Competitor;
use App\Models\AppUser;
use App\Models\Round;
use Illuminate\Support\Facades\Validator;

class CompetitorController extends Controller
{
    public function getCompetitors($roundId)
    {
        $competitors = DB::table('competitors')
            ->join('app_users', 'competitors.user_id', '=', 'app_users.id')
            ->where('competitors.round_id', $roundId)
            ->select('app_users.id', 'app_users.username')
            ->get();

        return response()->json($competitors);
    }
    public function getAvailableUsers($roundId)
    {
        $usedUserIds = DB::table('competitors')
            ->where('competitors.round_id', $roundId)
            ->pluck('user_id');

        $availableUsers = AppUser::whereNotIn('id', $usedUserIds)
            ->select('id', 'username')
            ->get();

        return response()->json($availableUsers);
    }

    public function addCompetitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'round_id' => 'required|exists:rounds,id',
            'user_id'  => 'required|exists:app_users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid input'], 400);
        }

        Competitor::create([
            'round_id' => $request->input('round_id'),
            'user_id'  => $request->input('user_id')
        ]);

        return response()->json(['success' => true, 'message' => 'Competitor added successfully'], 201);
    }

    public function removeCompetitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'round_id' => 'required|exists:rounds,id',
            'user_id'  => 'required|exists:app_users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid input'], 400);
        }

        DB::table('competitors')
            ->where('round_id', $request->input('round_id'))
            ->where('user_id', $request->input('user_id'))
            ->delete();

        return response()->json(['success' => true, 'message' => 'Competitor removed successfully'], 200);
    }
}
