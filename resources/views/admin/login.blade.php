<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Sistem Kelulusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .btn-login {
            background-color: #3a81e9;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #2a6ed1;
            transform: translateY(-2px);
        }
        .back-link {
            text-decoration: none;
            color: #6c757d;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #3a81e9;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <div style="font-size: 3rem; margin-bottom: 10px;">🔐</div>
            <h2 class="fw-bold">Admin Login</h2>
            <p class="text-muted">Akses Administrator</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat Email</label>
                <input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="dummy@dummy.com" required autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary btn-login w-100 text-white shadow-sm mb-3">Masuk ke Dashboard</button>
            
            <div class="text-center">
                <a href="{{ route('siswa.index') }}" class="back-link">← Kembali ke Halaman Siswa</a>
            </div>
        </form>
    </div>
</body>
</html>
