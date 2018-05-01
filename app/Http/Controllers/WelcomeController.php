<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }
}
