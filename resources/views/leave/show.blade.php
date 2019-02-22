@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Leave Request Information
			</div>
			<div class="panel panel-body">
				<div id="printable">
					<center>
						<img src="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png" style="width: 80px; height: 80px;"> 
						<b style="font-size: 18px;">&nbsp;eLink Systems & Concepts Corp.</b>
						<br>
						<br>
						<b style="font-size: 20px;">LEAVE APPLICATION FORM</b>
					</center>
					<div style="width: 100%; display: flex; direction: rtl;">
						<div style="width: 200px; float: right; padding: 2px; text-align: left;">
							<b>{{ slashedDate($leave_request->date_filed) }}</b>
							<label>Date filed</label>

						</div>
					</div>
					<div class="col-md-4">
						<label>Name: </label>
						<b>{{ $leave_request->employee->fullName2() }}</b>
					</div>
					<div class="col-md-4">
						<label>Position: </label>
						<b>{{ $leave_request->employee->position_name }}</b>
					</div>
					<div class="col-md-4">
						<label>Dept/Section: </label>
						<b>{{ $leave_request->employee->team_name }}</b>
					</div>
					<br>
					<div style="width: 100%;">
					<!-- 	<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>Name: </label>
							<b>{{ $leave_request->employee->fullName2() }}</b>
						</div>
						<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>Position: </label>
							<b>{{ $leave_request->employee->position_name }}</b>
						</div>
						<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>Dept/Section: </label>
							<b>{{ $leave_request->employee->team_name }}</b>
						</div>
					</div>
					<div style="width: 100%; display: flex;">
						<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>From: </label>
							<b>{{ slashedDate($leave_request->leave_date_from) }}</b>
						</div>
						<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>To: </label>
							<b>{{ slashedDate($leave_request->leave_date_to) }}</b>
						</div>
						<div style="border: 1px solid black; width: 33.3%; float: right; padding: 2px;">
							<label>No. of Days: </label>
							<b>{{ $leave_request->number_of_days }}</b>
						</div>
					</div> -->
						<table style="border-collapse: collapse; width: 100%;">
							<tr>
								<td style="width: 33.3%; padding: 2px;">
									<label>Name: </label>
									<b>{{ $leave_request->employee->fullName2() }}</b>
								</td>
								<td style="width: 33.3%; padding: 2px;">
									<label>Position: </label>
								<b>{{ $leave_request->employee->position_name }}</b>
								</td>
								<td style="width: 33.3%; padding: 2px;">
									<label>Dept/Section: </label>
								<b>{{ $leave_request->employee->team_name }}</b>
								</td>
							</tr>
							<tr>
								<td style="width: 33.3%; padding: 2px;">
									<label>From: </label>
									<b>{{ slashedDate($leave_request->leave_date_from) }}</b>
								</td>
								<td style="width: 33.3%; padding: 2px;">
									<label>To: </label>
									<b>{{ slashedDate($leave_request->leave_date_to) }}</b>
								</td>
								<td style="width: 33.3%; padding: 2px;">
									<label>No. of Days: </label>
									<b>{{ $leave_request->number_of_days }}</b>
								</td>
							</tr>
							<tr>
								<td style=" padding: 2px; display: flex;">
									<div style="width: 50%;">
										<label>Type of Leave: </label>
										<br>
										<br>
										@foreach($leave_types as $leave_type)
											<input type="checkbox" value="{{ $leave_type->id}}" name="" {{ $leave_type->id == $leave_request->leave_type_id ? 'checked' : ''}}> &nbsp; {{ $leave_type->leave_type_name }} <br>
										@endforeach
									</div>
									<div  style="width: 50%;">
										<br>
										<br>
										@foreach($pay_types as $pay_type)
											<input type="checkbox" name="" {{ $pay_type->id == $leave_request->pay_type_id ? 'checked' : ''}}> &nbsp; {{ $pay_type->pay_type_name }} <br>
										@endforeach
									</div>
								</td>
								<td style="padding: 2px;" colspan="2">
									I will report for work on <span style="text-decoration: underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ slashedDate($leave_request->report_date) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>.If i fail to do so on the said date without any justifiable cause. I can considered to have abandoned my employment. I understand that any misrepresentation I make on this request is a serious offense and shall be a valid ground for disciplinary action against me.
								</td>
							</tr>
							<tr>
								<td>
									<br>
									<br>
									<label>Reason</label>
									<p>{{$leave_request->reason}}</p>
									<br>
									Contact Number: <b style="text-decoration: underline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $leave_request->contact_number }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
								</td>
								<td colspan="2">
									
								</td>
							</tr>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection