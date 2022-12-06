<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{ route('home') }}" class="simple-text logo-normal">
          {{ config('app.name', 'Student Management') }}
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::user()->role == "Super Admin" )
                <li class="nav-item {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('users.index')}}">
                        <i class="material-icons">person</i>
                        <p>Users</p>
                    </a>
                </li>
            @endif

            <li class="nav-item {{ (request()->is('admin/student*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('students.index') }}">
                    <i class="material-icons">Students</i>
                    <p>Students</p>
                </a>
            </li>
            <li class="nav-item {{ (request()->is('admin/report*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('reports.index') }}">
                    <i class="material-icons">Reports</i>
                    <p>Reports</p>
                </a>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="./notifications.html">--}}
{{--                    <i class="material-icons">notifications</i>--}}
{{--                    <p>Notifications</p>--}}
{{--                </a>--}}
{{--            </li>--}}
            <!-- <li class="nav-item active-pro ">
                   <a class="nav-link" href="./upgrade.html">
                       <i class="material-icons">unarchive</i>
                       <p>Upgrade to PRO</p>
                   </a>
               </li> -->
        </ul>
      </div>
    </div>
