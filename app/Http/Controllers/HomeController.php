<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * HomeController Constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show "users" dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }
}
