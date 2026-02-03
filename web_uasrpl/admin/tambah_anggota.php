<?php
session_start();
require_once '../config/database.php';

// Proteksi halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email  = $_POST['email'];
    $hp     = $_POST['hp'];

    try {
        $sql = "INSERT INTO anggota (nama_lengkap, alamat, email, nomor_hp) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nama, $alamat, $email, $hp]);
        
        echo "<script>alert('Anggota Berhasil Terdaftar!'); window.location='list_anggota.php';</script>";
    } catch(PDOException $e) {
        $error = "Gagal menambah anggota: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota Baru | PerpusBro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
        }
        .card-header {
            background: #FFC107; /* Warna Warning/Kuning */
            color: #212529;
            border-radius: 15px 15px 0 0 !important;
            font-weight: 600;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25 circle rgba(255, 193, 7, 0.25);
            border-color: #FFC107;
        }
        .btn-save {
            background: #212529;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-save:hover {
            background: #343a40;
            transform: translateY(-2px);
            color: #FFC107;
        }
        .icon-circle {
            width: 60px;
            height: 60px;
            background: #FFC107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -30px auto 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <div class="card shadow-lg">
                <div class="card-header text-center py-3">
                    <h4 class="mb-0">FORM REGISTRASI</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="icon-circle">👤</div>
                    
                    <p class="text-center text-muted mb-4">Lengkapi data anggota baru di bawah ini.</p>

                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">NAMA LENGKAP</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama sesuai KTP" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">EMAIL AKTIF</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@mail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">NOMOR HANDPHONE</label>
                            <input type="text" name="hp" class="form-control" placeholder="0812xxxx" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">ALAMAT LENGKAP</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Nama jalan, Nomor rumah, RT/RW..." required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-save">DAFTARKAN ANGGOTA</button>
                            <a href="list_anggota.php" class="btn btn-light border">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center mt-4 text-muted small">&copy; 2026 PerpusBro Admin System</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>