<?php
session_start();

// Jika $_session login tidak berisi true maka memaksa kembali ke file index
if($_SESSION['login'] !== true) {
    header("Location: index.php");
}

// Koneksi database
include 'conn.php';

// Query semua data di tabel menu
$query = mysqli_query($conn, "SELECT * FROM menu");
// Inisialisasi variabel untuk array
$data = [];
// Mengubah hasil query ke bentuk associative array dan menyusun ke array
while ($result = mysqli_fetch_assoc($query)) {
$data[] = $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5f7;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        h1 {
            color: #e91e63;
            text-align: center;
            margin-bottom: 20px;
        }
        
        a {
            color: #e91e63;
            text-decoration: none;
            font-weight: bold;
        }
        
        a:hover {
            text-decoration: underline;
            color: #c2185b;
        }
        
        button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        button:hover {
            background-color: #c2185b;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(233, 30, 99, 0.1);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ffc0cb;
        }
        
        th {
            background-color: #e91e63;
            color: white;
        }
        
        tr:nth-child(even) {
            background-color: #fff0f5;
        }
        
        tr:hover {
            background-color: #ffebee;
        }
        
        img {
            border-radius: 4px;
            border: 1px solid #ffc0cb;
        }
        
        /* ketika fungsi window.print() dijalankan */
        @media print {
            /* Menghilangkan item yang memiliki class tersebut */
            .display-none {
                display: none;
            }
            
            body {
                background-color: white;
            }
            
            table {
                box-shadow: none;
            }
            
            th {
                background-color: white !important;
                color: black !important;
                border-bottom: 2px solid black;
            }
        }
    </style>
</head>
<body>
    <h1>Menu</h1>
    <a href="tambah.php" class="display-none">Tambah</a>
    <!-- Menjalankan fungsi print ketika diklik -->
    <button class="display-none" onclick="window.print()">Cetak</button>
    <table>
        <thead>
        <tr>
            <th class="display-none">Aksi</th>
            <th>Id</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Deskripsi</th>
        </tr>
        </thead>
        <tbody>
            <!-- Mengambil data array satu persatu dengan looping -->
            <?php foreach ($data as $row) : ?>
            <tr>
                <!-- Mengakses file ubah.php dan mengirim id dengan method GET -->
                <td class="display-none"><a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a> ||
                <!-- Mengakses file hapus.php dan mengirim id dengan method GET -->
                <a href="hapus.php?id=<?= $row['id'] ?>">Hapus</a></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><img src="img/<?php echo $row['gambar']; ?>" alt="" width="100"></td>
                <td><?php echo $row['harga']; ?></td>
                <td><?php echo $row['deskripsi']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>