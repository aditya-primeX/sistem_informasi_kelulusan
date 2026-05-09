<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Kelulusan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            background-color: #3a81e9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2d3436;
        }
        .verification-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }
        .verification-card:hover {
            transform: translateY(-5px);
        }
        .btn-verify {
         
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .btn-verify:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }
        .logo-placeholder {
            width: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <div class="verification-card">
        <div class="logo-placeholder">🎓</div>
        <h2 class="text-center fw-bold mb-2">Cek Kelulusan</h2>
        <p class="text-center text-muted mb-4">Silakan masukkan data diri Anda untuk melihat status kelulusan.</p>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('siswa.verify') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control form-control-lg rounded-3" placeholder="Masukkan nama sesuai ijazah" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">NIS (Nomor Induk Siswa)</label>
                <input type="text" name="nis" class="form-control form-control-lg rounded-3" placeholder="Masukkan NIS Anda" required value="{{ old('nis') }}">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Tanggal Lahir</label>
                <input type="date" name="date_of_birth" class="form-control form-control-lg rounded-3" required value="{{ old('date_of_birth') }}">
            </div>
            <button type="submit" class="btn btn-primary btn-verify w-100 text-white shadow-sm">Verifikasi Identitas</button>
        </form>
        
        <div class="mt-4 text-center">
            <small class="text-muted">© {{ date('Y') }} Sistem Informasi Kelulusan Sekolah</small>
            <div class="mt-2">
                <a href="{{ route('admin.login') }}" class="text-secondary text-decoration-none" style="font-size: 0.85rem;">
                    🔐 Login Staff/Admin
                </a>
            </div>
        </div>
    </div>
</body>
</html>
