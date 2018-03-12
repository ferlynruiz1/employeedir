@extends('layouts.main')

@section('title')
Department / Add New
@endsection

@section('pagetitle')
Department / Add New
@endsection

@section('content')
	<style type="text/css">
        .row.margin-container{
            margin: 10px;
        }
	</style>
    <form role="form" method="POST" action="{{ route('department.store')}}" >
        {{ csrf_field() }}
   <div class="col-md-3" style="">
      <div class="section-header">
         <h4>New Department</h4>
      </div>
      <div class="panel panel-container">
            <div class="row margin-container">
                <div class="form-group">
                    <label>Department Name</label>
                    <input type="text" name="department_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Division </label>
                    <select class="select2 form-control"  name="division_id">
                        <option selected="" disabled="">Select</option>
                        @foreach($divisions as $division)
                        <option value="{{ $division->id }}"> {{$division->division_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Account </label>
                    <select class="select2 form-control"  name="account_id">
                        <option selected="" disabled="">Select</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}"> {{$account->account_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Manager</label>
                    <select class="select2 form-control"  name="manager_id">
                        <option selected="" disabled="">Select</option>
                        @foreach($managers as $manager)
                            <option value="{{ $manager->id }}"> {{$manager->fullname()}}</option>
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