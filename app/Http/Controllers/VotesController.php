<?php

namespace App\Http\Controllers;

use App\Snippet;

class VotesController extends Controller
{
    /**
     * Store a new vote in the database.
     */
    public function store(Snippet $snippet)
    {
        $changes = auth()->user()->votes()->toggle($snippet);

        return response()->json([
            'count' => $snippet->votes->count(),
            'favourited' => (bool) count($changes['attached']),
        ]);
    }
}
