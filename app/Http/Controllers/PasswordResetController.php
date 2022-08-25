<?php

namespace App\Http\Controllers;

use App\User;
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
    
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $employee = User::where('email', $request->email)->get();

        if(count($employee) > 1){
            $employee = User::where('email2', $request->email)->get();
        }

        if(!$employee){
            return back()->withErrors(['email'=> "Email doesn't exist in our record"]);
        }

    }
}
