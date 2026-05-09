@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran')
@section('header', 'Edit Mata Pelajaran')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Mata Pelajaran</h3>
            </div>
            <form action="{{ route('subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Mata Pelajaran</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama mata pelajaran" value="{{ old('name', $subject->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('subjects.index') }}" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
