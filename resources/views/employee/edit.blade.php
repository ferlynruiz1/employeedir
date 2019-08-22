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
                        @include('employee.fields.job_related')
                        <br>
                        <br>
                        <br>
                    </div>
                    <div class="col-md-12">
                    </div>
                    <label>Government Numbers</label>
                    <hr>
                    <br>
                    <div class="col-md-12 no-padding" >
                        @include('employee.fields.government')
                        <br>
                        <br>
                    </div>
                    <div class="col-md-12" id="">
                        <br>
                    </div>
                    <label>Login Credentials</label>
                    <hr>
                    <br>
                    <br>
                    <div class="col-md-12">
                        @include('employee.fields.login')
                        <br>
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