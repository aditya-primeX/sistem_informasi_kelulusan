@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page_title', 'Edit Siswa')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Siswa</h3>
            </div>
            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">Nama Siswa</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $student->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" id="nis" value="{{ $student->nis }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="date_of_birth">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ $student->date_of_birth }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="graduation_status">Status Kelulusan</label>
                        <select name="graduation_status" class="form-control" id="graduation_status">
                            <option value="Tidak Lulus" {{ $student->graduation_status == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                            <option value="Lulus" {{ $student->graduation_status == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <a href="{{ route('students.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
