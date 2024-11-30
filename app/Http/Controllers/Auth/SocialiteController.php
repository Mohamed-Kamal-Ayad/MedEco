<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return abort(404);
    }
}
