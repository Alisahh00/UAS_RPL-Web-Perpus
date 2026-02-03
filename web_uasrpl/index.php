<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di PerpusAlieec</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">PERPUS<span class="text-warning">ALIEEC</span></a>
            <div class="ms-auto">
                <a href="login.php" class="btn btn-warning fw-bold">Login Admin</a>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Buku Adalah Jendela Dunia</h1>
            <p class="lead mb-5">Temukan ribuan petualangan, ilmu pengetahuan, dan inspirasi hanya dalam genggaman jemari Anda. Mari mulai membaca hari ini!</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="#tentang" class="btn btn-outline-light btn-lg px-4">Jelajahi Koleksi</a>
            </div>
        </div>
    </header>

    <section id="tentang" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Kenapa Harus Membaca?</h2>
            <div class="row">
                <div class="col-md-4">
                    <h3>Cerdas</h3>
                    <p>Membaca melatih otak untuk berpikir lebih kritis dan luas.</p>
                </div>
                <div class="col-md-4">
                    <h3>Fokus</h3>
                    <p>Meningkatkan konsentrasi dan daya ingat dalam aktivitas harian.</p>
                </div>
                <div class="col-md-4">
                    <h3>Inspiratif</h3>
                    <p>Dapatkan ide-ide baru yang bisa mengubah masa depanmu.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; PerpusAliiec - Semua Untuk Ilmu.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>