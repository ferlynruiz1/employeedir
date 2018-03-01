@extends('layouts.main')

@section('title')
Dashboard
@endsection

@section('content')
	<style type="text/css">
	body{
        background-image: url({{asset('public/img/002-subtle-light-pattern-background-texture.jpg')}});
    }
    #employees_table_wrapper{
        background-color: white;
        padding: 10px;
    }
    h1.page-header{
        margin-left: 20px;
        margin-bottom: -10px;
    }
    div.circle{
        border-radius: 100px;
        border: 1px solid #eaeaea;
        width: 46px;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        background-color: green;
        color: white;
        margin-right: 10px;
    }
    table tr{
        background-color: white;
    }
    table h5{
        font-weight: 500;
        font-size: 14px;
        line-height: 19px;
        margin-bottom: 0px;
    }
    table small{
        color: #90a4ae;
        font-size: 13px;
        line-height: 17px;
    }
    table >tbody> tr > td {
        vertical-align: middle !important;
        margin: auto;
    }
    .sorting_1{
        padding-left: 20px !important;
    }
	</style>
	<table id="employees_table" class="table">
    <thead>
        <tr>
            <td align="left">#</td>
            <td>Employee</td>
            <td>EID</td>
            <td align="center">Team</td>
            <td align="center">Supervisor</td>
            <td>Hired Date</td>
            <td align="center">Action</td>
        </tr>        
    </thead>
    <tbody>
         <?php $counter = 0; ?>
        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->prettydatehired() }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach
        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach
        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach
        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach
        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach

        @foreach($employees as $employee)
            <tr>
                <td>{{ ++$counter }}</td>
                <td style="max-width: 250px;">
                    <div class="circle pull-left" style="float: left !important">J</div>
                    <h5 style="text-align: left !important;">{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}</h5>
                    <small style="text-align: left !important;">{{ $employee->position_name }}</small>
                </td>
                <td >{{ $employee->eid }}</td>
                <td align="center">{{ $employee->team_name }}</td>
                <td align="center">{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td align="center">
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    @if(Auth::user()->usertype == 1)
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                        <a href="#" data-toggle="modal" data-target="#messageModal" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
                    @endif
            </tr>

        @endforeach
    </tbody>
</table>
@endsection