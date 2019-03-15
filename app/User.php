<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon; 
use App\LeaveRequest;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    public $table = "employee_info";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function scopeAllExceptSuperAdmin($query){
        return $this->where('id', '<>', '1');
    }
    public function scopeFullname($query)
    {
        return $this->last_name .', '. $this->first_name;
    }

    public function scopeFullname2($query)
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function scopePrettyBirthDate($query)
    {
        if(isset($this->birth_date)){
            $dt = Carbon::parse($this->birth_date);
            return $dt->toFormattedDateString();
        }else{
            return "--";
        }
        
    }
    public function scopePrettydatehired($query)
    {
        if(isset($this->hired_date)){
            $dt = Carbon::parse($this->hired_date);
            return $dt->toFormattedDateString();
        } else {
            return "--";
        }
    }
    public function scopePrettyproddate($query)
    {
        if(isset($this->prod_date)){
            $dt = Carbon::parse($this->prod_date);
            return $dt->toFormattedDateString();
        } else {
            return "--";
        }
    }
    public function scopeProdDate($query)
    {
        if (isset($this->prod_date)) {
            $dt = Carbon::parse($this->prod_date);
            return $dt->format('m/d/Y');
        } else {
            return "";
        } 
    }
    public function scopeBirthDate($query)
    {
        if (isset($this->birth_date)) {
            $dt = Carbon::parse($this->birth_date);
            return $dt->format('m/d/Y');
        }else{
            return "";
        }
    }
    public function scopeDateHired($query)
    {
        if (isset($this->hired_date)) {
            $dt = Carbon::parse($this->hired_date);
            return $dt->format('m/d/Y');
        } else {
            return "";
        }
    }
    public function supervisor()
    {
        return $this->belongsTo('App\User', 'supervisor_id');
    }
    public function account(){
        return $this->belongsTo('App\ElinkAccount', 'account_id');
    }
    public function manager(){
        return $this->belongsTo('App\User', 'manager_id');
    }
    public function scopeStatus($query){
        switch ($this->status) {
            case 1:
                return "Active"; 
            case 2:
                return "Inactive";
            default:
                return "";
        }
    }
    public function scopeGender($query){
        switch ($this->gender) {
            case 1:
                return "Male"; 
            case 2:
                return "Female"; 
            case 3:
                return "Other"; 
            case 4:
                return "Prefer not to say"; 

            default:
                return "--";
        }
    }
    public function scopeIsAdmin($query){
        return $this->is_admin == 1;
    }
    public function scopeIsHR($query){
        return $this->is_hr == 1;
    }
    public function scopeIsERP($query){
        return $this->is_erp == 1;
    }
    public function scopeLeaveRequestCount(){
        return LeaveRequest::all()->count();
    }
}
