<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRIMANUSA MUKTI UTAMA</title>
    <link rel="icon" href="{{ asset('logoo.png') }}" type="image/png"> <!-- Favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center vh-100"
    style="background: linear-gradient(to right, #DC5F00, #373A40);">
    <div class="card p-4 shadow-lg rounded-4" style="width: 380px;">
        <div class="text-center mb-3">
            <img src="{{ asset('logoo.png') }}" alt="Logo" width="70" height="70">
        </div>
        <h3 class="text-center mb-3 text-dark">Register</h3>
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Masukkan password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    placeholder="Konfirmasi password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
        <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</body>

</html>
