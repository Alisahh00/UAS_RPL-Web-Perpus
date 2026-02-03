<?php
session_start();
require_once '../config/database.php';

$query = $conn->query("SELECT * FROM buku ORDER BY id DESC");
$buku = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Koleksi Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container card shadow p-4">
        <div class="d-flex justify-content-between mb-4">
            <h2>📚 Koleksi Buku</h2>
            <a href="tambah_buku.php" class="btn btn-success align-self-center">+ Tambah Buku</a>
        </div>
        <table class="table table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($buku as $b): ?>
                <tr>
                    <td class="text-center">
                        <img src="../assets/img/<?= $b['cover']; ?>" width="60" class="rounded shadow-sm">
                    </td>
                    <td><strong><?= $b['judul_buku']; ?></strong></td>
                    <td><?= $b['pengarang']; ?></td>
                    <td class="text-center"><?= $b['stok']; ?></td>
                    <td class="text-center">
                        <a href="edit_buku.php?id=<?= $b['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus_buku.php?id=<?= $b['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
    </div>
</body>
</html>