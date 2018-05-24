@extends('layouts.main')
@section('title')
Employee Import
@endsection
@section('pagetitle')
Employee / Import
@endsection
@section('content')
<style type="text/css">
    label#bb {
        padding: 10px;
        display: table;
        background-color: #30a5ff;
        color: white;
    }
    #bb input[type=file]{
        display: none;
    }
    #result_messaging_div{
        display: none;
    }
</style>
    <div class="col-md-4">
        <div class="section-header">
            <h4>Run Cron Job</h4>
        </div>
        <div class="panel panel-container">
            <div class="panel-body">
                <p>Click the button below to run masterlist and attrition cron jobs.</p>
                    <button id="sync_now" class="btn btn-success pull-right" style="background-color: #388E3C">
                        Sync Now
                    </button>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="result_messaging_div">
        <div class="section-header">
            <h4>Sync Result</h4>
        </div>
        <div class="panel panel-container">
            <div class="panel-body">
                <div class="col-md-6" style="padding: 0px !important;">
                    <p>Deleted Employees</p>
                    <a type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Button with data-target
                      </a>
                    <div class="collapse in" id="collapseExample">
                      <div class="card card-body" id="deleted_employees_div">

                      </div>
                    </div>
                </div>
                <div class="col-md-6" style="padding: 0px !important;">
                    <p>Inserted Employees</p>
                    <a  type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Button with data-target
                      </a>
                    <div class="collapse in" id="collapseExample">
                      <div class="card card-body" id="inserted_employee_div">

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
@endsection
@section('scripts')
<script type="text/javascript">
    var cronimport = false;
    var cronattrition = false;
    var import_result;
    var attrition_result;

    function checkSuccess(){
        if(cronimport && cronattrition) {
            alert("success");
            for (var i = 0; i < attrition_result.deleted ; i++) {
                $('#deleted_employees_div').append('<p>' + attrition_result.deleted[i] + '</p>');
            }
            // for (var i = 0; i < import_result.deleted ; i++) {
            //     $('#inserted_employee_div').append('<p>' + import_result.inserted[i] + '</p>');
            // }
            $('#result_messaging_div').show();
        }
    }
    $('#sync_now').click(function(){
        cronimport = false;
        cronattrition = false;
        $.ajax({url: "{{ url('/cron/importlatest') }}", success: function(result){
            import_result = result;
            console.log(result);
            cronimport = true;
            checkSuccess();
            },
        dataType: "json"
        });

        $.ajax({url: "{{ url('/cron/attrition') }}", success: function(result){
            attrition_result = result;
              console.log(result);
              cronattrition = true;
              checkSuccess();
              console.log();
            },
            dataType: "json"
        });
    });
</script>
@endsection