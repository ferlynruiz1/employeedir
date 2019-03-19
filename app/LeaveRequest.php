<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
