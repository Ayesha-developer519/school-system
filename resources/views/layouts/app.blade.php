<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f5;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            position: fixed;
        }
        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        .sidebar-brand h5 {
            color: #1a9c6d;
            font-weight: 700;
            margin: 0;
        }
        .sidebar .nav-link {
            color: #444;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 3px 12px;
            font-size: 14px;
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 8px;
        }
        .sidebar .nav-link:hover {
            background: #eafaf3;
            color: #1a9c6d;
        }
        .sidebar .nav-link.active {
            background: #1a9c6d;
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 25px;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: -25px -25px 25px -25px;
        }
        .btn-logout {
            background: none;
            border: 1px solid #dc3545;
            color: #dc3545;
            border-radius: 8px;
            padding: 6px 16px;
            font-size: 14px;
        }
        .btn-logout:hover {
            background: #dc3545;
            color: #fff;
        }
    </style>
    @yield('styles')
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <h5><i class="bi bi-mortarboard-fill"></i> SMS</h5>
    </div>
    <nav class="nav flex-column mt-3">
        @include('layouts.sidebar-' . auth()->user()->role)
    </nav>
</div>

<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">{{ auth()->user()->name }} <span class="badge bg-light text-dark border">{{ ucfirst(auth()->user()->role) }}</span></span>
            <form method="POST" action="/logout" class="m-0">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    @yield('content')
</div>

</body>
</html>