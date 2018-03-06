<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eLink's Employee Directory | @yield('title')</title>

    <link rel="icon" type="image/png" href="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png">

    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.dataTables.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript" src="{{ asset('public/js/jquery.bootstrap-growl.min.js') }}"></script>

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('public/js/jquery-1.11.1.min.js')}}"></script>
</head>
<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #32373A !important;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="{{url('/home')}}"><span><img src="{{ asset('public/img/elink-logo-site.png')}}" style="width: 40px; margin-top: -10px">&nbsp;Employee</span>Directory</a>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-envelope"></em><!--     -->
                    </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                    </a>
                                    <div class="message-body"><small class="pull-right">3 mins ago</small>
                                        <a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
                                    <br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                    </a>
                                    <div class="message-body"><small class="pull-right">1 hour ago</small>
                                        <a href="#">New message from <strong>Jane Doe</strong>.</a>
                                    <br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="all-button"><a href="#">
                                    <em class="fa fa-inbox"></em> <strong>All Messages</strong>
                                </a></div>
                            </li>
                        </ul>
                    </li>
                   <!--  <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <em class="fa fa-bell"></em><span class="label label-info">5</span>
                    </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li><a href="#">
                                <div><em class="fa fa-envelope"></em> 1 New Message
                                    <span class="pull-right text-muted small">3 mins ago</span></div>
                            </a></li>
                            <li class="divider"></li>
                            <li><a href="#">
                                <div><em class="fa fa-heart"></em> 12 New Likes
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                            <li class="divider"></li>
                            <li><a href="#">
                                <div><em class="fa fa-user"></em> 5 New Followers
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <img alt="image" class="img-circle" style="width: 20px;" src="{{ Auth::user()->profile_img }}"><!-- <span class="label label-info">5</span> -->
                    </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li><a href="#">
                                <div><em class="fa fa-user"></em> Profile
                                    <span class="pull-right text-muted small">3 mins ago</span></div>
                            </a></li>
                            <li class="divider"></li>
                            <li><a href="#">
                                <div><em class="fa fa-sign-out"></em>Logout
                                    <span class="pull-right text-muted small">4 mins ago</span></div>
                            </a></li>
                        </ul>
                    </li>
                </ul>

                    
            </div>

        </div><!-- /.container-fluid -->
        <div class="navbar-header">
            <ul class="header-list">
                <li <?php echo \Request::url() == url('employees') ? 'class="active"' : ''; ?> ><a  href="{{ url('employees')}}">Home</a></li>
                <li <?php echo \Request::url() == url('employee_info/'. Auth::user()->id . '/') ? 'class="active"' : ''; ?>><a  href="{{ url('employees')}}">Profile</a></li>
                <li ><a  href="{{ url('employees')}}">Employees</a></li>
            </ul>
        </div>
    </nav>
    <p style="height: 40px;">&nbsp;
    </p>
    <div class="col-sm-12 main">
        <div class="row">
            <ol class="breadcrumb" style="background-color: #dcdcdc !important;">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard / @yield('pagetitle')</li>
            </ol>
        </div><!--/.row-->
        
        <div>
            @yield('content')
        </div>
    </div>  <!--/.main-->
    
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>

    <script src="{{ asset('public/js/chart.min.js')}}"></script>
    <script src="{{ asset('public/js/chart-data.js')}}"></script>
    <script src="{{ asset('public/js/easypiechart.js')}}"></script>
    <script src="{{ asset('public/js/easypiechart-data.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('public/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('public/js/jquery.validate.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
    <script src="{{ asset('public/js/global.js')}}"></script>
    <script src="{{ asset('public/js/custom.js')}}"></script>
    <!-- Modal -->
    <div id="messageModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p id="message">Some text in the modal.</p>
          </div>
          <div class="modal-footer">
             {{ Form::open(array('url' => 'employee_info/', 'class' => ' delete_form' )) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Yes', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div> 
    </div>
</body>
@if (session('success'))
    <div id="alertmodal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #2196F3;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white !important;opacity: 1;">×</button>
            <h4 class="modal-title"><b style="color: white">Success!</b></h4>
          </div>
          <div class="modal-body">
            <p>{{ session('success') }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
        $('#alertmodal').modal('show');
    </script>
@endif
@if (session('error'))
<div id="alertmodal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #d32f2f;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white !important;opacity: 1;">×</button>
            <h4 class="modal-title"><b style="color: white">Error!</b></h4>
          </div>
          <div class="modal-body">
            <p>{{ session('error') }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
        $('#alertmodal').modal('show');
    </script>
@endif
<style type="text/css">
    .delete_form{
        display: inline-block;
    }
</style>
@yield('scripts')
</html>