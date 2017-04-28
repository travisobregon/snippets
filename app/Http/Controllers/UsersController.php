<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a single user.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        $user->load('snippets');

        return view('users.show', compact('user'));
    }
}
