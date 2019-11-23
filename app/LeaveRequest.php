<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Valuestore\Valuestore;

class LeaveRequest extends Model
{
    protected $table = 'leave_request';

    public function employee(){
    	return $this->belongsTo('App\User', 'employee_id');
    }

    public function leave_type(){
    	return $this->belongsTo('App\LeaveType');
    }

    public function pay_type(){
    	return $this->belongsTo('App\PayType');
    }

    public function scopeUnapproved($query){
        return $query->where('approve_status_id', '=', 0)->orWhereNull('approve_status_id');
    }

    public function recipients(){
        $settings = Valuestore::make(storage_path('app/settings.json'));

        $main_recipients = json_decode($settings->get('leave_email_main_recipients'));
        $business_leaders = json_decode($settings->get('business_leaders'));

        $email_recipients = [];
        $business_leader_emails = [];

        if ($main_recipients != NULL){
            foreach ($main_recipients as $key => $email) {
                array_push($email_recipients, $email->value);
            }
        }
        if ($business_leaders != NULL){
            foreach ($business_leaders as $key => $email) {
                array_push($business_leader_emails, $email->value);
            }
        }

        // GET SUPERVISOR AND MANAGER EMAILS
        $supervisor_recipient = $this->employee->supervisor_email();
        $manager_recipient = $this->employee->manager_email();

        if ($this->employee->isManager() || $this->employee->isBusinessLeader()){
            array_push($email_recipients, $this->employee->generalManager()->email);
        } else if ($this->employee->isSupervisor()) {
            array_push($email_recipients, $this->employee->generalManager()->email);
            array_push($email_recipients, $manager_recipient);
        } else if ($this->employee->isRankAndFile()){
            array_push($email_recipients, $supervisor_recipient);
            array_push($email_recipients, $manager_recipient);
        } 
        return array_values(array_filter(array_unique($email_recipients)));
    }

    public function scopeManagedBy($query, $user){
        $id = $user->id;
        $query->whereHas('employee', function($q) use ($id){
            $q->where('supervisor_id', '=',$id);
        })->orWhereHas('employee', function($q) use ($id){
            $q->where('manager_id', '=',$id);
        });
    }

    public function scopeStatus(){
        if($this->approve_status == 1){
            return "Approved";
        } else if($this->approved_by_signed_date != NULL){
            return "Approved";
        } else if($this->noted_by_signed_date != NULL){
            return "Approved";
        } else if($this->recommending_approval_by_signed_date != NULL){
            return "Recommended";
        } else {
            return "Not yet approved";
        }
    }
    public function getApprovalStatus(){
        if($this->approve_status_id == 0){
            return '<span class="fa fa-refresh"></span> Waiting for response';
        } else if($this->approve_status_id == 1){
            return '<span class="fa fa-check" style="color: green"></span> Approved';
        } else if($this->approve_status_id == 2){
            return '<span class="fa fa-thumbs-down" style="color: darkred"></span> Declined<br>Reason for disapproval: ' . $this->reason_for_disapproval;
        }
        return 'Waiting for response';
    }
    public function scopeLeaveDays(){
        if($this->number_of_days == 0.5){
            return "half day";
        } else if($this->number_of_days % 1 == 0.5){
            if((int)$this->number_of_days == 1){
                return (int)$this->number_of_days . ' day and a half days';
            }
            return (int)$this->number_of_days . ' days and a half days';
        } else if((int)$this->number_of_days == 1){
            return (int)$this->number_of_days . ' day';
        }
        else {
             return (int)$this->number_of_days . ' days';
        }
    }

    public function scopeIsForRecommend(){
        return (Auth::user()->id == $this->employee->supervisor_id) && ($this->recommending_approval_by_signed_date == NULL && $this->approve_status_id != 2) || Auth::user()->isAdmin();
    }

    public function scopeIsForApproval(){
        return (Auth::user()->id == $this->employee->manager_id) && ($this->approved_by_signed_date == NULL && $this->approve_status_id != 2) || Auth::user()->isAdmin();
    }

    public function scopeIsForNoted(){
        return Auth::user()->isHR() && ($this->noted_by_signed_date == NULL && $this->approve_status_id != 2) || Auth::user()->isAdmin();
    }

    public function scopeCanBeDeclined(){
        return ($this->isForRecommend() || $this->isForApproval() || $this->isForNoted()) && $this->approve_status_id != 2 || Auth::user()->isAdmin();
    }

    
}
