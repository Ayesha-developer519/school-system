<a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}" href="{{ route('teacher.dashboard') }}"><i class="bi bi-speedometer2"></i>Dashboard</a>
<a class="nav-link" href="#"><i class="bi bi-people"></i>My Students</a>
<a class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}" href="{{ route('attendance.select') }}"><i class="bi bi-calendar-check"></i>Attendance</a>
<a class="nav-link {{ request()->routeIs('results.*') ? 'active' : '' }}" href="{{ route('results.select') }}"><i class="bi bi-journal-text"></i>Enter Marks</a>