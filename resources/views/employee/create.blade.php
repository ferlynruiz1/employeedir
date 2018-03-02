@extends('layouts.main')

@section('title')
View Profile
@endsection
@section('pagetitle')
Employee / Add
@endsection
@section('content')

<style type="text/css">
    .card-title{
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
    .employee-details-value{
        font-size: 16px;
        line-height: 21px;
        padding-bottom: 10px;
        color: black;
    }
    .label-profile{
        padding-left: 15px; 
        padding-right: 15px;
    }
    .col-md-9 hr{
        margin: 0px;
    }
</style>
<br>
<form role="form" method="POST" action="{{ route('employee_info.store')}}">
    {{ csrf_field() }}
<div> 
  <div class="col-md-12">
      <div class="panel panel-container">
        <div class="panel-body">

        <label>Employee Information</label>
        <br>
        <br> 
            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input  class="form-control" placeholder="First Name" name="first_name" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" placeholder="Middle Name" name="middle_name" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" name="last_name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input class="form-control" placeholder="Employee ID" name="eid" value="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Alias</label>
                                <input class="form-control" placeholder="Alias" name="alias" value="">
                            </div>
                        </div>
                       
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Position</label>
                                <input class="form-control" placeholder="Position" name="position_name" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <input class="form-control" placeholder="Supervisor" name="supervisor_id" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Team/Department</label>
                                <input class="form-control" placeholder="Team/Department" name="team_name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hire Date</label>
                                <input class="form-control datepicker" placeholder="Hire Date" name="hired_date" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input class="form-control datepicker" placeholder="Start Date" name="started_date" value="">
                            </div>
                        </div>
                    </div>
            </div>

            <label>Login Credentials</label>
            <br>
            <br>
            <div class="col-md-12">
                 <div class="row">
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" placeholder="Email" name="email" value="">
                            </div>
                        </div>
                        <div class="col-md-4 hidden password">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" >
                            </div>
                        </div>
                        <div class="col-md-4 hidden password">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-12">
            <br>
            <br>
                 <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary">Save</button>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

            </form>
@endsection