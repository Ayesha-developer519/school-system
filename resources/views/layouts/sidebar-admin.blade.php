<a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i>Dashboard</a>
<a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}"><i class="bi bi-people"></i>Students</a>
<a class="nav-link" href="#"><i class="bi bi-person-badge"></i>Teachers</a>
<a class="nav-link" href="#"><i class="bi bi-collection"></i>Classes</a>
<a class="nav-link" href="#"><i class="bi bi-calendar-check"></i>Attendance</a>
<a class="nav-link" href="#"><i class="bi bi-journal-text"></i>Exams & Results</a>
<a class="nav-link" href="#"><i class="bi bi-cash-coin"></i>Fees</a>