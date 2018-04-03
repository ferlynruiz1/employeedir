@extends('layouts.main')
@section('title')
Dashboard
@endsection
@section('pagetitle')
Dashboard
@endsection
@section('content')
<style type="text/css">
    .birthday-celebrants-div{
        margin-right: 10px;
        margin-left: 10px;
        padding-left: 10px;
    }
    .birthday-holder{
        margin-bottom: 30px;
    }
    .birthday-celebrants-div a {
        color: inherit;
        text-decoration: inherit;
    }
    .birthday-celebrants-div a:hover{
        color: #30A5FF;
    }
    .birthday-celebrants-div span.fa{
        color: red;
    }
</style>
<br>
   <div class="col-md-12">
        <div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-user color-blue"></em>
                            <div class="large">{{ count($employees) }}</div>
                            <div class="text-muted">Head Count</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-blue panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-gray"></em>
                            <div class="large">8</div>
                            <div class="text-muted">Departments</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-orange panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-upload" style="color: #388E3C;"></em>
                            <div class="large"><a href="{{ url('employees/import')}}" class="btn btn-success" style="background-color: #388E3C;">Import</a></div>
                            <div class="text-muted">Import Employees </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding pull-right">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding"><em class="fa fa-xl fa-download color-black" style="color: #F57C00;"></em>
                            <div class="large"><a class="btn btn-warning" href="{{url('employees/export')}}" style="background-color: #F57C00;">Export</a></div>
                            <div class="text-muted">Generate Report</div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
        </div>
    </div>
    <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Newest Hired
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container">
                    <ul class="timeline">
                        @foreach($new_hires as $employee)
                        <li>
                            <div class="timeline-badge"><img src="{{ $employee->profile_img }}" class="img-circle" alt="" style="width: 50px; height: 50px; margin-top: -10px; box-shadow: 1px 1px 10px 7px #fff;"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"><a href="employee_info/{{$employee->id}}" target=""> {{ $employee->fullname() }}</a></h4>
                                </div>
                                <div class="timeline-body">
                                    <p>{{ joinGrammar($employee->prod_date) }} the {{ $employee->team_name }} as {{ $employee->position_name }}</p>
                                </div>
                                <div class="timeline-body">
                                    <small>{{ $employee->prettyprodDate() }}</small>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @if(count($new_hires) == 0)
                            <style type="text/css">
                                .timeline:before{
                                    display: none;
                                }
                            </style>
                            <center>
                                    No employees so far
                            </center>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Birthday Celebrants of {{ date('F') }} 
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container" >
                    @if(count($birthdays) > 0)
                        <h4 style=" font-weight: 600;font-size: 16px;text-align: center;padding: 11px;padding-left: 30px;font-family: cursive;">{{ date('F') }}</h4>
                        <br>
                        <div class="birthday-celebrants-div">
                            @foreach($birthdays as $celebrant)
                            <div class="birthday-holder">
                                <img src="{{ $employee->profile_img }}" class="img pull-left" alt="" style="width: 50px; height: 50px; margin-top: -10px; box-shadow: 1px 1px 10px 7px #fff; margin-right: 20px;">
                                <p><a target="_blank" href="employee_info/{{$celebrant->id}}" target="">{{ $celebrant->fullname() }}</a><br><span ><span class="fa fa-gift"></span> {{ monthDay($celebrant->birth_date) }}</span></p> 
                            </div>
                            @endforeach
                        </div>
                    @else
                        <center>
                                No birthday celebrant for {{ date('F') }}
                        </center>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    ElinkGagements Activities 
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container" >
                    @foreach($engagements as $engagement)
                     <hr>
                        <b>{{ $engagement->title}}</b>
                        <br>
                        <small>{{ $engagement->subtitle}}</small>
                        <br>
                        <br>
                        @if(isset($engagement->image_url) || $engagement->image_url != "")
                            <img src="{{ $engagement->image_url}}" style="width: 100%; padding-right: 80px; padding-left: 80px;">
                        <br>
                        <br>
                        @endif
                        <p>{{ $engagement->message }}</p>
                        <small style="margin-right: 20px;">{{ monthDay($engagement->created_at) }}</small>

                    @endforeach
                    @if(count($engagements) == 0)
                        <center>No events yet</center>
                    @endif
                </div>
            </div>
        </div>
@endsection