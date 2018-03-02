@extends('layouts.main')

@section('title')
View Profile
@endsection
@section('pagetitle')
Employee Information / Edit
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
{{ Form::open(array('url' => 'employee_info/' . $employee->id, )) }}
    {{ Form::hidden('_method', 'PUT') }}
    {{ csrf_field() }}
<div col-md-12>
  <div class="col-md-3" style="padding-left: 10px !important; padding-right: 10px;">
      <div class="panel panel-container">
            <div class="row no-padding">
                <center>
                <img alt="image" class="img-circle" style="width: 150px; margin-top: 30px;" src="{{ $employee->profile_img }}">
                <br> 
                <br>
                <button class="btn btn-small">change profile picture</button>
                <h4 class="card-title m-t-10">{{ $employee->fullname() }}</h4>
                <h6 class="card-subtitle">{{ $employee->position_name }}</h6>
                <h6 class="card-subtitle">{{ $employee->team_name }}</h6>
                <hr>
                </center>
                <span class="pull-left label-profile">date hired: <i>{{ $employee->prettydatehired() }}</i></span>
                <span class="pull-right label-profile" style="margin-top: -20px;">date started: <i>{{ $employee->prettydatestarted() }}</i></span>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input  class="form-control" placeholder="First Name" name="first_name" value="{{$employee->first_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" placeholder="Middle Name" name="middle_name" value="{{$employee->middle_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" name="last_name" value="{{$employee->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input class="form-control" placeholder="Employee ID" name="eid" value="{{$employee->eid}}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Alias</label>
                                <input class="form-control" placeholder="Alias" name="alias" value="{{$employee->alias}}">
                            </div>
                        </div>
                       
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Position</label>
                                <input class="form-control" placeholder="Position" name="position_name" value="{{$employee->position_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <input class="form-control" placeholder="Supervisor" name="supervisor_id" value="{{$employee->supervisor_id}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Team/Department</label>
                                <input class="form-control" placeholder="Team/Department" name="team_name" value="{{$employee->team_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hire Date</label>
                                <input class="form-control" placeholder="Hire Date" name="hired_date" value="{{$employee->prettydatehired()}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input class="form-control" placeholder="Start Date" name="started_date" value="{{$employee->prettydatestarted()}}">
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
                                <input class="form-control" placeholder="Email" name="email" value="{{$employee->email}}">
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
                        <a type="button" class="btn btn-default" style="margin-top: 26px;" href="{{url('employee/'. $employee->id .'/changepassword')}}">Change Password</a>
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
  <script type="text/javascript">
 
@endsection