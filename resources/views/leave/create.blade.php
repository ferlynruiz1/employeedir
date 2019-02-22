@extends('layouts.main')
@section('content')
    <style>
    @include('leave.leave-style');
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    LEAVE APPLICATION FORM
                </div>
                <div class="panel-body timeline-container ">
                    <div class="flex-center position-ref full-height">
                        <!-- <center><h2>LEAVE APPLICATION FORM</h2></center> -->
                        <form action="{{ url('leave') }}" method="post">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group float-left">
                                        <strong><p>&nbsp;</p></strong>
                                    </div> 
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <strong><p>Date Filed: </p></strong>
                                    <div class="form-group float-right">
                                        <input type="text" value="{{ date('m/d/Y') }}" name="date_filed" id="datepicker" class="form-control" placeholder="Date Filed" readonly>
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <strong><p>Name: </p></strong>
                                    <div class="form-group">
                                        <select name="employee_id" class="form-control" {{ Auth::user()->isAdmin() ? '' : 'readonly' }}>
                                            <option></option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}" {{ Auth::user()->id == $employee->id ? 'selected' : '' }} >{{ $employee->fullName2() }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <strong><p>From:</p></strong>
                                    <div class="form-group">
                                        
                                        <input type="text" name="leave_date_from" id="datepicker2" class="form-control" placeholder="From">
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <strong><p>Position:</p></strong>
                                    <div class="form-group">
                                        <input type="text" id="txtPhone" name="position" class="form-control" placeholder="Position" value="{{ Auth::user()->position_name }}" {{ Auth::user()->isAdmin() ? '' : 'readonly' }}>
                                    </div> 
                                    <strong><p>To:</p></strong>
                                    <div class="form-group">
                                        <input type="text" name="leave_date_to" id="datepicker3" class="form-control" placeholder="To">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <strong><p>Department:</p></strong>
                                    <div class="form-group">
                                        <input type="text" name="department" class="form-control email" placeholder="Dept/Section" value="{{ Auth::user()->team_name }}" {{ Auth::user()->isAdmin() ? '' : 'readonly' }}>
                                    </div> 
                                    <strong><p>Number of Days:</p></strong>
                                    <div class="form-group">
                                        <input type="text" name="number_of_days" class="form-control" placeholder="No. of Days">
                                    </div>
                                </div>

                                <!-- TYPE OF LEAVE -->
                                <div class="col-md-12" style="border-top: 1px solid rgba(0,0,0,.125); padding-top: 15px; margin-top: 25px">
                                    <strong><p>Type of Leave:</p></strong>
                                </div>
                                <div class="row" style="padding-bottom: 25px; margin-bottom: 25px;">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid rgba(0,0,0,.125);">
                                                <div class="form-group">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <label class="switch float-left">
                                                                <input type="checkbox" name="leave_type_id" value="1" id="progress1" tabIndex="1" class="primary" onClick="ckChange(this)">
                                                                <span class="slider"></span>
                                                            </label>&nbsp;
                                                            <span>Paternity Leave</span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <label class="switch float-left">
                                                                <input type="checkbox" name="leave_type_id" value="2" id="progress2" tabIndex="1" class="primary" onClick="ckChange(this)">
                                                                <span class="slider"></span>
                                                            </label>&nbsp;
                                                            <span>Maternity Leave</span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <label class="switch float-left">
                                                                <input type="checkbox"name="leave_type_id" value="3" id="progress3" tabIndex="1" class="primary" onClick="ckChange(this)">
                                                                <span class="slider"></span>
                                                            </label>&nbsp;
                                                            <span>Vacation Leave</span>
                                                        </li>
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <label class="switch float-left">
                                                                <input type="checkbox" name="pay_type_id" value="1" id="pay1" class="primary" onClick="ckChange(this)">
                                                                <span class="slider"></span>
                                                            </label>&nbsp;
                                                            <span>With Pay</span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <label class="switch float-left">
                                                                <input type="checkbox" name="pay_type_id" value="2" id="pay2" class="primary" onClick="ckChange(this)">
                                                                <span class="slider"></span>
                                                            </label>&nbsp;
                                                            <span>Without Pay</span>
                                                        </li>
                                                    </ul>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row report-date-box">
                                            <div class="col-xs-3">I will report for work on</div>
                                            <div class="col-xs-2"><input type="text" name="report_date" id="datepicker4" class="form-control report_Date" placeholder="date"></div>
                                            <div class="col-xs-7">If i fail to do so on the said date without any justifiable cause. </div>
                                            <span>I can considered to have abandoned my employment. I understand that any misrepresentation I make on this request is a serious offense and shall be a valid ground for disciplinary action against me.</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END TYPE OF LEAVE -->

                                <!-- REASON -->
                                <div class="col-md-12" style="border-top: 1px solid rgba(0,0,0,.125); padding-top: 15px; margin-top: 25px">
                                   
                                </div>
                                <div class="col-md-6">
                                    <strong><p>Reason:</p></strong>
                                    <div class="form-group">
                                        <textarea name="reason" class="form-control" rows="4"></textarea>
                                    </div> 
                                </div>

                                <div class="col-md-6">
                                    <strong><p>Contact Number: </p></strong>
                                    <div class="form-group">
                                        <input type="text" name="contact_number" class="form-control">
                                    </div> 
                                </div>
                            </div> 
                            <div class="form-group">
                                <input type="submit" id="register-button" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', forced_root_block : 'p' });</script> -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#opportunity-table').DataTable();
    });
    
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#datepicker3').datepicker({
        uiLibrary: 'bootstrap4'
    });
    $('#datepicker4').datepicker({
        uiLibrary: 'bootstrap4'
    });

    //disable remaining checkbox Leave type
    function ckChange(ckType){
        var ckName = document.getElementsByName(ckType.name);
        var checked = document.getElementById(ckType.id);

        if (checked.checked) {
            for(var i=0; i < ckName.length; i++){

                if(ckName[i] != checked){
                    $(ckName[i]).prop('checked', false);
                }
            } 
        }    
    }

    //disable remaining checkbox Pay type
    // function ck2Change(ckType){
    //     var ckName = document.getElementsByName(ckType.name);
    //     var checked = document.getElementById(ckType.id);

    //     if (checked.checked) {
    //     for(var i=0; i < ckName.length; i++){

    //         if(!ckName[i].checked){
    //             ckName[i].disabled = true;
    //         }else{
    //             ckName[i].disabled = false;
    //         }
    //     } 
    //     }
    //     else {
    //     for(var i=0; i < ckName.length; i++){
    //         ckName[i].disabled = false;
    //     } 
    //     }    
    // }

</script>
@endsection