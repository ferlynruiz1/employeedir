@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Leave Requests</div>
			<div class="pane-body panel">
				<br>
				<br>
				<table class="table">
					<thead>
						<tr>
							<td>ID</td>
							<td>Employee</td>
							<td>Leave Dates</td>
							<td>No. Of Days</td>
							<td>Status</td>
							<td>Date Requested</td>
							<td width="100px">Options</td>
						</tr>
					</thead>
					<tbody>
						@foreach($leave_requests as $leave_request)
						<tr>
							<td>{{ $leave_request->id }}</td>
							<td>{{ $leave_request->employee->fullName2() }}</td>
							<td>{{ prettyDate($leave_request->leave_date_from) }} - {{ prettyDate($leave_request->leave_date_to) }} </td>
							<td>{{ (int)$leave_request->number_of_days }}</td>
							<td>{{ $leave_request->status() }}</td>
							<td>{{ prettyDate($leave_request->date_filed) }}</td>
							<td width="100px" align="center">
								<a href="{{url('leave') . '/' . $leave_request->id}}" title="View" data-id="{{ $leave_request->id }}" class="btn_view"><span class="fa fa-eye"></span></a>
								&nbsp;&nbsp;
								<!-- <a href="" title="Edit"><span class="fa fa-pencil"></span></a>
								&nbsp;&nbsp; -->
								<!-- <a href="" title="Approve"><span class="fa fa-thumbs-up"></span></a>
								&nbsp;&nbsp;
								<a href="" title="Disapprove"><span class="fa fa-thumbs-down"></span></a> -->
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
	// $(document).ready(function(){
	// 	$('.btn_view').click(function(){

	// 	});
	// });
</script>
@endsection