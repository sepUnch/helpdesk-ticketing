<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Ticketing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #1e3a5f, #2d6a9f); }
        .sidebar { min-height: calc(100vh - 56px); background: #fff; border-right: 1px solid #dee2e6; }
        .badge-open { background-color: #0d6efd; }
        .badge-on_progress { background-color: #fd7e14; }
        .badge-resolved { background-color: #198754; }
        .badge-closed { background-color: #6c757d; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark px-3">
        <span class="navbar-brand fw-bold"><i class="bi bi-headset"></i> Helpdesk Ticketing</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-light">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar py-3">
                @if(auth()->user()->role === 'employee')
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-light w-100 text-start mb-2">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                    <a href="{{ route('employee.tickets.create') }}" class="btn btn-primary w-100 text-start mb-2">
                        <i class="bi bi-plus-circle"></i> Buat Ticket
                    </a>
                @else
                    <a href="{{ route('it-support.dashboard') }}" class="btn btn-light w-100 text-start mb-2">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                @endif
            </div>
            <div class="col-md-10 py-4 px-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>