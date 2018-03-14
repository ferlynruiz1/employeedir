<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(Auth::user()->usertype == 1){
            $user = User::with('supervisor')->get();
            return view('dashboard')->with('employees', $user);
        }else{
            $user = User::with('supervisor')->paginate(10);
             return view('guest.employees')->with('employees', $user)->with('request', $request);
        }
    }
} 
