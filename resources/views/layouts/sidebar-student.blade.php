<a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
    <i class="bi bi-speedometer2"></i>Dashboard
</a>
<a class="nav-link {{ request()->routeIs('student.attendance') ? 'active' : '' }}" href="{{ route('student.attendance') }}">
    <i class="bi bi-calendar-check"></i>My Attendance
</a>
<a class="nav-link {{ request()->routeIs('student.results.*') ? 'active' : '' }}" href="{{ route('student.results.index') }}">
    <i class="bi bi-journal-text"></i>My Results
</a>
<a class="nav-link {{ request()->routeIs('student.fees') ? 'active' : '' }}" href="{{ route('student.fees') }}"><i class="bi bi-cash-coin"></i>Fee Status</a>