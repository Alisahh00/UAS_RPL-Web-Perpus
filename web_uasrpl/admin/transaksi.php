<?php
session_start();
require_once '../config/database.php';
if (!isset($_SESSION['admin_id'])) { header("Location: ../login.php"); exit; }

// Query JOIN untuk mengambil data lengkap transaksi
$sql = "SELECT p.*, a.nama_lengkap, b.judul_buku 
        FROM peminjaman p
        JOIN anggota a ON p.id_anggota = a.id
        JOIN buku b ON p.id_buku = b.id
        ORDER BY p.status DESC, p.tgl_pinjam DESC";
$stmt = $conn->query($sql);
$transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fungsi hitung denda (Misal: Rp 2.000 per hari)
function hitungDenda($tgl_kembali) {
    $tgl_sekarang = new DateTime();
    $tgl_deadline = new DateTime($tgl_kembali);
    
    if ($tgl_sekarang > $tgl_deadline) {
        $selisih = $tgl_sekarang->diff($tgl_deadline);
        return $selisih->days * 2000; // Ganti angka 2000 sesuai keinginan lo
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Transaksi - PerpusBro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container-fluid card shadow p-4">
        <div class="d-flex justify-content-between mb-4">
            <h2>📑 Transaksi Peminjaman</h2>
            <a href="tambah_pinjam.php" class="btn btn-warning fw-bold">+ Tambah Peminjaman</a>
        </div>

        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Denda (Estimasi)</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transaksi as $t): ?>
                <tr>
                    <td><?= $t['nama_lengkap'] ?></td>
                    <td><?= $t['judul_buku'] ?></td>
                    <td><?= date('d/m/Y', strtotime($t['tgl_pinjam'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($t['tgl_kembali'])) ?></td>
                    <td>
                        <?php 
                        if($t['status'] == 'Dipinjam') {
                            $denda = hitungDenda($t['tgl_kembali']);
                            echo $denda > 0 ? "<span class='text-danger fw-bold'>Rp ".number_format($denda)."</span>" : "Rp 0";
                        } else {
                            echo "Rp ".number_format($t['denda']);
                        }
                        ?>
                    </td>
                    <td>
                        <span class="badge <?= $t['status'] == 'Dipinjam' ? 'bg-primary' : 'bg-success' ?>">
                            <?= $t['status'] ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php if($t['status'] == 'Dipinjam'): ?>
                            <a href="kembalikan.php?id=<?= $t['id_pinjam'] ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Proses pengembalian buku?')">Kembalikan</a>
                        <?php else: ?>
                            <span class="text-muted small">Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>
</body>
</html>