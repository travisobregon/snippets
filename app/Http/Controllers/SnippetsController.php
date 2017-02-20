<?php

namespace App\Http\Controllers;

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
        $snippets = Snippet::with('user')->latest()->paginate(10);

        return view('snippets.index', compact('snippets'));
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
