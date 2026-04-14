@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between">
                <h5 class="fw-bold mb-0">Detail Ticket</h5>
                <span class="badge badge-{{ $ticket->status }} fs-6">
                    {{ strtoupper(str_replace('_', ' ', $ticket->status)) }}
                </span>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless">
                    <tr><th width="150">No Ticket</th><td><code>{{ $ticket->ticket_no }}</code></td></tr>
                    <tr><th>Judul</th><td>{{ $ticket->title }}</td></tr>
                    <tr><th>Kategori</th><td>{{ $ticket->category->name }}</td></tr>
                    <tr><th>Tanggal</th><td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td></tr>
                    <tr><th>Deskripsi</th><td>{{ $ticket->description }}</td></tr>
                </table>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history"></i> Riwayat Ticket</h6>
            </div>
            <div class="card-body p-4">
                @forelse($ticket->logs as $log)
                <div class="border-start border-primary border-3 ps-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $log->user->name }}</strong>
                        <small class="text-muted">{{ $log->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="text-muted small">
                        @if($log->old_status)
                            <span class="badge badge-{{ $log->old_status }}">{{ strtoupper(str_replace('_',  ' ', $log->old_status)) }}</span>
                            → <span class="badge badge-{{ $log->new_status }}">{{ strtoupper(str_replace('_', ' ', $log->new_status)) }}</span>
                        @else
                            <span class="badge bg-secondary">TICKET DIBUAT</span>
                        @endif
                    </div>
                    @if($log->note)
                        <p class="mb-0 mt-1">{{ $log->note }}</p>
                    @endif
                </div>
                @empty
                    <p class="text-muted">Belum ada riwayat.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection