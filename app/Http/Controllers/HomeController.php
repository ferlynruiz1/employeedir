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
            return redirect('dashboard');
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
        return view('dashboard')->with('new_hires', User::orderBy('prod_date', 'DESC')->paginate(5))->with('employees', User::all());
    }
} 
