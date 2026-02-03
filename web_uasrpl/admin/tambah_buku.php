<?php
session_start();
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];
    $tahun = $_POST['tahun'];

    // Logika Upload Gambar
    $nama_file = $_FILES['cover']['name'];
    $tmp_file = $_FILES['cover']['tmp_name'];
    $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = time() . "." . $ekstensi; // Nama unik pake timestamp
    $tujuan = "../assets/img/" . $nama_baru;

    if(move_uploaded_file($tmp_file, $tujuan)) {
        $sql = "INSERT INTO buku (judul_buku, pengarang, stok, tahun_terbit, cover) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$judul, $pengarang, $stok, $tahun, $nama_baru]);
        header("Location: list_buku.php");
    } else {
        echo "Gagal upload gambar!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 card shadow p-4">
                <h3 class="text-center mb-4">Input Buku Baru</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Judul Buku</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pengarang</label>
                        <input type="text" name="pengarang" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tahun Terbit</label>
                            <input type="number" name="tahun" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Cover Buku (Gambar)</label>
                        <input type="file" name="cover" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Koleksi</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>