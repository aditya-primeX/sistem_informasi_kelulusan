@extends('layouts.admin')

@section('title', 'Kelola Nilai')
@section('page_title', 'Kelola Nilai: ' . $student->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Daftar Nilai</h3>
            </div>
            <form action="{{ route('students.grades.update', $student->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div id="grades-container">
                        @forelse($student->grades as $index => $grade)
                        <div class="row mb-2 grade-row">
                            <div class="col-md-6">
                                <input type="text" name="grades[{{ $index }}][subject_name]" class="form-control" value="{{ $grade->subject_name }}" placeholder="Mata Pelajaran" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="grades[{{ $index }}][score]" class="form-control" value="{{ $grade->score }}" placeholder="Nilai" required min="0" max="100">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-block remove-grade">Hapus</button>
                            </div>
                        </div>
                        @empty
                        <div class="row mb-2 grade-row">
                            <div class="col-md-6">
                                <input type="text" name="grades[0][subject_name]" class="form-control" placeholder="Mata Pelajaran" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="grades[0][score]" class="form-control" placeholder="Nilai" required min="0" max="100">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-block remove-grade">Hapus</button>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" id="add-grade" class="btn btn-success mt-2">Tambah Mata Pelajaran</button>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan Semua Nilai</button>
                    <a href="{{ route('students.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let gradeIndex = {{ count($student->grades) > 0 ? count($student->grades) : 1 }};
    
    document.getElementById('add-grade').addEventListener('click', function() {
        const container = document.getElementById('grades-container');
        const row = document.createElement('div');
        row.className = 'row mb-2 grade-row';
        row.innerHTML = `
            <div class="col-md-6">
                <input type="text" name="grades[${gradeIndex}][subject_name]" class="form-control" placeholder="Mata Pelajaran" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="grades[${gradeIndex}][score]" class="form-control" placeholder="Nilai" required min="0" max="100">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block remove-grade">Hapus</button>
            </div>
        `;
        container.appendChild(row);
        gradeIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-grade')) {
            e.target.closest('.grade-row').remove();
        }
    });
</script>
@endpush
