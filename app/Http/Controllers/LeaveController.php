<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;
use App\LeaveType;
use App\PayType;
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
        if(Auth::user()->isAdmin()){
            return view('leave.index')->with('leave_requests', LeaveRequest::all());
        }
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

        $leave->employee_id = $request->employee_id;
        $leave->filed_by_id = Auth::user()->id;

        $leave->leave_date_from = $leave_date_from;
        $leave->leave_date_to =$leave_date_to;
        $leave->number_of_days = $request->number_of_days;
        $leave->report_date = $report_date;
        $leave->reason = $request->reason;
        $leave->contact_number = $request->contact_number;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->pay_type_id = $request->pay_type_id;
        $leave->date_filed = $date_filed;
        $leave->save();

        return back()->with('success', 'Leave Request Successfully Submitted!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave_request = LeaveRequest::with('employee')->find($id);

        return view('leave.show')->with('leave_request', $leave_request)->with('leave_types', LeaveType::all())->with('pay_types', PayType::all());
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
