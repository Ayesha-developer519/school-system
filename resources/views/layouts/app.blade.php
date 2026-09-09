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

        .form-control, .form-select {
            border-radius: 8px;
            padding: 11px 15px;
            border: 1px solid #dfe1e6;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(26,156,109,0.12);
            border-color: #1a9c6d;
        }
        .form-label {
            color: #6c757d;
        }
        textarea.form-control {
            padding: 11px 15px;
        }

        .dropdown-toggle-custom {
            cursor: pointer;
        }
        .custom-role-menu {
            border-radius: 8px;
            border: 1px solid #dfe1e6;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            padding: 6px;
        }
        .role-item {
            border-radius: 6px;
            padding: 8px 12px;
            color: #333;
        }
        .role-item:hover,
        .role-item:focus {
            background-color: #1a9c6d;
            color: #fff;
        }
        .role-item.active {
            background-color: #eafaf3;
            color: #0d5c3f;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Password show/hide toggle
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            field.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }

    // Custom dropdown handler (role, class, gender, etc.)
    document.querySelectorAll('.role-item').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.closest('.dropdown');
            const button = menu.querySelector('button span');
            const hiddenInput = menu.querySelector('input[type="hidden"]');

            button.textContent = this.textContent;
            hiddenInput.value = this.dataset.value;

            menu.querySelectorAll('.role-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

@stack('scripts')
</body>
</html>