<?php
require_once '../config/database.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM anggota WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: list_anggota.php");
?>