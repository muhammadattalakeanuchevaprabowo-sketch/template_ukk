<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { overflow-x: hidden; }
        .sidebar {
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="bg-dark text-white sidebar p-3">
    <h4 class="text-center">Dashboard</h4>

    <hr>

    <ul class="nav flex-column">
        <h6>Items Data</h6>
        <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link text-white">Category</a></li>
        <li class="nav-item"><a href="{{ route('divisions.index') }}" class="nav-link text-white">Division</a></li>
        <li class="nav-item"><a href="" class="nav-link text-white">Lending</a></li>
        <li class="nav-item"><a href="" class="nav-link text-white">Item</a></li>
    </ul>

    <hr>

    <h6>Account</h6>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link text-white">User</a></li>
    </ul>

    <hr>

    <h6>Admin</h6>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="" class="nav-link text-white">Operator</a></li>
    </ul>

    <div class="mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>
</div>

<!-- Content -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
