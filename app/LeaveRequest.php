<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $table = 'leave_request';

    public function employee(){
    	return $this->belongsTo('App\User', 'employee_id');
    }
}
