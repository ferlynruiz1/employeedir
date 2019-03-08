<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;
use App\LeaveType;
use App\PayType;
use App\User;
use DateTime;
use App\Mail\LeaveNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_requests = LeaveRequest::whereHas('employee', function($query){
            $query->where('supervisor_id', '=', Auth::user()->id);
        })->orWhereHas('employee', function($query){
            $query->where('manager_id', '=', Auth::user()->id);
        })->where('approve_status_id', '=', 0)->get();

        if(Auth::user()->isAdmin()){
            return view('leave.index')->with('leave_requests', LeaveRequest::all());
        } else {
            return view('leave.index')
            ->with('leave_requests', $leave_requests);
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
        $leave->recommending_approval_by_id = Auth::user()->supervisor_id;
        $leave->approved_by_id = Auth::user()->manager_id;

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

        // SEND EMAIL NOTIFICATION
        // Mail::to("johnmanuelderecho@elink.com.ph")->send(new LeaveNotification($leave));

        return redirect("leave" . '/' . $leave->id)->with('success', 'Leave Request Successfully Submitted!!');
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

    public function recommend(Request $request){
        $leave_request = LeaveRequest::find($request->leave_id);
        $leave_request->recommending_approval_by_id = Auth::user()->id;
        $leave_request->recommending_approval_by_signed_date = date('Y-m-d H:i:s');

        // SEND EMAIL NOTIFICATION

        if($leave_request->save()){
            return back()->with('success', 'Leave request successfully recommended.');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function approve(Request $request){
        $leave_request = LeaveRequest::find($request->leave_id);
        $leave_request->approved_by_id = Auth::user()->id;
        $leave_request->approved_by_signed_date = date('Y-m-d H:i:s');
        $leave_request->approve_status_id = 1;

        // SEND EMAIL NOTIFICATION

        if($leave_request->save()){
            return back()->with('success', 'Leave request successfully approved.');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function noted(Request $request){
        $leave_request = LeaveRequest::find($request->leave_id);
        $leave_request->noted_by_id = Auth::user()->id;
        $leave_request->noted_by_signed_date = date('Y-m-d H:i:s');
        $leave_request->approve_status_id = 1;

        // SEND EMAIL NOTIFICATION

        if($leave_request->save()){
            return back()->with('success', 'Leave request successfully approved.');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }
}
