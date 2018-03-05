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
<div class="col-md-12">
  <div class="col-md-3" style="padding-left: 0px !important; padding-right: 0px;">
      <div class="panel panel-container">
            <div class="row no-padding">
                <center>
                <img alt="image" class="img-circle" style="width: 150px; margin-top: 30px;" src="{{ $employee->profile_img }}">
                <br>
                <h4 class="card-title m-t-10">{{ $employee->fullname() }}</h4>
                <h6 class="card-subtitle">{{ $employee->position_name }}</h6>
                <h6 class="card-subtitle">{{ $employee->team_name }}</h6>
                <hr>
                </center>
                <span class="pull-left label-profile">date hired: <i>{{ $employee->prettydatehired() }}</i></span>
                <span class="pull-right label-profile">date started: <i>{{ $employee->prettydatestarted() }}</i></span>
                <br>
                <br>
            </div><!--/.row-->
        </div>
  </div>
  <div class="col-md-9">
      <div class="panel panel-container">
        <div class="panel-body">
        <label>Employee Information</label>
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
                </div>
                <hr>
                <br>
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
                            <p class="employee-details-value">{{ $employee->supervisor_id}}</p>
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
                            <label>Start Date</label>
                            <p class="employee-details-value">{{ $employee->prettydatestarted()}}</p>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
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
                  @if(Auth::user()->id == $employee->id || Auth::user()->usertype == 1)
                <br>
               
                <div class="row">
                     <div class="col-md-3" style="display: flex;">
                         <a type="button" class="btn btn-default" href="{{url('employee/'. $employee->id .'/changepassword')}}">Change Password</a>
                         &nbsp;
                        <a class="btn btn-primary" href="{{url('employee_info/' . $employee->id . '/edit')}}">Update Profile</a>
                      </div>

                </div>
                @endif
            </div>
        </div>
      </div>
  </div>
</div>
@endsection