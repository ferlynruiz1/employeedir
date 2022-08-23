@extends('layouts.main')
@section('content')
    <style type="text/css">
        small.leave-success{
            color: green;
        }
    </style>
    <div class="row">
        <div class="col-md-4">
            <a href="{{route('expanded.credits')}}" class="btn btn-primary" style="margin-bottom: 1rem;">Back</a>
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
                                    <input type="number" class="form-control" disabled value="{{number_format($credits->current_credit, 2)}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Leave Credit to be Added</label>
                                    <input type="number" name="leave_credits" id="leave_credits" class="form-control" step="0.01">
                                </div>
                                <input type="hidden" class="form-control" value="{{ $employee->id }}" name="employee_id">
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