@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Leave Credits
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                            <a href="{{ url('leave') }}" class="pull-right btn btn-primary"><span class="fa fa-gear"></span>View Leave Lists</a>
                        @endif
                    @endif
                </div>
                <div class="pane-body panel">
                    <br>
                    <br>
                    <table class="table table-striped" id="leave_credits_table">
                        <thead>
                        <tr>
                            <td>DB ID</td>
                            <td>Employee ID</td>
                            <td>Employee Name</td>
                            <td>Position</td>
                            <td>Department</td>
                            <td>Leave Credits</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->eid }}</td>
                                <td>{{ $employee->fullName2() }}</td>
                                <td>{{ $employee->position_name }}</td>
                                <td>{{ $employee->team_name }}</td>
                                <td>{{ $employee->leave_credit }}</td>
                                <td>
                                    <a title="Adjust leave credits" href="{{ url('leave/credits') . '/' . $employee->id }}"><i class="fa fa-gear"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#leave_credits_table').dataTable({
            "pageLength": 50
        });
    </script>
@endsection