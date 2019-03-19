<div>
	<center>
		<small style="padding: 20px 0 20px 0;font-size: 14px;">eLink Systems &amp; Concepts Corp.</small>
	</center>

	@if($leave_request)
		Good day,
		<br>
		<br>
		{{ $leave_request->employee->first_name }} requested to leave for <b>{{ $leave_request->leaveDays() }}</b> from <b>{{ prettyDate($leave_request->leave_date_from) }}</b> to <b>{{ prettyDate($leave_request->leave_date_to ) }}</b>.
		<br>
		Please click on the button below.
		<br>
		<br>
		<a href="{{ url('leave').'/'.$leave_request->id }}">View Leave Request</a>
	@endif
	<br>
	<br>
	<br>
	Sincerely,
	<br>
	Employee Directory Admin
</div>