<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TopUsersController extends Controller
{
    /**
     * List all of the top users.
     */
    public function index() {
        $topUsers = DB::table('snippets_votes')
            ->join('snippets', 'snippets.id', '=', 'snippets_votes.snippet_id')
            ->join('users', 'users.id', '=', 'snippets.user_id')
            ->select(DB::raw('count(*) as votes, name, username'))
            ->groupBy('snippets.user_id')
            ->orderBy('votes', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'topUsers' => $topUsers,
        ]);
    }   
}
