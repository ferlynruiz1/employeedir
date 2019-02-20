<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('leave/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create')->with('employees', User::AllExceptSuperAdmin()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = new LeaveRequest();

        $datetime = new DateTime();
        $leave_date_from = $datetime->createFromFormat('m/d/Y', $request->leave_date_from)->format("Y-m-d H:i:s");
        $leave_date_to = $datetime->createFromFormat('m/d/Y', $request->leave_date_to)->format("Y-m-d H:i:s");
        $report_date = $datetime->createFromFormat('m/d/Y', $request->report_date)->format("Y-m-d H:i:s");
        $date_filed = $datetime->createFromFormat('m/d/Y', $request->date_filed)->format("Y-m-d H:i:s");

        $leave->employee_id = Auth::user()->id;
        $leave->file_by_id = Auth::user()->id;

        $leave->leave_date_from = $leave_date_from;
        $leave->leave_date_to =$leave_date_to;
        $leave->number_of_days = $request->number_of_days;
        $leave->report_date = $report_date;
        $leave->reason = $request->reason;
        $leave->contact_number = $request->contact_number;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->pay_type_id = $request->pay_type_id;
        $leave->date_filed = now();
        $leave->save();

        return back()->with('message', 'Leave Request Successfully Submitted!!');
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
}
