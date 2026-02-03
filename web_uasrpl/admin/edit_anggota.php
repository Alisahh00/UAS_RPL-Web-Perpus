<?php
session_start();
require_once '../config/database.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM anggota WHERE id = ?");
$stmt->execute([$id]);
$a = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email  = $_POST['email'];
    $hp     = $_POST['hp'];

    $sql = "UPDATE anggota SET nama_lengkap=?, alamat=?, email=?, nomor_hp=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nama, $alamat, $email, $hp, $id]);
    
    header("Location: list_anggota.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container col-md-5 card shadow p-4">
        <h4 class="mb-4 text-center">Update Data Anggota</h4>
        <form method="POST">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= $a['nama_lengkap'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required><?= $a['alamat'] ?></textarea>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $a['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Nomor HP</label>
                <input type="text" name="hp" class="form-control" value="<?= $a['nomor_hp'] ?>" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">Simpan Perubahan</button>
            <a href="list_anggota.php" class="text-center d-block mt-3 text-muted">Batal</a>
        </form>
    </div>
</body>
</html>