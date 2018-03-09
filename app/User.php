<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon; 

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    protected $table = "employee_info";
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

    public function scopeFullname($query)
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }
    public function scopePrettyBirthDate($query)
    {
        $dt = Carbon::parse($this->birth_date);
        return $dt->toFormattedDateString();
    }
    public function scopePrettydatehired($query)
    {
        $dt = Carbon::parse($this->hired_date);
        return $dt->toFormattedDateString();
    }
     public function scopeBirthDate($query)
    {
        $dt = Carbon::parse($this->birth_date);
        return $dt->format('m/d/Y');
    }
    public function scopeDateHired($query)
    {
        $dt = Carbon::parse($this->hired_date);
        return $dt->format('m/d/Y');
    }
    public function supervisor()
    {
        return $this->belongsTo('App\User', 'supervisor_id');
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
                # code...
                break;
        }
    }
}
