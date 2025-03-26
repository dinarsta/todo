<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PRIMANUSA MUKTI UTAMA</title>
    <link rel="icon" href="{{ asset('logoo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background Styling */
        body {
            background: url("{{ asset('logoo.png') }}") no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Overlay untuk efek blur */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 0;
        }

        /* Card Styling */
        .register-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 30px;
            width: 400px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        /* Input Fields */
        .form-control {
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transition: 0.3s ease-in-out;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            border-color: #ffcc00;
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.8);
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #DC5F00, #b84d00);
            border: none;
            transition: 0.3s ease-in-out;
            font-weight: bold;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b84d00, #DC5F00);
            transform: scale(1.05);
        }

        /* Link Styling */
        a {
            color: #ffcc00;
            text-decoration: none;
            transition: 0.3s;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="register-card text-center">
        <div class="mb-3">
            <img src="{{ asset('logoo.png') }}" alt="Logo" width="70" height="70">
        </div>
        <h3>Register</h3>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-2 text-start">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="mb-2 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            <div class="mb-2 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Masukkan password" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    placeholder="Konfirmasi password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>

        <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</body>

</html>
