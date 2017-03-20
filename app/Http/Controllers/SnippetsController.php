<?php

namespace App\Http\Controllers;

use DB;
use App\Snippet;

class SnippetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all of the snippets.
     * 
     * @return \Response
     */
    public function index()
    {
        $snippets = Snippet::with('user')->latest()->paginate(5);
        $topUsers = DB::table('snippets_votes')
                        ->join('snippets', 'snippets.id', '=', 'snippets_votes.snippet_id')
                        ->join('users', 'users.id', '=', 'snippets.user_id')
                        ->select(DB::raw('count(*) as votes, name, username'))
                        ->groupBy('snippets.user_id')
                        ->orderBy('votes', 'desc')
                        ->limit(10)
                        ->get();

        return view('snippets.index', compact('snippets', 'topUsers'));
    }

    /**
     * Show a page to create a new snippet.
     * 
     * @param  Snippet $snippet
     * @return \Response
     */
    public function create(Snippet $snippet)
    {
        return view('snippets.create', compact('snippet'));
    }

    /**
     * Show a single snippet.
     * 
     * @param  Snippet $snippet 
     * @return \Response         
     */
    public function show(Snippet $snippet)
    {
        $snippet->load('forks');

        return view('snippets.show', compact('snippet'));
    }

    /**
     * Store a new snippet in the database.
     * 
     * @return \RedirectResponse
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        $data = request()->only(['title', 'body', 'forked_id']);
        $data['user_id'] = auth()->user()->id;
        
        Snippet::create($data);

        return redirect()->home();
    }
}
