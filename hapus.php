<?php 
// Mulai session
session_start();

// Verifikasi apakah sudah login
if($_SESSION['login'] !== true) {
    header("Location: index.php");
}
// Koneksi database
include 'conn.php';

// Mengambil data id yang dikirim dengan method GET
$id = $_GET['id'];

// Query hapus data berdasarkan id yang dikirim
mysqli_query($conn, "DELETE FROM menu WHERE id = '$id'");

// Kembali ke page dashboard
header('Location: dashboard.php');
?>