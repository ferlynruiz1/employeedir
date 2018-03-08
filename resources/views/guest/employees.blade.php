@extends('layouts.secondary')

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
        height: 191px !important;
        max-height: 191px !important;
        min-height: 191px !important;
        }
    .emp-profile{
        width: 90%;
        margin: auto;
    }
    .header-container{
        margin-top: 20px;
        margin-left: 6% !important;
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
</style>
<div class="header-container">
    <input type="text" placeholder="Search" id="search_employee">
    <button class="btn btn-primary" style="height:  38px;"><span class="fa fa-search"></span></button>
    <ul class="alphabet-search">
    @foreach (range('A', 'Z') as $char)
     <li><a href="?last_name={{ $char . "\n" }}" >{{ $char . "\n" }}</a></li>
    @endforeach
</ul>
<div>
    <span></span>
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
<div class="col-md-12">
    <br>
    <br>
    <div class="emp-profile" style="padding: 30px;">
        <div class="row">
           
            <div class="col-md-1">
                <img alt="image" id="profile_image" class="img-circle" style="width: 100px;" src="{{ $employee->profile_img }}">
            </div>
            <div class="col-md-5" style="border-right: 1px solid #ddd">
                <a href="{{url('employee_info/'. $employee->id)}}"><h3>{{$employee->fullname()}}</h3></a>
                <h4>{{ $employee->position_name}}</h4>
                <h5>{{$employee->team_name}}-Cebu Philippines</h5>
                <span class="fa fa-envelope"></span>
                <span class="fa fa-linkedin-square"></span>
                <span class="fa fa-facebook-square"></span>
                <span class="fa fa-twitter-square"></span>
            </div>
            <div class="col-md-5" style="margin-left: 10px">

                <h5><span class="fa fa-id-card"></span>&nbsp;&nbsp;{{$employee->eid}}</h5>
                <h5><span class="fa fa-envelope"></span>&nbsp;&nbsp;{{$employee->email}}</h5>
                <h5><span class="fa fa-phone"></span>&nbsp;&nbsp;09077610404</h5>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('scripts')
 <script type="text/javascript">
     
 </script>
@endsection