@extends('layouts.main')
@section('title')
Home
@endsection
@section('pagetitle')
Home
@endsection
@section('content')
<br>
    <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    New Hires
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container">
                    <ul class="timeline">
                        @foreach($new_hires as $employee)
                        <li>
                            <div class="timeline-badge"><img src="{{ $employee->profile_img }}" class="img-circle" alt="" style="width: 50px; height: 50px; margin-top: -10px; box-shadow: 1px 1px 10px 7px #fff;"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ $employee->fullname() }}</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Joined the {{ $employee->team_name }} as {{ $employee->position_name }}</p>
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
        <div class="col-md-8">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    Company Hierarchy
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                <div class="panel-body timeline-container">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>
                        <h2>Company Hierarchy</h2>
                        <h3 style="color: #aaa;">(Coming soon)</h3>
                    </center>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
@endsection