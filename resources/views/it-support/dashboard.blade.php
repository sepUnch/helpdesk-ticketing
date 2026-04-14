@extends('layouts.app')

@section('content')
<h4 class="fw-bold mb-4">🖥️ Dashboard IT Support</h4>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('it-support.dashboard') }}" class="row g-2">
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    @foreach(['open','on_progress','resolved','closed'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                            {{ strtoupper(str_replace('_', ' ', $s)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('it-support.dashboard') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No Ticket</th>
                    <th>Judul</th>
                    <th>Dari</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td><code>{{ $ticket->ticket_no }}</code></td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->category->name }}</td>
                    <td>
                        <span class="badge badge-{{ $ticket->status }}">
                            {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('it-support.tickets.show', $ticket) }}" 
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Tidak ada ticket ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection