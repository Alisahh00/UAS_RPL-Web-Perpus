<?php
session_start();
// Proteksi halaman: Kalau belum login, tendang balik ke login.php
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Panel Admin</a>
        <div class="ms-auto">
            <span class="text-light me-3">Halo, <?= $_SESSION['nama_admin']; ?>!</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Anggota</h5>
                    <p class="card-text">Tambah, Edit, & Hapus data anggota perpustakaan.</p>
                    <a href="list_anggota.php" class="btn btn-primary">Kelola Anggota</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Buku</h5>
                    <p class="card-text">Kelola stok dan daftar buku yang tersedia.</p>
                    <a href="list_buku.php" class="btn btn-primary">Kelola Buku</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Transaksi</h5>
                    <p class="card-text">Catat peminjaman dan pengembalian buku.</p>
                    <a href="transaksi.php" class="btn btn-warning fw-bold">Input Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>