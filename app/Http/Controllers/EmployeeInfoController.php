<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('profile.view')->with('employee',User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('profile.edit')->with('employee',User::find($id));

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changepassword(Request $request, $id){
        return view('profile.changepassword')->with('id', $id);
    }
    public function savepassword(Request $request, $id){

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


    public function changeinfo(Request $request){
        return "aw";
    }
}
