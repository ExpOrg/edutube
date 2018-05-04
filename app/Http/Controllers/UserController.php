<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('users.profile');
    }
}
