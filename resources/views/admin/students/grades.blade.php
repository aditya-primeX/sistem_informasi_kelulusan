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
                                <select name="grades[{{ $index }}][subject_id]" class="form-control" required>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ $grade->subject_id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                                <select name="grades[0][subject_id]" class="form-control" required>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
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
    const subjects = @json($subjects);
    
    document.getElementById('add-grade').addEventListener('click', function() {
        const container = document.getElementById('grades-container');
        const row = document.createElement('div');
        row.className = 'row mb-2 grade-row';
        
        let subjectOptions = '<option value="">-- Pilih Mata Pelajaran --</option>';
        subjects.forEach(subject => {
            subjectOptions += `<option value="${subject.id}">${subject.name}</option>`;
        });

        row.innerHTML = `
            <div class="col-md-6">
                <select name="grades[${gradeIndex}][subject_id]" class="form-control" required>
                    ${subjectOptions}
                </select>
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
