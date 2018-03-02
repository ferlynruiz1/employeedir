<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;
use DateTime;

class EmployeeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
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

        $datetime = new DateTime();
        $hired_date = $datetime->createFromFormat('m/d/Y',$request->hired_date)->format("Y-m-d H:i:s");
        $started_date = $datetime->createFromFormat('m/d/Y',$request->started_date)->format("Y-m-d H:i:s");

        $employee->hired_date = $hired_date;
        $employee->start_date = $started_date;
        $employee->email = $request->email;
        $employee->password = Hash::make(env('USER_DEFAULT_PASSWORD', '123qwe!@#$'));
        $employee->save();

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employee.view')->with('employee',User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employee.edit')->with('employee',User::find($id));
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
        // $employee->start_date = $request->started_date;
        // $employee->hired_date = $request->hired_date;
        $employee->username = $request->username;
        $employee->update();

        return redirect()->back();
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

        return redirect()->back();
    }
    public function changepassword(Request $request, $id){
        return view('employee.changepassword')->with('id', $id);
    }
    public function savepassword(Request $request, $id)
    {
        $user = User::find($id);
        if($request->new_password == "" && $request->old_password == "" && $request->confirm_password == ""){
            return redirect()->back()->withErrors(array('message' => 'all field are required!', 'status' => 'error'));
        }
        
        if (Hash::check($request->old_password, $user->password)) {
            if($request->new_password == $request->confirm_password){
                $user->password = Hash::make($request->new_password);
                if($user->save()){
                    return redirect()->back()->withErrors(array('message' => 'Password successfully changed!', 'status' => 'success'));
                }else{
                    return redirect()->back()->withErrors(array('message' => 'error saving !', 'status' => 'error'));
                }
            }else{
                return redirect()->back()->withErrors(array('message' => 'new password don\'t match', 'status' => 'error'));
            }
        }else{
            return redirect()->back()->withErrors(array('message' => 'incorrect old password', 'status' => 'error'));
        }
    }
}
