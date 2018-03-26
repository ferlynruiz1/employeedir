@extends('layouts.main')
@section('title')
Add Employee
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
<form id="create_employee_form" role="form" method="POST" action="{{ route('employee_info.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div> 
        <div class="col-md-3" style="padding-left: 10px !important; padding-right: 10px;">
            <div class="section-header">
                <h4>Profile Picture </h4>
            </div>
            <div class="panel panel-container">
                <div class="row no-padding">
                    <center>
                        <img alt="image" id="profile_image" class="img-circle" style="width: 150px; height: 150px; margin-top: 30px;" src="{{ asset('public/img/nobody_m.original.jpg') }}">
                        <br> 
                        <br>
                         <label id="bb" class="btn btn-default"> Upload Photo
                            <input id="image_uploader" type="file" class="btn btn-small" value="" onchange="previewFile()"  name="profile_image"/>
                        </label> 
                        <h4 class="card-title m-t-10"></h4>
                        <h6 class="card-subtitle"></h6>
                        <h6 class="card-subtitle"></h6>
                    </center>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="section-header">
                <h4>Employee Information </h4>
            </div>
            <div class="panel panel-container">
                <div class="panel-body">
                    <label>Personal</label>
                    <br> 
                    <hr>
                    <br> 
                    <small class="asterisk-required" style="margin-left: 15px;font-size: 13px;">required fields</small>
                    <br> 
                    <br> 
                    <br> 
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">First Name</label>
                                    <input  class="form-control" placeholder="First Name" name="first_name" value="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input class="form-control" placeholder="Middle Name" name="middle_name" value="">
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Last Name</label>
                                    <input class="form-control" placeholder="Last Name" name="last_name" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="asterisk-required">Employee ID</label>
                                    <input class="form-control" placeholder="Employee ID" name="eid" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Alias</label>
                                    <input class="form-control" placeholder="Alias" name="alias" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Birthdate</label>
                                    <input class="form-control datepicker" placeholder="Birthdate" name="birth_date" value="" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <label>Gender</label>
                                    <br>
                                    <input type="radio" id="male" name="gender_id" value="1" placeholder="test" required>
                                    <label class="radio-label" for="male">Male</label>
                                    &nbsp;
                                    &nbsp;
                                    <input type="radio" id="female" name="gender_id" value="2" placeholder="test" required>
                                    <label class="radio-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <br>
                    <br>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <label>Job Related</label>
                    <hr>
                    <br>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br>
                                    <label></label>
                                    <input type="radio" checked id="employee" name="employee_type" value="1" placeholder="test" required>
                                    <label class="radio-label" for="employee">Employee</label>
                                    &nbsp;
                                    &nbsp;
                                    <input type="radio" id="supervisor" name="employee_type" value="2" placeholder="test" required>
                                    <label class="radio-label" for="supervisor">Supervisor</label>
                                    &nbsp;
                                    &nbsp;
                                    <input type="radio" id="manager" name="employee_type" value="3" placeholder="test" required>
                                    <label class="radio-label" for="manager">Manager</label>
                                    &nbsp;
                                    &nbsp;
                                    <input type="radio" id="admin" name="employee_type" value="4" placeholder="test" required>
                                    <label class="radio-label" for="admin">Admin</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Position</label>
                                    <input class="form-control" placeholder="Position" name="position_name" value="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Account</label>
                                    <select class="select2 form-control"  name="account_id">
                                        <option selected="" disabled="">Select</option>
                                        @foreach($accounts as $account)
                                            <option value="{{ $account->id }}"> {{$account->account_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Team/Department</label>
                                     <select class="select2 form-control" name="team_name">
                                        <option selected="" disabled="">Select</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->department_name }}"> {{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Manager</label>
                                   <select class="select2 form-control" name="manager_name">
                                        <option selected="" disabled="">Select</option>
                                       @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->fullname() }}"> {{$supervisor->fullname()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Supervisor</label>
                                    <select class="select2 form-control"  name="supervisor_name">
                                        <option selected="" disabled="">Select</option>
                                        @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->fullname() }}"> {{$supervisor->fullname()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Hire Date</label>
                                    <input class="form-control datepicker" placeholder="Hire Date" name="hired_date" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Production Date</label>
                                    <input class="form-control datepicker" placeholder="Hire Date" name="prod_date" value="">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="asterisk-required">Employee Status</label>
                                     <select class="select2 form-control" name="status_id" required>
                                        <option selected="" disabled="">Select</option>
                                        <option value="1" selected>Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label >EXT</label>
                                    <input class="form-control" placeholder="Ext" name="ext" value="" >
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label >Wave </label>
                                    <input class="form-control" placeholder="Wave" name="wave" value="" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" name="all_access"> &nbsp;
                                    <span for="all_access">can view information from other account ?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="">
                        <br>
                        <br>
                    </div>
                    <label>Login Credentials</label>
                    <hr>
                    <br>
                    <br> 
                    <div class="col-md-12">
                         <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="asterisk-required">Email</label>
                                        <input class="form-control" placeholder="Email" name="email" type="email" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="form-group">
                                        <br>
                                        <p>
                                            <pre style="border: 0px solid transparent; border-radius: 0px !important; margin-top: -3px;"><i class="fa fa-info-circle">&nbsp;</i> Password will be generated automatically once saved.</pre>
                                        </p>
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
@section('scripts')
<script type="text/javascript">
    $('#create_employee_form').validate({
        ignore: [], 
        rules : {
            first_name: {
                maxlength: 50
            },
            middle_name: {
                maxlength: 50
            },
            last_name: {
                maxlength: 50
            },
            alias:{
                maxlength: 100
            },
            position_name: {
                maxlength: 50
            }
        }
    });
    // $('input[name=employee_type]').change(function(){
    //     switch($(this).val()){
    //         case '2':
    //              $('select[name=supervisor_id]').parent().parent().show();
    //              $('select[name=manager_id]').parent().parent().show();
    //              $('input[name=all_access]').parent().parent().show();
    //         break;
    //         case '3':
    //             console.log('sulod');
    //             $('select[name=supervisor_id]').parent().parent().hide();
    //              $('input[name=all_access]').parent().parent().show();
    //         break;
    //         case '4':
    //              $('select[name=supervisor_id]').parent().parent().hide();
    //              $('select[name=manager_id]').parent().parent().hide();
    //              $('input[name=all_access]').parent().parent().show();
    //         break;
    //         case '1':
    //              $('select[name=supervisor_id]').parent().parent().show();
    //              $('select[name=manager_id]').parent().parent().show();
    //              $('input[name=all_access]').parent().parent().hide();
    //         break;
    //     }
    // });
    // $('input[name=employee_type]').trigger('change');
</script>
@endsection