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
        margin-bottom: 1px !important;
        }
    .emp-profile{
        width: 90%;
        margin: auto;
    }
    .header-container{
        margin-top: 20px;
        margin-left: 6% !important;
        margin-right: 6% !important;
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
    <form style="display: unset;">
        <input type="hidden" name="alphabet" value="{{ $request->alphabet }}">
        <input type="text" placeholder="Search" id="search_employee" name="keyword" value="{{ $request->keyword }}">
        <button class="btn btn-primary" style="height:  35px; margin-top: -3px;"><span class="fa fa-search"></span></button>
    </form>
    <ul class="alphabet-search">
      <li><a href="?alphabet=" >All</a></li>   
    @foreach (range('A', 'Z') as $letter)
     <li><a href="?alphabet={{ $letter . "\n" }}" >{{ $letter . "\n" }}</a></li>
    @endforeach
</ul>
</div>
    <br>

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
        <div class="emp-profile" style="padding: 15px;">
            <div class="row">
                <div class="col-md-1">
                    <img alt="image" id="profile_image" class="img-circle" style="width: 80px; height: 80px;margin: 15px;" src="{{ $employee->profile_img }}">
                </div>
                <div class="col-md-6">
                    <a href="{{url('profile/'. $employee->id)}}"><h3>{{$employee->fullname()}}</h3></a>
                    <h4>{{ $employee->position_name}}</h4>
                    <h5>{{$employee->team_name}} - {{$employee->account->account_name}}</h5>
<!--                <span class="fa fa-envelope"></span>
                    <span class="fa fa-linkedin-square"></span>
                    <span class="fa fa-facebook-square"></span>
                    <span class="fa fa-twitter-square"></span> -->
                </div>

                <div class="col-md-3">
                    <br>
                    <br>
                    <h5><span class="fa fa-id-card" title="Employee ID"></span>&nbsp;&nbsp;{{$employee->eid}}</h5>
                    <h5><span class="fa fa-envelope" title="Email Address"></span>&nbsp;&nbsp;{{$employee->email}}</h5>
                    <!-- <h5><span class="fa fa-phone"></span>&nbsp;&nbsp;09077610404</h5> -->
                </div>
                <div class="col-md-2">
                    <h5>
                        <span class="fa fa-user" title="Supervisor"></span> <span style="color: gray;">Supervisor:</span>
                    <br>
                    <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{$employee->supervisor->fullname()}}</h5>
                    <h5>
                        <span class="fa fa-user" title="Manager"></span> <span style="color: gray;">Manager: </span>
                        <br>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{ isset($employee->manager) ? $employee->manager->fullname() : 'N/A'}}</h5>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="header-container">
    <div class="pull-right">
    {{ $employees->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection 