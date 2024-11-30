<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the specific page.
     * 
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        return view('pages.show', compact('type'));
    }
}
