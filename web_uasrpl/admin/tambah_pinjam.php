<?php
session_start();
require_once '../config/database.php';

// Ambil data anggota & buku untuk dropdown
$anggota = $conn->query("SELECT id, nama_lengkap FROM anggota")->fetchAll();
$buku = $conn->query("SELECT id, judul_buku FROM buku WHERE stok > 0")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_a = $_POST['id_anggota'];
    $id_b = $_POST['id_buku'];
    $tgl_p = date('Y-m-d');
    $tgl_k = $_POST['tgl_kembali'];

    // 1. Masukkan ke tabel peminjaman
    $sql = "INSERT INTO peminjaman (id_anggota, id_buku, tgl_pinjam, tgl_kembali, status) VALUES (?, ?, ?, ?, 'Dipinjam')";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_a, $id_b, $tgl_p, $tgl_k]);

    // 2. Potong Stok Buku otomatis
    $update_stok = $conn->prepare("UPDATE buku SET stok = stok - 1 WHERE id = ?");
    $update_stok->execute([$id_b]);

    header("Location: transaksi.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pinjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container col-md-5 card shadow p-4">
        <h4 class="mb-4">Input Peminjaman</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Pilih Anggota</label>
                <select name="id_anggota" class="form-select" required>
                    <?php foreach($anggota as $a): ?>
                        <option value="<?= $a['id'] ?>"><?= $a['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Pilih Buku</label>
                <select name="id_buku" class="form-select" required>
                    <?php foreach($buku as $b): ?>
                        <option value="<?= $b['id'] ?>"><?= $b['judul_buku'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Batas Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">PROSES PINJAM</button>
        </form>
    </div>
</body>
</html>