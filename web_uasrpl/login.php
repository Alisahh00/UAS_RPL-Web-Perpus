<?php
session_start();
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Cari admin berdasarkan username
    $sql = "SELECT * FROM admins WHERE username = :user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifikasi (Gue pake cek string biasa dulu, tapi nanti saran gue pake password_hash)
    if ($admin && $pass == $admin['password']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['nama_admin'] = $admin['nama_admin'];
        
        header("Location: admin/index.php"); // Lempar ke dashboard
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin - PerpusBro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; height: 100vh; display: flex; align-items: center; }
        .login-card { width: 100%; max-width: 400px; margin: auto; padding: 20px; }
    </style>
</head>
<body>

<div class="card login-card shadow">
    <div class="card-body">
        <h3 class="text-center fw-bold mb-4">LOGIN ADMIN</h3>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">Masuk</button>
            <div class="text-center mt-3">
                <a href="index.php" class="text-decoration-none text-muted small">← Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>