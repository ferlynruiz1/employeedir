<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.passwords.reset');
    }

    public function sample()
    {
        return view('auth.passwords.email_token');
    }
}
