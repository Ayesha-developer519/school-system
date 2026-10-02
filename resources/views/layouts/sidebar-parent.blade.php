<!-- <a class="nav-link active" href="{{ route('parent.dashboard') }}"><i class="bi bi-speedometer2"></i>Dashboard</a>
<a class="nav-link" href="#"><i class="bi bi-calendar-check"></i>Child Attendance</a>
<a class="nav-link" href="#"><i class="bi bi-journal-text"></i>Child Results</a>
<a class="nav-link" href="#"><i class="bi bi-cash-coin"></i>Fee Status</a> -->

<a class="nav-link {{ request()->routeIs('parent.dashboard') ? 'active' : '' }}" href="{{ route('parent.dashboard') }}"><i class="bi bi-speedometer2"></i>Dashboard</a>
<a class="nav-link {{ request()->routeIs('parent.*') && !request()->routeIs('parent.dashboard') ? 'active' : '' }}" href="{{ route('parent.children') }}"><i class="bi bi-people"></i>My Children</a>