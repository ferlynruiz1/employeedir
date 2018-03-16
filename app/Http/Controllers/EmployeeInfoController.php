<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use App\EmployeeDepartment;
use App\ElinkAccount;
use App\User;

class EmployeeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create')->with('supervisors', User::all())->with('departments', EmployeeDepartment::all())->with('accounts', ElinkAccount::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new User();
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->alias = $request->alias;
        $employee->position_name = $request->position_name;
        $employee->supervisor_id = $request->supervisor_id;
        $employee->team_name = $request->team_name;
        $employee->gender = $request->gender_id;
        $employee->manager_id = $request->manager_id;
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;

        /* all access field */
        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }

        $datetime = new DateTime();
        $hired_date = $datetime->createFromFormat('m/d/Y', $request->hired_date)->format("Y-m-d H:i:s");
        $birth_date = $datetime->createFromFormat('m/d/Y', $request->birth_date)->format("Y-m-d H:i:s");
        $employee->hired_date = $hired_date;
        $employee->birth_date = $birth_date;
        $employee->email = $request->email;
        $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', '123qwe!@#$'));
        $employee->save();

        /* saving photo : TODO : optimize saving of image to save space */
        if ($request->hasFile("profile_image")) {
            $path = $request->profile_image->store('images/'.$employee->id);
            $employee->profile_img = asset('storage/app/'.$path);
            $employee->save();
        }

        return redirect('home')->with('success', "Successfully created Employee");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employee.view')->with('employee', User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employee.edit')->with('employee', User::find($id))->with('supervisors', User::all())->with('departments', EmployeeDepartment::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = User::find($id);
        $employee->eid = $request->eid;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->alias = $request->alias;
        $employee->team_name = $request->team_name;
        $employee->position_name = $request->position_name;
        $employee->supervisor_id = $request->supervisor_id;

        if ($request->has('gender_id')) {
            $employee->gender = $request->gender_id;
        }

        $employee->manager_id = $request->manager_id;
        $employee->account_id = $request->account_id;
        $employee->status = $request->status_id;

        if ($request->has('all_access')) {
            $employee->all_access = 1;
        } else {
            $employee->all_access = 0;
        }

        $datetime = new DateTime();
        $hired_date = $datetime->createFromFormat('m/d/Y', $request->hired_date)->format("Y-m-d H:i:s");
        $birth_date = $datetime->createFromFormat('m/d/Y', $request->birth_date)->format("Y-m-d H:i:s");
        $employee->hired_date = $hired_date;
        $employee->birth_date = $birth_date;

        if ($request->hasFile("profile_image")) {
            $path = $request->profile_image->store('images/'.$employee->id);
            $employee->profile_img = asset('storage/app/'.$path);
        }
        $employee->save();

        return redirect()->back()->with('success', "Successfully updated employee information");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::find($id);
        $employee->delete();

        return redirect()->back()->with('success', "Successfully deleted employee record");;
    }
    public function changepassword(Request $request, $id)
    {
        return view('employee.changepassword')->with('id', $id);
    }
    public function savepassword(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->new_password == "" && $request->old_password == "" && $request->confirm_password == "") {
            return redirect()->back()->withErrors(array('message' => 'all field are required!', 'status' => 'error'));
        }
        
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                if ($user->save()) {
                    return redirect()->back()->withErrors(array('message' => 'Password successfully changed!', 'status' => 'success'));
                } else {
                    return redirect()->back()->withErrors(array('message' => 'error saving !', 'status' => 'error'));
                }
            } else {
                return redirect()->back()->withErrors(array('message' => 'new password don\'t match', 'status' => 'error'));
            }
        } else {
            return redirect()->back()->withErrors(array('message' => 'incorrect old password', 'status' => 'error'));
        }
    }
    public function employees(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('employee.employees')->with('employees', User::all());
        }

        $employees = new User;
        if ($request->has('keyword')) {
            $employees = $employees->where('first_name', 'LIKE', '%'.$request->get('keyword').'%')->orWhere('last_name', 'LIKE', '%'.$request->get('keyword').'%');
        } else if($request->has('alphabet')) {
            $employees = $employees->where('last_name', 'LIKE', $request->get('alphabet').'%')->orWhere('first_name', 'LIKE', $request->get('alphabet').'%');
        }
        $employees = $employees->orderBy('last_name', 'ASC')->paginate(10);

        return view('guest.employees')->with('employees', $employees )->with('request', $request);
    }
    public function profile (Request $request, $id)
    {
        return view('auth.profile.view')->with('employee', User::find($id));
    }
    public function myprofile(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return view('employee.view')->with('employee', Auth::user());
        }
        return view('auth.profile.view')->with('employee', Auth::user());
    }
}