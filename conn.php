<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "coffeeshop");
// Tampilkan error jika koneksi gagal
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>