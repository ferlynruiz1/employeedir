@extends('layouts.main')
@section('title')
Employees
@endsection
@section('pagetitle')
Employees
@endsection
@section('content')
    <style type="text/css">
        #employees_table_wrapper{
            background-color: #fff;
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
        table tr {
            background-color: #fff;
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
        a.btn.btn-primary, a.btn.btn-warning, a.btn.btn-success{
            float: right;
            margin: 10px;
        }
        .alphabet-search{
        display: inline-flex;
        list-style: none;
        }
        .alphabet-search li{
            margin-left: 10px;
        }
        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #fff !important;
        }
        .table-striped>tbody>tr:nth-of-type(even) {
            background-color: #fbfbfb !important;
        }
        .table-striped > thead > tr {
            background-color: #f8f8f8 !important;
            padding-top: 10px;
        }
    </style>

    <div class="section-header">
        <h4>List of Separated Employees</h4>
    </div>
    <br>
    <br>
	<table id="employees_table" class="table table-striped">
        <thead>
            <tr>
                <td data-priority="1">#</td>
                <td data-priority="2">Employee</td>
                <td data-priority="4">Email <br> <small>Phone name and ext</small></td>
                <td>Team/Department</td>
                <td>Supervisor</td>
                <!-- <td >Manager</td> -->
                <!-- <td >Division</td> -->
                <!-- <td >Account</td> -->
                <td>Production Date</td>
                <td data-priority="3">Action</td>
            </tr>        
        </thead> 
        <tbody>
            <?php $counter = 0; ?>
            @foreach($employees as $employee)
                <tr> 
                    <td>{{ ++$counter }}</td>
                    <td >
                        @if(isset($employee->profile_img))
                         <div style="background-image: url('{{ $employee->profile_img }}'); width: 40px; height: 40px; background-size: cover; background-repeat: no-repeat; background-position: 50% 50%; box-shadow: 1px 1px 10px 7px #fff; float: left; margin-right: 10px;">
                        </div>
                         @else
                        <div class="circle pull-left" style="float: left !important">J</div>
                        @endif
                        <h5 style="text-align: left !important;">
                            {{ $employee->first_name . ' ' .  $employee->last_name  }}
                        </h5>
                        <small style="text-align: left !important;">
                            {{ $employee->position_name }}
                        </small>
                    </td>
                    <td><a href="mailto:{{$employee->email}}"> {{ $employee->email }} 
                        </a>
                        <br>
                        {{ $employee->alias }}
                        @if($employee->ext != '' && isset($employee->ext))
                        <br>
                        <small>ext: {{$employee->ext}}</small>
                        @endif
                    </td>
                    <td >{{ $employee->team_name }}</td>
                    <td>{{ @$employee->supervisor_name }}</td>
                    <!-- <td>{{ @$employee->manager_name }}</td> -->
                    <!-- <td>{{ @$employee->division_name }}</td> -->
                    <!-- <td>{{ @$employee->account->account_name }}</td> -->
                    <td>{{ $employee->prodDate() }}</td>
                    <td>

                        <a href="{{ url('/employee_info/'. $employee->id)}}" title="View">
                            <i class="fa fa-eye"></i>
                        </a>&nbsp;&nbsp;
                        
                        @if($employee->deleted_at == null)
                        <a href="#"  class="delete_btn" data-toggle="modal" data-target="#messageModal" title="Deactivate" data-id="{{$employee->id}}">
                            <i class="fa fa-user-times" style="color: red;" ></i>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection