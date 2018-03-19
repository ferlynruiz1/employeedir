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
        if (Auth::user()->isAdmin()) {
            $user = User::with('supervisor')->orderBy('hired_date', 'DESC')->get();
            return view('dashboard')->with('employees', $user);
        } else {
            $employees = new User;
            if ($request->has('keyword')) {
                $employees = $employees->where('first_name', 'LIKE', '%'.$request->get('keyword').'%')->orWhere('last_name', 'LIKE', '%'.$request->get('keyword').'%');
            } else if ($request->has('alphabet')) {
                $employees = $employees->where('last_name', 'LIKE', $request->get('alphabet').'%')->orWhere('first_name', 'LIKE', $request->get('alphabet').'%');
            }
            $employees = $employees->orderBy('last_name', 'ASC')->paginate(10);

            return view('guest.employees')->with('employees', $employees)->with('request', $request);
        }
    }
    public function dashboard(Request $request)
    {
        return view('dashboard')->with('employees', User::orderBy('hired_date', 'DESC')->paginate(10));
    }

} 
