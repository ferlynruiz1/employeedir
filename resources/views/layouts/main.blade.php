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
   

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('public/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/jquery.bootstrap-growl.min.js') }}"></script>
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
                        <em class="fa fa-envelope"></em><span class="label label-danger">15</span>
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
                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
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
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <h4 class="card-title m-t-10" style="font-size: 15px !important;">{{ Auth::user()->alias }}</h4>
                <h6 class="card-subtitle">{{ Auth::user()->position_name }}</h6>
                <h6 class="card-subtitle">{{ Auth::user()->team_name }}</h6>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <!-- <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div> -->
        </form>
        <ul class="nav menu">
            <li <?php echo \Request::url() == url('home') ? 'class="active"' : ''; ?>  ><a href="{{url('home')}}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li <?php echo \Request::url() == url('employee_info/'. Auth::user()->id . '/') ? 'class="active"' : ''; ?> ><a href="{{url('employee_info/'. Auth::user()->id . '/')}}"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
            <li <?php echo \Request::url() == url('department') ? 'class="active"' : ''; ?> ><a href="{{url('department')}}"><em class="fa fa-users">&nbsp;</em> Department</a></li>
            <li><a href="{{ route('logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
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