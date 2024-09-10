<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');

        if ($username == 'admin') {
            return response()->json(['success' => true, 'role' => 'admin']);
        }

        $userExists = DB::table('app_users')
            ->where('username', $username)
            ->exists();

        if (!$userExists) {
            return response()->json(['success' => false, 'message' => 'Nincs ilyen felhasználó']);
        }

        $isCompetitor = DB::table('competitors')
            ->join('app_users', 'competitors.user_id', '=', 'app_users.id')
            ->where('app_users.username', $username)
            ->exists();

        if ($isCompetitor) {
            return response()->json(['success' => false, 'message' => 'Versenyzo']);
        } else {
            return response()->json(['success' => true, 'role' => 'user']);
        }
    }
}
