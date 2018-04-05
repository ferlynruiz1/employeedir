@extends('layouts.main')
@section('title')
Home
@endsection
@section('pagetitle')
Home
@endsection
@section('content')
<style type="text/css">
    .birthday-holder {
    padding: 10px;
}
</style>
<br>
    <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    New Hires
                    </div>
                <div class="panel-body timeline-container">
                    <ul class="timeline">
                        @foreach($new_hires as $employee)
                        <li>
                            <div class="timeline-badge"><img src="{{ $employee->profile_img }}" class="img-circle" alt="" style="width: 50px; height: 50px; margin-top: -10px; box-shadow: 1px 1px 10px 7px #fff;"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title"> <a href="employee_info/{{$employee->id}}" target="_blank">{{ $employee->fullname() }}</a></h4>
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Birthday Celebrants for {{ date('F') }} 
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