@extends('layouts.main')
@section('content')
    <style type="text/css">
        small.leave-success{
            color: green;
        }
    </style>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Leave Credit
                </div>
                <div class="panel panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('leave/credits') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <p>{{ $employee->fullName2() }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Department</label>
                                    <p>{{ $employee->team_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <p>{{ $employee->position_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Remaining Leave Credits</label>
                                    <input type="number" class="form-control" value="{{ $employee->leave_credit }}" name="leave_credits">
                                    <input type="hidden" class="form-control" value="{{ $employee->id }}" name="employee_id">
                                </div>
                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection