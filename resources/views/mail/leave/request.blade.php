<div>
	<center>
		<img src="{{ $message->embed('http://localhost/elinkemployeedirectory/public/img/elink-logo-site.png') }}" style="width: 40px; margin-bottom: -20px;">
		<small style="padding: 20px 0 20px 0;font-size: 14px;">eLink Systems &amp; Concepts Corp.</small>
	</center>

	@if($leave_request)
		Hi {{ $leave_request->employee->supervisor->first_name }},
		<br>
		<br>
		{{ $leave_request->employee->first_name }} requested to leave for <b>{{ $leave_request->leaveDays() }}</b> from <b>{{ prettyDate($leave_request->leave_date_from) }}</b> to <b>{{ prettyDate($leave_request->leave_date_to ) }}</b>.
		<br>
		This request needs your recommendation. Please click on the button below.
		<br>
		<br>
		<a href="{{ url('leave').'/'.$leave_request->id }}" style="background-color: #30a5ff; color: white; border: none; padding: 6px 12px;    text-decoration: none;">View Leave Request</a>
	@endif
	<br>
	<br>
	<br>
	Sincerely,
	<br>
	Employee Directory Admin
</div>