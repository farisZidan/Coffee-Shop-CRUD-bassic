<?php
// Mulai session
session_start();
// Verifikasi status login
if($_SESSION['login'] !== true) {
    // Paksa ke page index jika belum login
    header("Location: index.php");
}
// Koneksi ke database
include 'conn.php';

// Jalankan jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Mengambil data dari form dengan method POST
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    // Menjalankan fungsi upload lalu mengambil hasilnya ke variabel berian string kosong jika function gagal
    $gambar = upload() ?? '';

// Query ke database untuk Memasukkan data
$query = "INSERT INTO menu
            VALUES
            ('', '$nama', '$gambar', '$harga', '$deskripsi')";
    // Eksekusi Query
    mysqli_query($conn, $query);

}
// Fungsi untuk upload gambar
function upload() {
    // Mengambil data namaFile dan tmpname
    $namaFile = htmlspecialchars($_FILES['gambar']['name']);
    $tmpName = htmlspecialchars($_FILES['gambar']['tmp_name']);

    // Memindah file ke folder img
    move_uploaded_file($tmpName, 'img/' . $namaFile);

    // Mengembalikan nama dari file
    return $namaFile;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>
<body>
    <h1><a href="dashboard.php">Tambah</a></h1>
    <!-- Mengatur form ke method post dan enctype untuk handle upload file -->
    <form method="post" enctype="multipart/form-data">
        <label for="nama">Nama :</label>
        <input type="text" name="nama"><br><br>

        <!-- Mengatur inputan ke jenis file -->
        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <label for="harga">Harga :</label>
        <input type="number" name="harga"><br><br>

        <label for="deskripsi">Deskripsi :</label>
        <textarea name="deskripsi"></textarea><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>