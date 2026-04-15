<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">MyApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item">
                    <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="text-center text-light bg-primary py-5">
    <div class="container">
        <h1 class="display-4">Welcome to MyApp</h1>
        <p class="lead">Build your application easily with Laravel</p>
        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">Get Started</button>
    </div>
</section>

<!-- Features -->
<section id="features" class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <h4>Fast</h4>
                <p>Laravel makes development fast and easy.</p>
            </div>
            <div class="col-md-4">
                <h4>Secure</h4>
                <p>Built-in authentication and security features.</p>
            </div>
            <div class="col-md-4">
                <h4>Scalable</h4>
                <p>Perfect for small to large applications.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact -->
<section id="contact" class="bg-light py-5">
    <div class="container text-center">
        <h3>Contact Us</h3>
        <p>Email: support@myapp.com</p>
    </div>
</section>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                @error('login')
                        <div class="text text-danger ms-3 mt-2">{{ $message }}</div>
                    @enderror
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3">
    <p class="mb-0">© 2026 MyApp. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@if ($errors->any())
<script>
    var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
    myModal.show();
</script>
@endif
