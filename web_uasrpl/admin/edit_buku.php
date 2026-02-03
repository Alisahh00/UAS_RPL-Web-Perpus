<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];
// Ambil data buku lama
$stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->execute([$id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $stok = $_POST['stok'];
    $tahun = $_POST['tahun'];
    $nama_baru = $buku['cover']; // Default pakai nama file lama

    // Cek apakah admin upload gambar baru
    if ($_FILES['cover']['name'] != "") {
        // Hapus gambar lama dari folder
        if (file_exists("../assets/img/" . $buku['cover'])) {
            unlink("../assets/img/" . $buku['cover']);
        }
        
        // Proses upload gambar baru
        $nama_file = $_FILES['cover']['name'];
        $tmp_file = $_FILES['cover']['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = time() . "." . $ekstensi;
        move_uploaded_file($tmp_file, "../assets/img/" . $nama_baru);
    }

    $sql = "UPDATE buku SET judul_buku=?, pengarang=?, stok=?, tahun_terbit=?, cover=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$judul, $pengarang, $stok, $tahun, $nama_baru, $id]);
    
    header("Location: list_buku.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container col-md-6 card shadow p-4">
        <h3 class="mb-4">Edit Data Buku</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?= $buku['judul_buku'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?= $buku['pengarang'] ?>" required>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $buku['stok'] ?>" required>
                </div>
                <div class="col">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun" class="form-control" value="<?= $buku['tahun_terbit'] ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Cover Saat Ini:</label><br>
                <img src="../assets/img/<?= $buku['cover'] ?>" width="100" class="mb-2 rounded shadow-sm">
                <input type="file" name="cover" class="form-control" accept="image/*">
                <small class="text-muted text-italic">*Kosongkan jika tidak ingin mengganti gambar</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning w-100 fw-bold">Update Buku</button>
                <a href="list_buku.php" class="btn btn-secondary w-100">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>