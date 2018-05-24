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
    <br>
    <br>
    <br>
@endsection
@section('scripts')
<script type="text/javascript">
    var cronimport = false;
    var cronattrition = false;
    function checkSuccess(){
        if(cronimport && cronattrition) {
            alert("success");
        }
    }
    $('#sync_now').click(function(){
        $.ajax({url: "{{ url('/cron/attrition') }}", success: function(result){
              console.log(result);
              cronattrition = true;
              checkSuccess();
              console.log();
            },
            dataType: "json"
          });
        $.ajax({url: "{{ url('/cron/importlatest') }}", success: function(result){
              console.log(result);
              cronimport = true;
              checkSuccess();
            },
            dataType: "json"
          });
    });
</script>
@endsection