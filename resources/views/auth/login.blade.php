<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f5;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: 1px solid #1a9c6d;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }
        .login-card .card-header {
            background: #fff;
            border-bottom: none;
            text-align: center;
            padding-top: 40px;
        }
        .login-icon {
            width: 70px;
            height: 70px;
            background: #eafaf3;
            border: 2px solid #1a9c6d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        .login-icon i {
            color: #1a9c6d;
            font-size: 30px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #dfe1e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(26,156,109,0.12);
            border-color: #1a9c6d;
        }
        .btn-primary {
            background: #1a9c6d;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        .btn-primary:hover {
            background: #0d5c3f;
        }
        a {
            color: #1a9c6d;
        }
        a:hover {
            color: #0d5c3f;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="card-header">
                    <div class="login-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Welcome back</h4>
                    <p class="text-muted small">Login to your account</p>
                </div>
                <div class="card-body px-4 pb-4 pt-2">

                    @if (session('success'))
                        <div class="alert alert-success py-2 small">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit')}}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-muted">Email address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control pe-5" placeholder="••••••••" required>
                                <i class="bi bi-eye-slash position-absolute" id="password-icon" 
                                style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"
                                onclick="togglePassword('password', 'password-icon')"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 text-white">
                            Login
                        </button>
                    </form>

                    <p class="text-center mt-4 small text-muted mb-0">
                        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-medium">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>

</body>
</html>