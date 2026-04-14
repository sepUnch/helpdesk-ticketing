@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">🎫 Ticket Saya</h4>
    <a href="{{ route('employee.tickets.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Ticket Baru
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No Ticket</th>
                    <th>Judul</th>
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
                    <td>{{ $ticket->category->name }}</td>
                    <td>
                        <span class="badge badge-{{ $ticket->status }}">
                            {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('employee.tickets.show', $ticket) }}" 
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada ticket. <a href="{{ route('employee.tickets.create') }}">Buat sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection