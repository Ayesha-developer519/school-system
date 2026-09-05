<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f5;
            display: flex;
            align-items: center;
            padding: 30px 0;
        }
        .register-card {
            border: 1px solid #1a9c6d;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }
        .register-card .card-header {
            background: #fff;
            border-bottom: none;
            text-align: center;
            padding-top: 35px;
        }
        .register-icon {
            width: 65px;
            height: 65px;
            background: #eafaf3;
            border: 2px solid #1a9c6d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        .register-icon i {
            color: #1a9c6d;
            font-size: 28px;
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
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card register-card">
                <div class="card-header">
                    <div class="register-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Create account</h4>
                    <p class="text-muted small">Join the School Management System</p>
                </div>
                <div class="card-body px-4 pb-4 pt-2">

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-muted">Full name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Email address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="form-control pe-5" required>
                                    <i class="bi bi-eye-slash position-absolute" id="password-icon"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"
                                    onclick="togglePassword('password', 'password-icon')"></i>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small text-muted">Confirm password</label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control pe-5" required>
                                    <i class="bi bi-eye-slash position-absolute" id="password_confirmation-icon"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888;"
                                    onclick="togglePassword('password_confirmation', 'password_confirmation-icon')"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">Register as</label>
                            <div class="dropdown">
                                <button class="form-select text-start dropdown-toggle-custom" type="button" id="roleDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span id="roleSelectedText">-- Select role --</span>
                                </button>
                                <ul class="dropdown-menu w-100 custom-role-menu" aria-labelledby="roleDropdownBtn">
                                    <li><a class="dropdown-item role-item" href="#" data-value="teacher">Teacher</a></li>
                                    <li><a class="dropdown-item role-item" href="#" data-value="student">Student</a></li>
                                    <li><a class="dropdown-item role-item" href="#" data-value="parent">Parent</a></li>
                                </ul>
                                <input type="hidden" name="role" id="roleInput" value="{{ old('role') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 text-white">
                            Create account
                        </button>
                    </form>

                    <p class="text-center mt-4 small text-muted mb-0">
                        Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Login here</a>
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

    document.querySelectorAll('.role-item').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('roleSelectedText').textContent = this.textContent;
            document.getElementById('roleInput').value = this.dataset.value;

            document.querySelectorAll('.role-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>