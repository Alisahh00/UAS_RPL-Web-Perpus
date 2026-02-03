<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. Ambil nama file gambar dulu sebelum datanya dihapus
    $stmt = $conn->prepare("SELECT cover FROM buku WHERE id = ?");
    $stmt->execute([$id]);
    $buku = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($buku) {
        // 2. Hapus file fisik dari folder assets/img
        $path_gambar = "../assets/img/" . $buku['cover'];
        if (file_exists($path_gambar)) {
            unlink($path_gambar);
        }

        // 3. Hapus data dari database
        $del = $conn->prepare("DELETE FROM buku WHERE id = ?");
        $del->execute([$id]);
    }
}

header("Location: list_buku.php");
exit;
?>