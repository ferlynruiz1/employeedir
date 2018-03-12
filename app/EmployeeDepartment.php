<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    protected $table = "employee_department";

    public function manager(){
    	return $this->belongsTo('App\User', 'manager_id');
    }
    public function division(){
    	return $this->belongsTo('App\ElinkDivision', 'division_id');
    }
    public function account(){
    	return $this->belongsTo('App\ElinkAccount', 'account_id');
    }
}
