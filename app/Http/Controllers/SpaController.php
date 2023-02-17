<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaController extends Controller
{
    public function index()
    {
        /* dd(Auth::guard()); */
        return view('spa', [
            'auth_user' => Auth::user()
        ]);
    }
}
