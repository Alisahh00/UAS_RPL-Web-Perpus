<?php
require_once '../config/database.php';

$id = $_GET['id'];

// 1. Ambil data transaksi & hitung denda final
$stmt = $conn->prepare("SELECT * FROM peminjaman WHERE id_pinjam = ?");
$stmt->execute([$id]);
$t = $stmt->fetch();

$tgl_deadline = new DateTime($t['tgl_kembali']);
$tgl_sekarang = new DateTime();
$denda_final = 0;

if ($tgl_sekarang > $tgl_deadline) {
    $selisih = $tgl_sekarang->diff($tgl_deadline);
    $denda_final = $selisih->days * 2000;
}

// 2. Update status transaksi & simpan denda fixed
$update = $conn->prepare("UPDATE peminjaman SET status = 'Kembali', denda = ? WHERE id_pinjam = ?");
$update->execute([$denda_final, $id]);

// 3. Tambahkan kembali stok buku
$stok_kembali = $conn->prepare("UPDATE buku SET stok = stok + 1 WHERE id = ?");
$stok_kembali->execute([$t['id_buku']]);

header("Location: transaksi.php");
?>