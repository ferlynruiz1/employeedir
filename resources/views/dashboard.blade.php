@extends('layouts.main')

@section('title')
Dashboard
@endsection

@section('content')
	<style type="text/css">
		body{
        background-image: url({{asset('public/img/002-subtle-light-pattern-background-texture.jpg')}});
    }

    div.circle{
        border-radius: 100px;
        border: 1px solid #eaeaea;
        width: 50px;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
        background-color: green;
        color: white;
    }
    table tr{
        background-color: white;
    }
    table h5{
        font-weight: 600;
        font-size: 14px;
        line-height: 19px;
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
	</style>

	<table class="table table-striped">
    <thead>
        <tr>
            <td></td>
            <td>Employee</td>
            <td>EID</td>
            <td>Team</td>
            <td>Supervisor</td>
            <td>Hired Date</td>
            <td>Action</td>
        </tr>        
    </thead>
    <tbody>
        @foreach($employees as $employee)
            <tr>
                <td style="width: 100px;"><div class="circle pull-right">J</div></td>
                <td style="max-width: 200px;">
                    <h5>{{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  .' (' . $employee->alias . ')' }}</h5>
                    <small>{{ $employee->position_name }}</small>
                </td>
                <td>{{ $employee->eid }}</td>
                <td>{{ $employee->team_name }}</td>
                <td>{{ $employee->supervisor_id }}</td>
                <td>{{ $employee->hired_date }}</td>
                <td>
                    <a href="{{ url('/employee_info/'. $employee->id)}}" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                    <a href="{{ url('/employee_info/'. $employee->id . '/delete')}}" title="Edit"><i class="fa fa-trash" style="color: red;"></i></a</td>
            </tr>

        @endforeach
    </tbody>
</table>
@endsection