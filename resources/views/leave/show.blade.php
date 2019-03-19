@extends('layouts.main')
@section('content')
<style type="text/css">
	small.leave-success{
		color: green;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Leave Request Information
			</div>
			<div class="panel panel-body">
				<div class="row" id="printable">
					<center>
						<img src="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png" style="width: 80px; height: 80px;"> 
						<b style="font-size: 18px;">&nbsp;eLink Systems & Concepts Corp.</b>
						<br>
						<br>
						<b style="font-size: 20px;">LEAVE APPLICATION REQUEST</b>
					</center>

					<div class="col-md-12" style="border-top: 1px solid rgba(0,0,0,.125); padding-top: 15px; margin-top: 15px; padding-left: 0px;">
                    </div>
					<br>
					<br>
					<div class="col-md-4">
						<label>Date filed:</label>
						<p>{{ slashedDate($leave_request->date_filed) }}</p>
					</div>
					
					<div class="col-md-4">
						<label>From: </label>
						<p>{{ prettyDate($leave_request->leave_date_from) }}</p>
					</div>

					<div class="col-md-4">
						<label>To: </label>
						<p>{{ prettyDate($leave_request->leave_date_to) }}</p>
					</div>
					<div class="col-md-12">
						&nbsp;
					</div>
					<div class="col-md-4">
						<label>Name: </label>
						<p>{{ $leave_request->employee->fullName2() }}</p>
					</div>
					<div class="col-md-4">
						<label>Position: </label>
						<p>{{ $leave_request->employee->position_name }}</p>
					</div>

					<div class="col-md-4">
						<label>Dept/Section: </label>
						<p>{{ $leave_request->employee->team_name }}</p>
					</div>
					<div class="col-md-12">
						&nbsp;
					</div>
					<div class="col-md-4">
						<label>No. of Days: </label>
						<p>{{ $leave_request->number_of_days }}</p>
					</div>
					<div class="col-md-4">
						<label>Type of Leave:</label>
						<p>{{ $leave_request->leave_type->leave_type_name . ' ' . $leave_request->pay_type->pay_type_name }}</p>
					</div>
					<div class="col-md-4">
						<label>Contact Number:</label>
						<p>{{ $leave_request->contact_number }}</p>
					</div>
					<div class="col-md-12">
						&nbsp;
					</div>
					<div class="col-md-4">
						<label>Report Date:</label>
						<p>{{ prettyDate($leave_request->report_date) }}</p>
					</div>
					<div class="col-md-8">
						<label>Reason:</label>
						<p>{{ $leave_request->reason }}</p>
					</div>
					<div class="col-md-12">
						<br>
						<br>
					</div>
					<div class="col-md-4">
						
						<label>Recommending Approval:</label>
						<p>{{ $leave_request->employee->supervisor == NULL ? '' : $leave_request->employee->supervisor->fullName2() }}{{ $leave_request->employee->supervisor_id == Auth::user()->id ? '(You)' : ''}}</p>
						<small {{ $leave_request->recommending_approval_by_signed_date === NULL ? '' : 'class=leave-success' }}>{{ $leave_request->recommending_approval_by_signed_date === NULL ? 'Not yet recommended' : 'Recommended last ' .  prettyDate($leave_request->recommending_approval_by_signed_date) }}</small>
						<br>
						<br>
					</div>
					<div class="col-md-4">
						<label>Approved by:</label>
						<p>{{ $leave_request->employee->manager == NULL ? '' : $leave_request->employee->manager->fullName2() }} {{ $leave_request->employee->manager_id == Auth::user()->id ? '(You)' : ''}}</p>
						<small {{ $leave_request->approved_by_signed_date === NULL ? '' : 'class=leave-success' }}>{{ $leave_request->approved_by_signed_date === NULL ? 'Not yet approved' : 'Approved last ' .  prettyDate($leave_request->approved_by_signed_date) }}</small>
						<br>
						<br>
					</div>
					<div class="col-md-4">
						<label>Approve Status:</label>
						<p><?php echo $leave_request->getApprovalStatus() ?></p>
						<br>
						<br>
					</div>
					<div class="col-md-12" style="border-top: 1px solid rgba(0,0,0,.125); padding-top: 15px; margin-top: 0px; padding-left: 0px;">
                    </div>
                    <div class="col-md-6">
                    	@if(Auth::user()->isAdmin())
                    		<label>{{ $leave_request->employee->first_name }}'s Remaining Leave Credits:</label>
                    		<p>{{ $leave_request->employee->leave_credit }}</p>
                    	@endif
                    </div>
					<div class="col-md-6" style="direction: rtl">
						@if($leave_request->isForRecommend())
							<form action="{{ url('leave/recommend') }}" method="POST" style="display: inline-flex;">
								{{ csrf_field() }}
								<input type="hidden" name="leave_id" value="{{ $leave_request->id }}">
								<button class="btn btn-primary">Approve</button>
							</form>
						@elseif($leave_request->isForApproval())
							<form action="{{ url('leave/approve') }}" method="POST" style="display: inline-flex;">
								{{ csrf_field() }}
								<input type="hidden" name="leave_id" value="{{ $leave_request->id }}">
								<button class="btn btn-primary">Approve</button>
							</form>
						@endif
						@if($leave_request->isForNoted())
							<form action="{{ url('leave/noted') }}" method="POST" style="display: inline-flex;">
								{{ csrf_field() }}
								<input type="hidden" name="leave_id" value="{{ $leave_request->id }}">
								<button class="btn btn-primary">Noted</button>
							</form>
						@endif
						@if($leave_request->canBeDeclined())
							<button class="btn btn-danger" data-target="#declinemodal" data-toggle="modal">Decline</button>
						@endif
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
	<div id="declinemodal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #0086CD;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white !important;opacity: 1;">×</button>
					<h4 class="modal-title"><b style="color: white">Reason for declining</b></h4>
				</div>
				<div class="modal-body">
					<div clas="row">
						<form action="{{ url('leave/decline') }}" method="POST">
							<div class="form-group">
								{{ csrf_field() }}
								<p>You are about to decline a leave request. You may write a reason why.</p>
							</div>
							<div class="form-group">
								<textarea class="form-control" name="reason_for_disapproval" style="resize: vertical;"></textarea>
								<input type="hidden" name="leave_id" value="{{ $leave_request->id }}">
							</div>
							<div class="col-md-12">
								<br>
								<button type="submit" class="btn btn-primary pull-right" style="margin-top: 5px;">Submit</button>
								<button type="button" class="btn btn-default pull-right" style="margin-top: 5px; margin-right: 5px;" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">

				</div>
			</div>
		</div>
	</div>
@endsection