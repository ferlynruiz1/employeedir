@extends('layouts.main')
@section('title')
Employees
@endsection
@section('pagetitle')
Employees
@endsection
@section('content')
    <style type="text/css">
    	body{
            background-image: url({{asset('public/img/002-subtle-light-pattern-background-texture.jpg')}});
        }
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
        a.btn.btn-primary, a.btn.btn-warning {
            float: right;
            margin: 10px;
        }
    </style>

    <a href="{{url('employee_info/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i>
        &nbsp;&nbsp;Add Employee
    </a>
    <a href="{{url('export')}}" class="btn btn-warning">
        <i class="fa fa-download"></i>
        &nbsp;&nbsp;Generate Report
    </a>
    <div class="section-header">
        <h4>List of Employees</h4>
    </div>
	<table id="employees_table" class="table">
        <thead>
            <tr>
                <td>#</td>
                <td>Employee</td>
                <!-- <td>EID</td> -->
                <td>Email</td>
                <td >Team/Department</td>
                <td >Supervisor</td>
                <td >Manager</td>
                <td >Division</td>
                <td >Account</td>
                <td>Production Date</td>
                <td >Action</td>
            </tr>        
        </thead> 
        <tbody>
            <?php $counter = 0; ?>
            @foreach($employees as $employee)
                <tr> 
                    <td>{{ ++$counter }}</td>
                    <td style="width: 250px;">
                        @if(isset($employee->profile_img))
                         <img alt="image" id="profile_image" class="img-circle pull-left" style="width: 40px; height: 40px; margin: 10px;" src="{{ $employee->profile_img }}" style="float: left !important">
                         @else
                        <div class="circle pull-left" style="float: left !important">J</div>
                        @endif
                        <h5 style="text-align: left !important;">
                            {{ $employee->first_name . ' ' . $employee->middle_name . " " .  $employee->last_name  }}
                        </h5>
                        <small style="text-align: left !important;">
                            {{ $employee->position_name }}
                        </small>
                    </td>
                    <!-- <td>{{ $employee->eid }}</td> -->
                    <td style="color: #00B0FF;"><a href="mailto:{{$employee->email}}"> {{ $employee->email }}</a></td>
                    <td>{{ $employee->team_name }}</td>
                    <td>{{ @$employee->supervisor_name }}</td>
                    <td>{{ @$employee->manager_name }}</td>
                    <td>{{ @$employee->division_name }}</td>
                    <td>{{ @$employee->account->account_name }}</td>
                    <td>{{ $employee->prettyproddate() }}</td>
                    <td>
                        <a href="{{ url('/employee_info/'. $employee->id)}}" target="_blank" title="View">
                            <i class="fa fa-eye"></i>
                        </a>&nbsp;&nbsp;
                        <a href="{{ url('/employee_info/'. $employee->id . '/edit')}}" target="_blank" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;&nbsp;
                        <a href="#"  class="delete_btn" data-toggle="modal" data-target="#messageModal" title="Delete" data-id="{{$employee->id}}">
                            <i class="fa fa-trash" style="color: red;" ></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        $('.delete_btn').click(function(){
            $('#messageModal .modal-title').html('Delete Employee');
            $('#messageModal #message').html('Are you sure you want to delete the employee ?');

            $('#messageModal .delete_form').attr('action', "{{ url('employee_info') }}/" + $(this).attr("data-id"));
        });
        $('#messageModal #yes').click(function(){
            $('#messageModal .delete_form').submit();
        });
    </script>
@endsection