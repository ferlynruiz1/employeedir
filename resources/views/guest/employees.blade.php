@extends('layouts.main')
@section('title')
Employees
@endsection
@section('pagetitle')
Employees
@endsection
@section('content')
<style type="text/css">
    .emp-profile{
        background-color: white;
    }
    .col-md-12{
        margin-bottom: 1px !important;
    }
    .emp-profile{
        margin: auto;
    }
    .header-container{
        margin-top: 20px;
    }
    #search_employee{
        padding-left: 5px;
    }
    .alphabet-search{
        display: inline-flex;
        list-style: none;
    }
    .alphabet-search li{
        margin-left: 10px;
    }
    .header-list{

    }
    .employee-description{
        color: #777;
        font-size: 13px;
    }
    h1, h2, h3, h4, h5, h6 {
        color: #777;
    }
    li a.selected{
        font-weight: 900!important;
    }
</style>

<div class="col-md-12">
<div class="header-container" style="margin-bottom: 5px;">
    <form style="display: unset;">
        <input type="hidden" name="alphabet" value="{{ $request->alphabet }}">
        <input type="hidden" name="department" value="{{ $request->department }}">
        <input type="text" placeholder="Search by name" id="search_employee" name="keyword" value="{{ $request->keyword }}">
        <button class="btn btn-primary" style="height:  35px; margin-top: -3px;">
            <span class="fa fa-search"></span>
        </button>
    </form>
    <ul class="alphabet-search">
        <li>
            <a href="?alphabet=" >All</a>
        </li>   
        @foreach (range('A', 'Z') as $letter)
            <li>
                <a <?php echo $request->alphabet == $letter ? "class='selected'" : '' ?> style="font-weight: 500;" href="?alphabet={{ $letter . "\n" . "&keyword=" . $request->keyword . "&department=" . $request->department }}" >{{ $letter . "\n" }}</a>
            </li>
        @endforeach
    </ul>
    <div class="pull-right">
        <span style="position: absolute; top: 26px; margin-left: -170px;">Search by department:</span>
       <select class="form-control" style="border-radius: 0px !important" id="departments_list">
            <option>Select Department</option>
            @foreach( $departments as $department)
           <option <?php echo $request->department == $department->department_name ? "selected" : "";?> >{{ $department->department_name}}</option>
           @endforeach
       </select>
    </div>
</div>
@if(count($employees) == 0)
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <center>
        <h3>No results found.</h3>
    </center>
@endif
@foreach($employees as $employee)
    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; ">
        <div class="emp-profile" style="padding: 10px; margin-bottom: 0px;">
            <div class="row">
                <div class="col-md-1" style="float: left; width: 100px;">
                    <img alt="image" id="profile_image" class="img-circle" style="width: 60px; height: 60px;margin: 15px;" src="{{ $employee->profile_img }}">
                </div>
                <div class="col-md-4">
                    <a href="{{url('profile/'. $employee->id)}}">
                        <h3 style="color: #444;font-weight: 500; font-size: 17px; margin-top: 10px;">{{$employee->fullname()}}</h3>
                    </a>
                    <h5 style="color: #455;">{{ $employee->position_name}}</h5>
                    <h6>{{$employee->team_name}} <?php echo isset($employee->account) ? "- ". $employee->account->account_name : "" ; ?></h6>
                </div>
                <div class="col-md-4">
                    <h5>
                        <span class="fa fa-id-card" title="Employee ID"></span>
                        <span class="employee-description">&nbsp;&nbsp;{{$employee->eid}}</span>
                    </h5>
                    <h5>
                        <span class="fa fa-envelope" title="Email Address"></span>
                        <span class="employee-description" style="color: #0c59a2;;">&nbsp;&nbsp;{{$employee->email}}</span>
                    </h5>
                    @if(isset($employee->ext) && $employee->ext != '--')
                    <h5>
                         <span class="fa fa-phone" title="Extension Number"></span>
                        <span class="employee-description" >&nbsp;&nbsp;{{$employee->ext}}</span>
                    </h5>
                    @endif
                </div>
                <div class="col-md-3">
                    @if(isset($employee->supervisor_name))
                    <h5 style="font-size: 13px;">
                        <span class="fa fa-user" title="Supervisor"></span>
                        <span style="color: gray;">Supervisor:</span>
                        {{$employee->supervisor_name}}
                    </h5>
                    @endif
                    @if(isset($employee->manager_name))
                        <h5 style="font-size: 13px;">
                            <span class="fa fa-user" title="Manager"></span>
                            <span style="color: gray;">Manager: </span>
                            <span>{{ $employee->manager_name }}</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    <div class="col-md-12 header-container" style="margin-top: 0px;">
        <div class="pull-right">
            {{ $employees->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('#departments_list').change(function(){
        var url = location.protocol + '//' + location.host + location.pathname;
        var keyword = "keyword=" + $("#search_employee").val();
        var alphabet = "alphabet=" + $('input[name=alphabet]').val();
        var department = "department=" + $(this).val();
        url += "?" + keyword + "&" + alphabet + "&" + department;
        window.location.replace(url);
    });
</script>
@endsection 