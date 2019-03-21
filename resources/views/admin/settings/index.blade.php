@extends('layouts.main')
@section('title')
    Settings
@endsection
@section('pagetitle')
    Settings
@endsection
@section('content')
    <style>
        .settings-table{
            width: 100%;
        }
        .settings-table tr td{
            border-bottom: 1px dashed lightgrey;
        }
    </style>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Global Settings
            </div>
            <div class="panel panel-body">
                <form action="{{ url('settings') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <table class="settings-table">
                            <tr>
                                <td><input type="checkbox" id="email_notification" name="email_notification" {{ $email_notification ? "checked" : '' }}></td>
                                <td><label for="email_notification">Enable Email Notification</label></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection