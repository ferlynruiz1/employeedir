@extends('layouts.main')
@section('title')
View Profile
@endsection
@section('pagetitle')
Employee Information
@endsection
@section('content')
<style type="text/css">
    .card-title {
        font-size: 16px;
        line-height: 21px;
        margin-top: 15px;
        font-weight: 400;
        color: black;
    }
    .card-subtitle{
        font-size: 12px;
        color: #878;
    }
    .label-profile{
        padding-left: 15px; padding-right: 15px;
    }
    .employee-details-value{
        font-size: 16px;
        line-height: 21px;
        padding-bottom: 10px;
        color: black;
    }
    .form-group label{
        font-weight: 600;
        color: #878;
    }
    .col-md-9 hr{
        margin: 0px;
    }
</style>
<br>    
<div>
    
    <div class="col-md-12">
        <div class="section-header">
            <h4>Employee Information</h4>
        </div>
        <div class="panel panel-container">
            <div class="panel-body">
                <label>Personal Information</label>
                <br>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>First Name</label>
                                <p class="employee-details-value">{{ $employee->first_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                 <p class="employee-details-value">{{ $employee->middle_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Last Name</label>
                                <p class="employee-details-value">{{ $employee->last_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <p class="employee-details-value">{{ $employee->eid}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alias</label>
                                <p class="employee-details-value">{{ $employee->alias}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Gender</label>
                                <p class="employee-details-value">{{ $employee->gender()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Birthdate</label>
                                <p class="employee-details-value">{{ $employee->prettybirthdate()}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
                    <label>Job Information</label>
                    <br>
                    <br>
                    <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Position</label>
                                <p class="employee-details-value">{{ $employee->position_name}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <p class="employee-details-value">{{ $employee->supervisor_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Manager</label>
                               <p class="employee-details-value">{{  $employee->manager_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Team/Department</label>
                                <p class="employee-details-value">{{ $employee->team_name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hire Date</label>
                               <p class="employee-details-value">{{ $employee->prettydatehired()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                               <p class="employee-details-value">{{ $employee->status()}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Account</label>
                               <p class="employee-details-value">{{ $employee->account->account_name}}</p>
                            </div>
                        </div>
                          @if(isset($employee->ext))
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone Extension</label>
                               <p class="employee-details-value">{{ @$employee->ext}}</p>
                            </div>
                        </div>
                        @endif
                        @if(isset($employee->prod_date))
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Production date</label>
                               <p class="employee-details-value">{{ @$employee->prettyproddate()}}</p>
                            </div>
                        </div>
                        @endif
                        @if(isset($employee->wave))
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Wave Number</label>
                               <p class="employee-details-value">{{ $employee->wave == "" ? "--" : $employee->wave }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <br>
                    <br>
                </div>
                <br>
                <label>Login Credentials</label>
                <br>
                <br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <br>
                                <a href="mailto:{{ $employee->email}}"><span class="employee-details-value">{{ $employee->email}}</span></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    @if(Auth::user()->id == $employee->id)
                        <br>
                        <div class="row">
                            <div class="col-md-3" style="display: flex;">
                                <a type="button" class="btn btn-default" href="{{url('employee/'. $employee->id .'/changepassword')}}">Change Password</a>
                                <!--  &nbsp;
                                <a class="btn btn-primary" href="{{url('employee_info/' . $employee->id . '/edit')}}">Update Profile</a> -->
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection