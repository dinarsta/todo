<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRIMANUSA MUKTI UTAMA</title>
    <link rel="icon" href="{{ asset('logoo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url("{{ asset('logoo.png') }}") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 30px;
            width: 400px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .login-card img {
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
        }

        .text-dark {
            font-weight: bold;
            color: #fff !important;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

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

<body>
    <div class="login-card text-center">
        <div class="mb-3">
            <img src="{{ asset('logoo.png') }}" alt="Logo" width="80" height="80">
        </div>
        <h3 class="text-dark">Login</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-2 text-start">
                <label for="user_id" class="form-label text-white">ID</label>
                <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Masukkan ID" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label text-white">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-white">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
</body>

</html>
