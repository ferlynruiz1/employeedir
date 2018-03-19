@extends('layouts.main')
@section('title')
Dashboard
@endsection
@section('pagetitle')
Dashboard
@endsection
@section('content')
<br>
   <div class="col-md-12">
   <div class="panel panel-container">
            <div class="row">
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                    <div class="panel panel-teal panel-widget border-right">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
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
                        <div class="row no-padding"><em class="fa fa-xl fa-upload color-blue"></em>
                            <div class="large"><a class="btn btn-primary">Import</a></div>
                            <div class="text-muted">Import Employees </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 no-padding pull-right">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding"><em class="fa fa-xl fa-users color-black"></em>
                            <div class="large"><a class="btn btn-success" href="{{url('excel-download')}}">Generate</a></div>
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
                        New Hires
                        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                    <div class="panel-body timeline-container">
                        <ul class="timeline">
                            @foreach($employees as $employee)
                            <li>
                                <div class="timeline-badge"><img src="{{ $employee->profile_img }}" class="img-circle" alt="" style="width: 50px; height: 50px; margin-top: -10px; box-shadow: 1px 1px 10px 7px #fff;"></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $employee->alias }}</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Joined the {{ $employee->team_name }} as {{ $employee->position_name }}</p>
                                    </div>
                                    <div class="timeline-body">
                                        <small>{{ $employee->prettydatehired() }}</small>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
@endsection