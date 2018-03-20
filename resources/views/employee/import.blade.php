@extends('layouts.main')
@section('title')
View Profile
@endsection
@section('pagetitle')
Employee / Import
@endsection
@section('content')
    <br>
    <br>
    <br>
    <form enctype="multipart/form-data" action="{{ url('employees/import')}}" method="POST">
        <input type="file" name="dump_file">
        {{ csrf_field() }}
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>
    <br>
    <br>
    <br>
@endsection