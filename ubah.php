<?php 
// Mulai session
session_start();
// Verifikasi login
if($_SESSION['login'] !== true) {
    header("Location: index.php");
}
// Koneksi database
include 'conn.php';
// Mengambil data id yang dikirim dari metode GET
$id = $_GET['id'];

// Query tampilkan data berdasarkan id yang diambil dari GET
$query = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id");
// Mengubah hasil query ke bentuk associative array
$row = mysqli_fetch_assoc($query);
// Menjalankan jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Mengambil data dari variabel POST
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Mengambil nama gambar yang sekarang tampil 
    $gambarLama = $row['gambar'];

    // Menjalankan fungsi upload dan memasukkan hasilnya ke variabel, jika gambar tidak diupload, maka mengambil nama gambar lama
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // Query update data berdasarkan data yang diinput
    $query = "UPDATE menu SET 
            nama = '$nama', gambar = '$gambar', harga = '$harga', deskripsi = '$deskripsi' WHERE id = '$id'";
    // Eksekusi query
    mysqli_query($conn, $query);
}
// Fungsi upload file
function upload() {
    // Memgambil nama file dan tmpName untuk upload
    $namaFile = htmlspecialchars($_FILES['gambar']['name']);
    $tmpName = htmlspecialchars($_FILES['gambar']['tmp_name']);
    
    // Upload file ke folde img
    move_uploaded_file($tmpName, 'img/' . $namaFile);
    // Mengembalikan nama file
    return $namaFile;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1><a href="dashboard.php">Menu</a></h1>
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Deskripsi</th>
        </tr>
        </thead>
        <tbody>
            <tr>        
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><img src="img/<?php echo $row['gambar']; ?>" alt="" width="100"></td>
                <td><?php echo $row['harga']; ?></td>
                <td><?php echo $row['deskripsi']; ?></td>
            </tr>
        </tbody>
    </table>

    <h1>Ubah</h1>
    <!-- Mengatur form ke method post dan enctype untuk menangani upload file -->
    <form method="post" enctype="multipart/form-data">
        <label for="nama">Nama :</label>
        <input type="text" name="nama"><br><br>
        
        <!-- Mengatur form ke upload an file -->
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