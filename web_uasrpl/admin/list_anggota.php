<?php
session_start();
require_once '../config/database.php';
if (!isset($_SESSION['admin_id'])) { header("Location: ../login.php"); exit; }

// Ambil semua data anggota
$query = $conn->query("SELECT * FROM anggota ORDER BY id DESC");
$anggota = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Anggota - PerpusBro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container card shadow p-4">
        <div class="d-flex justify-content-between mb-4">
            <h2>👥 Daftar Anggota</h2>
            <a href="tambah_anggota.php" class="btn btn-primary align-self-center">+ Tambah Anggota</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($anggota) > 0): ?>
                        <?php foreach($anggota as $row): ?>
                        <tr>
                            <td><strong><?= $row['nama_lengkap']; ?></strong></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['nomor_hp']; ?></td>
                            <td class="text-center">
                                <a href="edit_anggota.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus_anggota.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus anggota ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada anggota terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="index.php" class="btn btn-outline-secondary">← Dashboard</a>
        </div>
    </div>
</body>
</html>