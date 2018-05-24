<li <?php echo \Request::url() == url('dashboard') ? 'class="active"' : ''; ?>>
    <a href="{{url('dashboard')}}">
        <em class="fa fa-dashboard">&nbsp;</em>
        Dashboard
    </a>
</li>
<li <?php echo \Request::url() == url('employees') ? 'class="active"' : ''; ?>>
    <a href="{{url('employees')}}">
        <em class="fa fa-user">&nbsp;</em>
        Employees
    </a>
</li>
<li <?php echo \Request::url() == url('department') ? 'class="active"' : ''; ?>>
    <a href="{{url('department')}}">
        <em class="fa fa-users">&nbsp;</em> 
        Departments
    </a>
</li>
<li <?php echo \Request::url() == url('activities') ? 'class="active"' : ''; ?>>
    <a href="{{url('activities')}}">
        <em class="fa fa-calendar">&nbsp;</em> 
        Activities
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
<li <?php echo \Request::url() == url('employees/sync') ? 'class="active"' : ''; ?>>
    <a href="{{url('employees/sync')}}">
        <em class="fa fa-spinner">&nbsp;</em> 
        Run Cron Job
    </a>
</li>
<li>
    <a href="{{ route('logout')}}">
        <em class="fa fa-power-off">&nbsp;</em>
        Logout
    </a>
</li>