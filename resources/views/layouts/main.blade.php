<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eLink's Employee Directory | @yield('title')</title>
    <link rel="icon" type="image/png" href="http://www.elink.com.ph/wp-content/uploads/2016/01/elink-logo-site.png">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/datepicker3.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/custom.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/css/css.css')}}" rel="stylesheet">
    <script src="{{ asset('public/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('public/js/jquery.bootstrap-growl.min.js') }}"></script>
</head>
<style type="text/css">
body{
   
}
</style>
<body>
    <!-- nav header -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #32373A !important;">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="{{url('/home')}}">
                    <span>
                        <img src="{{ asset('public/img/elink-logo-site.png')}}" style="width: 40px; margin-top: -10px">
                        &nbsp;Employee
                    </span>
                    Directory
                </a>
            </div>
        </div>
    </nav>
    <!-- sidebar menu -->
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="{{ Auth::user()->profile_img }}" class="img-responsive" alt="" style="width: 100px; height: 100px;">
            </div>
            <div class="profile-usertitle">
                <br>
                <h4 class="card-title m-t-10" style="font-size: 15px !important;">{{ Auth::user()->fullname() }}</h4>
                <h5 class="card-subtitle" title="Job Title">{{ Auth::user()->position_name }}</h6>
                <h6 class="card-subtitle" title="Department/Team">{{ Auth::user()->team_name }}</h6>
            <br>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        <ul class="nav menu">
            @if(Auth::user()->isAdmin())
            <li <?php echo \Request::url() == url('dashboard') ? 'class="active"' : ''; ?>>
                <a href="{{url('dashboard')}}">
                    <em class="fa fa-dashboard">&nbsp;</em>
                    Dashboard
                </a>
            </li>
            <li <?php echo \Request::url() == url('employees') ? 'class="active"' : ''; ?>>
                <a href="{{url('employees')}}">
                    <em class="fa fa-home">&nbsp;</em>
                    Employees
                 </a>
             </li>
            <li <?php echo \Request::url() == url('department') ? 'class="active"' : ''; ?>>
                <a href="{{url('department')}}">
                    <em class="fa fa-users">&nbsp;</em> 
                    Department
                </a>
            </li>
            <li <?php echo \Request::url() == url('myprofile') ? 'class="active"' : ''; ?>>
                <a href="{{url('myprofile')}}">
                    <em class="fa fa-user">&nbsp;</em>
                    My Profile
                </a>
            </li>
            <li <?php echo \Request::url() == url('employees/import') ? 'class="active"' : ''; ?>>
                <a href="{{url('employees/import')}}">
                    <em class="fa fa-upload">&nbsp;</em> 
                    Import
                </a>
            </li>
            <li <?php echo \Request::url() == url('employees/export') ? 'class="active"' : ''; ?>>
                <a href="{{url('employees/export')}}">
                    <em class="fa fa-download">&nbsp;</em> 
                    Export
                </a>
            </li>
            <li>
                <a href="{{ route('logout')}}">
                    <em class="fa fa-power-off">&nbsp;</em>
                    Logout
                </a>
            </li>
            @else 
            <li <?php echo \Request::url() == url('home') ? 'class="active"' : ''; ?>>
                <a href="{{url('home')}}">
                    <em class="fa fa-home">&nbsp;</em>
                    Home
                </a>
            </li>
            <li <?php echo \Request::url() == url('employees') ? 'class="active"' : ''; ?>>
                <a href="{{url('employees')}}">
                    <em class="fa fa-users">&nbsp;</em>
                    Employees
                 </a>
             </li>
            <li <?php echo \Request::url() == url('myprofile') ? 'class="active"' : ''; ?>>
                <a href="{{url('myprofile')}}">
                    <em class="fa fa-user">&nbsp;</em>
                    My Profile
                </a>
            </li>
            <li>
                <a href="{{ route('logout')}}">
                    <em class="fa fa-power-off">&nbsp;</em>
                    Logout
                </a>
            </li>
            @endif
        </ul>
    </div>
    <!-- Content -->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">@yield('pagetitle')</li>
            </ol>
        </div>
        <div>
            @yield('content')
        </div>
    </div> 
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/js/chart.min.js')}}"></script>
    <script src="{{ asset('public/js/chart-data.js')}}"></script>
    <script src="{{ asset('public/js/easypiechart.js')}}"></script>
    <script src="{{ asset('public/js/easypiechart-data.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('public/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('public/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('public/js/select2.full.js')}}"></script>
    <script src="{{ asset('public/js/global.js')}}"></script>
    <script src="{{ asset('public/js/custom.js')}}"></script>
    <!-- Modal -->
    <div id="messageModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
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
<!-- Modal Success -->
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
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $('#alertmodal').modal('show');
    </script>
@endif
<!-- Modal Error -->
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
        </div>
      </div>
    </div>
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
