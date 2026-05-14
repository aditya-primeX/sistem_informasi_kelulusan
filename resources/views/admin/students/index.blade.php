@extends('layouts.admin')

@section('title', 'Daftar Siswa')
@section('page_title', 'Daftar Siswa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Siswa</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="fa-solid fa-file-import"></i> Import Excel
                    </button>
                    <a href="{{ route('students.export-template') }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-file-excel"></i> Download Template Excel
                    </a>
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-plus"></i> Tambah Siswa
                    </a>
                </div>
            </div>

            <!-- Import Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="importForm" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Data Siswa dari Excel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Pilih File Excel</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                    <div class="form-text">Format yang didukung: .xlsx, .xls, .csv</div>
                                </div>
                                <div class="alert alert-info">
                                    <small>
                                        <i class="fa-solid fa-circle-info"></i> Pastikan format file sesuai dengan template yang diunduh. Gunakan NIS sebagai pengenal unik siswa.
                                    </small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="importSubmitBtn">
                                    <i class="fa-solid fa-file-import"></i> Mulai Import
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Tanggal Lahir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>
                                <span class="badge {{ $student->graduation_status == 'Lulus' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $student->graduation_status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('students.grades', $student->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-graduation-cap"></i> Nilai
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-user-pen"></i> Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus siswa ini?')">
                                        <i class="fa-solid fa-user-minus"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('importForm').addEventListener('submit', function() {
        var submitBtn = document.getElementById('importSubmitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
    });
</script>
@endpush
