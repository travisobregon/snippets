<?php

namespace App\Http\Controllers;

use App\Snippet;

class VotesController extends Controller
{
    /**
     * Store a new vote in the database.
     *
     * @return int
     */
    public function store(Snippet $snippet)
    {
        auth()->user()->votes()->toggle($snippet);

        return response()->json([
            'count' => $snippet->votes->count(),
        ]);
    }
}
