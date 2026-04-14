<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Helpdesk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h4 class="text-center fw-bold mb-1">🎧 Helpdesk</h4>
                        <p class="text-center text-muted mb-4">Ticketing System</p>
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="/login">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" 
                                    placeholder="email@example.com" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" 
                                    placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Login</button>
                        </form>
                        <hr>
                        <small class="text-muted d-block text-center">
                            Demo: employee@helpdesk.com / password<br>
                            Demo: itsupport@helpdesk.com / password
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>