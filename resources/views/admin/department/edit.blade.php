@extends('layouts.main')

@section('title')
Department / Edit 
@endsection

@section('pagetitle')
Department / Edit 
@endsection

@section('content')
	<style type="text/css">
        .row.margin-container{
            margin: 10px;
        }
	</style>
    {{ Form::open(array('url' => 'department/' . $department->id,'id' => 'edit_employee_form')) }}
    {{ Form::hidden('_method', 'PUT') }}
    {{ csrf_field() }}
   <div class="col-md-3" style="">
    <div class="section-header">
      <h4>Edit Department</h4>
  </div>
      <div class="panel panel-container">
            <div class="row margin-container">
                <div class="form-group">
                    <label>Department Name</label>
                    <input type="text" name="department_name" class="form-control" value="{{ $department->department_name}}">
                </div>
                <div class="form-group">
                    <label>Division </label>
                    <select class="select2 form-control"  name="division_id">
                        <option selected="" disabled="">Select</option>
                        @foreach($divisions as $division)
                            <option {{ $department->division_id == $division->id ? 'selected' : '' }} value="{{ $division->id }}"> {{$division->division_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Account </label>
                    <select class="select2 form-control"  name="account_id"  >
                        <option selected="" disabled="">Select</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ $department->account_id == $account->id ? 'selected' : '' }}> {{$account->account_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Manager</label>
                    <select class="select2 form-control"  name="manager_id" >
                        <option selected="" disabled="">Select</option>
                        @foreach($managers as $manager)
                            <option value="{{ $manager->id }}" {{ $department->manager_id == $manager->id ? 'selected' : '' }} > {{$manager->fullname()}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="form-group">
                    <button class="btn btn-primary">Save</button>               
                </div>      
            </div><!--/.row-->
        </div>
  </div>
</form>
@endsection