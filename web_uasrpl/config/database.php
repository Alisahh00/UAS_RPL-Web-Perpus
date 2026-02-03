<?php
$hostname = "sql213.infinityfree.com";
$username = "if0_41036249";
$password = "heri09876";
$database_name = "if0_41036249_bukutamu";

try {
    // Pastikan nama variabel di dalam sini SAMA dengan yang di atas
    $conn = new PDO("mysql:host=$hostname;dbname=$database_name", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Koneksi Berhasil!"; 
} catch(PDOException $exception) {
    echo "Koneksi Gagal: " . $exception->getMessage();
}
?>