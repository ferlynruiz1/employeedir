@extends('layouts.main')
@section('title')
Edit Profile
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
{{ Form::open(array('url' => 'employee_info/' . $employee->id,'files' => true ,'id' => 'edit_employee_form')) }}
{{ Form::hidden('_method', 'PUT') }}
{{ csrf_field() }}
    <div col-md-12>
        <div class="col-md-3" style="padding-left: 10px !important; padding-right: 10px;">
            <div class="section-header">
                <h4>Profile Picture</h4>
            </div>
            <div class="panel panel-container">
                <div class="row no-padding">
                    <center>
                        <img alt="Profile Image" id="profile_image" style="width: 150px;margin-top: 30px;" src="{{ $employee->profile_img }}">
                        <br> 
                        <br>
                        <label id="bb" class="btn btn-default"> Upload Photo
                            <input id="image_uploader" type="file" class="btn btn-small" value="" onchange="previewFile()"  name="profile_image"/>
                        </label>    
                        <h4 class="card-title m-t-10">{{ $employee->fullname() }}</h4>
                        <h6 class="card-subtitle">{{ $employee->position_name }}</h6>
                        <h6 class="card-subtitle">{{ $employee->team_name }}</h6>
                        <hr>
                    </center>
                    <span class="pull-left label-profile">date hired: <i>{{ $employee->prettydatehired() }}</i></span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="section-header">
                <h4>Employee Information</h4>
            </div>
            <div class="panel panel-container" style="padding-top: 0px">
                <div class="panel-body"> 
                    <label>Personal
                    <small class="asterisk-required" style="margin-left: 15px;font-size: 11px;">
                        required fields
                    </small></label>
                    <hr>    
                    <br> 
                    <div class="col-md-12">
                        @include('employee.fields.personal')
                        <br>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <br>
                    </div>
                    <br>
                    <br>
                    <label>User Access</label>
                    <hr>
                    <br>
                    <div class="col-md-12">
                        @include('employee.fields.user_access')
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    </div>
                    <label>Job Related</label>
                    <hr>
                    <br>
                    <div class="col-md-12">
                         <div class="row">
                            
                            <br>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Position</label>
                                    <input class="form-control" placeholder="Position" name="position_name" value="{{$employee->position_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Account</label>
                                     <select class="select2 form-control" name="account_id" required>
                                        <option selected="" disabled="">Select</option>
                                        @foreach($accounts as $account)
                                            <option <?php echo $employee->account_id == $account->id ? "selected" : "" ; ?> value="{{$account->id}}">{{$account->account_name}}</option>
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
                                            <option <?php echo $department->department_name == $employee->team_name ? "selected" : "";?> value="{{ $department->department_name }}"> {{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Manager</label>
                                   <select class="select2 form-control" name="manager_id">
                                        <option selected="" disabled="">Select</option>
                                       @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}" <?php echo $supervisor->fullname() == $employee->manager_name || $supervisor->id == $employee->manager_id ? "selected" : "" ; ?>> {{$supervisor->fullname()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Supervisor</label>
                                    <select class="select2 form-control"  name="supervisor_id" >
                                        <option selected="" disabled="">Select</option>
                                        @foreach($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}" <?php echo $supervisor->fullname() == $employee->supervisor_name || $supervisor->id == $employee->supervisor_id ? "selected" : "" ; ?>> {{$supervisor->fullname()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Hire Date</label>
                                    <input class="form-control datepicker" placeholder="Hire Date" name="hired_date" value="{{$employee->datehired()}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Production Date</label>
                                    <input class="form-control datepicker" placeholder="Hire Date" name="prod_date" value="{{$employee->prodDate()}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="asterisk-required">Employee Status</label>
                                     <select class="select2 form-control" name="status_id" required>
                                        <option selected="" disabled="">Select</option>
                                        <option <?php echo $employee->status == 1 ? "selected" : "" ; ?> value="1">Active</option>
                                        <option <?php echo $employee->status == 2 ? "selected" : "" ; ?> value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >EXT</label>
                                    <input class="form-control" placeholder="Ext" name="ext" value="{{$employee->ext}}" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label >Wave </label>
                                    <input class="form-control" placeholder="Wave" name="wave" value="{{$employee->wave}}" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" name="all_access" <?php echo $employee->all_access == 1 ? "checked" : "" ; ?>> &nbsp;
                                    <span for="all_access">can view information from other account ?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <br>
                    </div>
                    <label><b>Government Numbers</b></label>
                    <hr>
                    <br>
                    <div class="col-md-12 no-padding" >
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >SSS Number</label>
                                <input class="form-control" name="sss" type="text" value="{{ $employee->sss }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Pag-ibig/HDMF</label>
                                <input class="form-control" name="pagibig" type="text" value="{{ $employee->pagibig }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Philhealth Number</label>
                                <input class="form-control" name="philhealth" type="text" value="{{ $employee->philhealth }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>TIN ID</label>
                                <input class="form-control" name="tin" type="text" value="{{ $employee->tin }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="">
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
                                    <label>Primary Email</label>
                                    <input class="form-control" placeholder="Email" name="email" value="{{$employee->email}}">
                                </div>
                            </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email 2</label>
                                        <input class="form-control" placeholder="Email 2" name="email2" type="email" value="{{$employee->email2}}">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email 3</label>
                                        <input class="form-control" placeholder="Email 3" name="email3" type="email" value="{{$employee->email3}}">
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
                            <!-- <a type="button" class="btn btn-default" style="margin-top: 26px;" href="{{url('employee/'. $employee->id .'/changepassword')}}">Change Password</a> -->
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
    var changed = false;
     $('#edit_employee_form').validate({
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

     $('#image_uploader').change(function(){
        changed = true;
     });

     $('input').change(function(){
        changed = true;
     });

     $('select').change(function(){
        changed = true;
     });
     $('#edit_employee_form').submit(function(){
        changed = false;
     });
     window.onbeforeunload = function(){
        if(changed){
            return '';
        }
     }
    //  $('input[name=employee_type]').change(function(){
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