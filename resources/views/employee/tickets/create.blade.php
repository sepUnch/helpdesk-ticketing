@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-plus-circle"></i> Buat Ticket Baru</h5>
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('employee.tickets.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Masalah</label>
                        <input type="text" name="title" class="form-control" 
                            placeholder="Contoh: Laptop tidak bisa menyala" 
                            value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi Masalah</label>
                        <textarea name="description" class="form-control" rows="5" 
                            placeholder="Jelaskan masalah secara detail..." required>{{ old('description') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send"></i> Submit Ticket
                        </button>
                        <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection