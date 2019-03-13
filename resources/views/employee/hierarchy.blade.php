@extends('layouts.main')
@section('content')
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			Change Employee Hierarchy Image
		</div>
		<div class="panel-body">
			<form enctype="multipart/form-data" method="POST" action=""> 
				{{ csrf_field() }}
				<div class="form-group">
					<input type="file" name="file">
				</div>
				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
</div>
@endsection