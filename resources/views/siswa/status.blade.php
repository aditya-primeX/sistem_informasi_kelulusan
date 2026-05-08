<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Kelulusan | {{ $student->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f2f5;
            color: #2d3436;
        }
        .status-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 0;
            color: white;
            text-align: center;
            border-bottom-left-radius: 50% 20px;
            border-bottom-right-radius: 50% 20px;
        }
        .status-card {
            margin-top: -50px;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .status-badge {
            font-size: 1.5rem;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            display: inline-block;
            margin: 20px 0;
        }
        .badge-lulus { background: #d1fae5; color: #065f46; border: 2px solid #065f46; }
        .badge-tidak-lulus { background: #fee2e2; color: #991b1b; border: 2px solid #991b1b; }
        
        .table-grades {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table-grades thead { background: #f8f9fa; }
        
        .btn-download {
            background: #2d3436;
            color: white;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-download:hover {
            background: #000;
            color: white;
            transform: translateY(-2px);
        }
        .btn-logout {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            opacity: 0.8;
        }
        .btn-logout:hover { opacity: 1; color: white; }
    </style>
</head>
<body>
    <header class="status-header">
        <form action="{{ route('siswa.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout border-0 bg-transparent">Keluar 🚪</button>
        </form>
        <div class="container">
            <h1 class="fw-bold">Pengumuman Kelulusan</h1>
            <p class="lead">Tahun Pelajaran 2024/2025</p>
        </div>
    </header>

    <main class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="status-card text-center">
                    <h3 class="mb-4">Halo, <strong>{{ $student->name }}</strong></h3>
                    <p class="text-muted">Berdasarkan hasil rapat dewan guru, Anda dinyatakan:</p>
                    
                    @if($student->graduation_status == 'Lulus')
                        <div class="status-badge badge-lulus">LULUS</div>
                        <p class="mt-2">Selamat atas keberhasilan Anda! Perjuangan Anda membuahkan hasil.</p>
                    @else
                        <div class="status-badge badge-tidak-lulus">TIDAK LULUS</div>
                        <p class="mt-2">Tetap semangat, jangan berkecil hati. Setiap tantangan adalah proses pendewasaan.</p>
                    @endif

                    <hr class="my-5">

                    <h4 class="text-start mb-4 fw-bold">Transkrip Nilai Sementara</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-grades text-start">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($student->grades as $grade)
                                <tr>
                                    <td>{{ $grade->subject_name }}</td>
                                    <td class="text-center fw-bold">{{ $grade->score }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Data nilai belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('siswa.download') }}" class="btn-download">
                            📥 Unduh Transkrip Nilai (PDF)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 text-muted">
        <small>© {{ date('Y') }} Sistem Informasi Kelulusan Sekolah</small>
    </footer>
</body>
</html>
