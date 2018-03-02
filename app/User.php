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
    public function scopePrettydatestarted($query)
    {
        $dt = Carbon::parse($this->started_date);
        return $dt->toFormattedDateString();
    }
    public function scopePrettydatehired($query)
    {
        $dt = Carbon::parse($this->hired_date);
        return $dt->toFormattedDateString();
    }
    public function supervisor()
    {
        return $this->belongsTo('App\User', 'supervisor_id');
    }
}
