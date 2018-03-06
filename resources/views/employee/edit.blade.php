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
      <div class="panel panel-container">
            <div class="row no-padding">
                <center>
                <img alt="image" id="profile_image" class="img-circle" style="width: 150px; margin-top: 30px;" src="{{ $employee->profile_img }}">
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
        <small class="asterisk-required" style="margin-left: 20px;font-size: 13px;">required fields</small>
        <br>
        <br>
            <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="asterisk-required">First Name</label>
                                <input  class="form-control" placeholder="First Name" name="first_name" value="{{$employee->first_name}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input class="form-control" placeholder="Middle Name" name="middle_name" value="{{$employee->middle_name}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="asterisk-required">Last Name</label>
                                <input class="form-control" placeholder="Last Name" name="last_name" value="{{$employee->last_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="asterisk-required">Employee ID</label>
                                <input class="form-control" placeholder="Employee ID" name="eid" value="{{$employee->eid}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="asterisk-required">Alias</label>
                                <input class="form-control" placeholder="Alias" name="alias" value="{{$employee->alias}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <br>
                                <label>Gender</label>
                                <br>
                                <input type="radio" id="male" name="gender_id" value="1" placeholder="test" <?php echo $employee->gender == 1 ? "checked" : "" ; ?>>
                                <label class="radio-label" for="male">Male</label>
                                &nbsp;
                                &nbsp;
                                <input type="radio" id="female" name="gender_id" value="2" placeholder="test" <?php echo $employee->gender == 2 ? "checked" : "" ; ?>>
                                <label class="radio-label" for="female" >Female</label>
                                &nbsp;
                                &nbsp;
                                <input type="radio" id="other" name="gender_id" value="3" placeholder="test" <?php echo $employee->gender == 3 ? "checked" : "" ; ?>>
                                <label class="radio-label" for="other" >Other</label>
                                &nbsp;
                                &nbsp;
                                <input type="radio" id="prefernotsay" name="gender_id" value="4" placeholder="tes" <?php echo $employee->gender == 4 ? "checked" : "" ; ?>>
                                <label class="radio-label" for="prefernotsay" >Prefer not to say</label>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <br>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="asterisk-required">Position</label>
                                <input class="form-control" placeholder="Position" name="position_name" value="{{$employee->position_name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="asterisk-required">Supervisor</label>
                                <select class="select2 form-control"  name="supervisor_id" required>
                                    <option selected="" disabled="">Select</option>
                                    @foreach($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}" <?php echo $supervisor->id == $employee->supervisor_id ? "selected" : "" ; ?>> {{$supervisor->fullname()}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="asterisk-required">Team/Department</label>
                                <select class="select2 form-control" name="team_name" required>
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
                                <label class="asterisk-required">Hire Date</label>
                                <input class="form-control datepicker" placeholder="Hire Date" name="hired_date" value="{{$employee->datehired()}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="asterisk-required">Start Date</label>
                                <input class="form-control datepicker" placeholder="Start Date" name="started_date" value="{{$employee->datestarted()}}">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-12">
                <br>
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
 
@endsection
@section('scripts')
 <script type="text/javascript">
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
 </script>
@endsection