<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | PRIMANUSA MUKTI UTAMA</title>
    <link rel="icon" href="{{ asset('logoo.png') }}" type="image/png"> <!-- Favicon -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #F8F9FA;
            --secondary-bg: #FFFFFF;
            --accent-color: #DC5F00;
            --text-color: #373A40;
            --sidebar-hover: #FF7F50;
            --shadow-color: rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: var(--primary-bg);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: var(--secondary-bg);
            border-bottom: 3px solid var(--accent-color);
            padding: 14px 20px;
            box-shadow: 0 3px 8px var(--shadow-color);
        }

        .navbar-brand img {
            border-radius: 50%;
        }

        .btn-outline-secondary {
            border-radius: 8px;
            padding: 10px 14px;
            transition: background 0.3s ease-in-out, transform 0.2s;
        }
        .btn-outline-secondary:hover {
            background: var(--accent-color);
            color: #FFF;
            transform: scale(1.08);
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--secondary-bg);
            color: var(--text-color);
            padding: 22px;
            height: 100vh;
            border-right: 3px solid var(--accent-color);
            box-shadow: 2px 0 10px var(--shadow-color);
        }

        .sidebar a {
            color: var(--text-color);
            padding: 14px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .sidebar a i {
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
            color: #FFF;
            transform: translateX(5px);
        }

        /* Footer */
        footer {
            background-color: var(--secondary-bg);
            border-top: 3px solid var(--accent-color);
            padding: 14px 0;
            font-size: 14px;
            color: var(--text-color);
        }

        /* Main Content */
        main {
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto;
                border-right: none;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar shadow-sm">
    <div class="container-fluid d-flex align-items-center">
        <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('logoo.png') }}" alt="Logo" width="50" height="50" class="me-2">
            <span class="fs-5 fw-bold text-uppercase">IT Task</span>
        </a>
        <span class="ms-auto fw-semibold fs-5">Dashboard</span>
        <div class="ms-3 d-flex align-items-center">
            <i class="fa-solid fa-user-circle me-2 fa-lg"></i>
            @auth
                <span class="fw-semibold">{{ Auth::user()->name }} - {{ Auth::user()->role }}</span>
            @endauth
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="offcanvas offcanvas-start sidebar" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</a>
        <a href="{{ route('tasks.index') }}"><i class="fa-solid fa-list-check me-2"></i>Task</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
        </form>
    </div>
</div>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="text-center py-3 mt-4">
    &copy; 2025 Primanusa Mukti Utama | All Rights Reserved
</footer>

<!-- Bootstrap Bundle dengan Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
