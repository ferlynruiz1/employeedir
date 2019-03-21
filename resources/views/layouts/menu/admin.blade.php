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
<li <?php echo \Request::url() == url('employees/separated') ? 'class="active"' : ''; ?>>
    <a href="{{url('employees/separated')}}">
        <em class="fa fa-user-times">&nbsp;</em>
        Separated Employees
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
<li <?php echo \Request::url() == url('events') ? 'class="active"' : ''; ?>>
    <a href="{{url('events')}}">
        <em class="fa fa-calendar">&nbsp;</em>
        Events
    </a>
</li>
<li <?php echo \Request::url() == url('posts') ? 'class="active"' : ''; ?>>
    <a href="{{url('posts')}}">
        <em class="fa fa-calendar-o">&nbsp;</em> 
        Posts
    </a>
</li>
<li <?php echo \Request::url() == url('leave') ? 'class="active"' : ''; ?>>
    <a href="{{url('leave')}}">
        <em class="fa fa-calendar">&nbsp;</em>
        Leaves
        @if(Auth::user()->leaveRequestCount() > 0)
            <span class="badge label-danger">{{ Auth::user()->leaveRequestCount() }}</span>
        @endif
    </a>
</li>

<li <?php echo \Request::url() == url('referral') ? 'class="active"' : ''; ?>>
    <a href="{{url('referral')}}">
        <em class="fa fa-user-plus">&nbsp;</em>
        Referrals
    </a>
</li>
<li <?php echo \Request::url() == url('hierarchy') ? 'class="active"' : ''; ?>>
    <a href="{{url('hierarchy')}}">
        <em class="fa fa-sitemap">&nbsp;</em> 
        Change Employee Hierarchy
    </a>
</li>
<li <?php echo \Request::url() == url('myprofile') ? 'class="active"' : ''; ?>>
    <a href="{{url('myprofile')}}">
        <em class="fa fa-user">&nbsp;</em>
        My Profile
    </a>
</li>
<li <?php echo \Request::url() == url('settings') ? 'class="active"' : ''; ?>>
    <a href="{{url('settings')}}">
        <em class="fa fa-gear">&nbsp;</em>
        Settings
    </a>
</li>
<!-- <li <?php echo \Request::url() == url('employees/import') ? 'class="active"' : ''; ?>>
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
</li> -->
<li>
    <a href="{{ route('logout')}}">
        <em class="fa fa-power-off">&nbsp;</em>
        Logout
    </a>
</li>