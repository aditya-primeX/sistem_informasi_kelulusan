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
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">Tambah Siswa</a>
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
                                <a href="{{ route('students.grades', $student->id) }}" class="btn btn-info btn-sm">Nilai</a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus siswa ini?')">Hapus</button>
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
