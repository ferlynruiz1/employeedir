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
 <li <?php echo \Request::url() == url('leave/create') ? 'class="active"' : ''; ?>>
    <a href="{{url('leave/create')}}">
        <em class="fa fa-calendar">&nbsp;</em>
        File a leave
     </a>
 </li>
 <li <?php echo \Request::url() == url('referral/create') ? 'class="active"' : ''; ?>>
    <a href="{{url('referral/create')}}">
        <em class="fa fa-user-plus">&nbsp;</em>
        Job Referral
     </a>
 </li>

<li <?php echo \Request::url() == url('events/calendar') ? 'class="active"' : ''; ?>>
    <a href="{{url('events/calendar')}}">
        <em class="fa fa-calendar">&nbsp;</em>
        Events Calendar
    </a>
</li>
@auth
@if(Auth::user()->leaveRequestCount() > 0)
<li <?php echo \Request::url() == url('leave') ? 'class="active"' : ''; ?>>
<a href="{{url('leave')}}">
    <em class="fa fa-calendar">&nbsp;</em>
    Leave Requests&nbsp;&nbsp;<span class="badge label-danger">{{ Auth::user()->leaveRequestCount() }}</span>
 </a>
</li>
@endif
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
@endauth

@guest
<li>
    <a href="{{ route('login')}}">
        <em class="fa fa-sign-in">&nbsp;</em>
        Login
    </a>
</li>
@endguest