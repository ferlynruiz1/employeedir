<?php

namespace App\Http\Controllers;

use App\Mail\ProbitionaryEmailNotificationA;
use App\Mail\ProbitionaryEmailNotificationB;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailReminderController extends Controller
{
    public function index()
    {
        $employees = User::where('is_regular', 0)->whereNull('deleted_at')->where('id', '<>', 1)->get();
        foreach($employees as $employee)
        {
                $hiredDate = Carbon::parse($employee->hired_date)->format('Y-m-d');
                // convert string date to object carbon
                $objectDate = Carbon::createFromFormat('Y-m-d', $hiredDate);
                $todayDate = now()->format('Y-m-d');
                
                $data = [
                    'emp_id' => $employee->id,
                    'emp_name' => strtoupper($employee->fullname()),
                    'date_hired' => Carbon::parse($employee->hired_date)->format('Y-m-d H:m'),
                ];

                $supervisors = User::select('email', 'email2', 'first_name', 'last_name')->get();
                $supervisorEmail = '';
                foreach($supervisors as $supervisor)
                {
                    if($supervisor->fullname() == $employee->supervisor_name || strtoupper($supervisor->fullname()) == strtoupper($employee->supervisor_name)){
                        $supervisorEmail = $supervisor->email ?? $supervisor->email2;
                    }else{
                        $supervisorEmail= 'hrd@elink.com.ph';
                    }
                }
    
                if($todayDate == $objectDate->addMonths(3)->format('Y-m-d'))
                {
                        $data['date'] =$objectDate->addMonths(3)->format('Y-m-d');
                        Mail::to($supervisorEmail)->cc($employee->email ?? $employee->email2)->send(new ProbitionaryEmailNotificationA($data));
                }elseif($todayDate == $objectDate->addMonths(5)->format('Y-m-d')){
                        $data['date'] =$objectDate->addMonths(5)->format('Y-m-d');
                       Mail::to($supervisorEmail)->cc($employee->email ?? $employee->email2)->send(new ProbitionaryEmailNotificationB($data));
                }
        }
    }
}