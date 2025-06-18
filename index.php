<?php
// Memulai session untuk mengakses variabel $_SESSION
session_start();

// Mengakses file conn.php yang berisi variabel koneksi
include 'conn.php';

// Jika tombol masuk ditekan
if(isset($_POST['login'])) {

    // Mengambil data dari form dengan method POST
    $username = $_POST['username'];
    $password = trim($_POST['password']);

    // Mencari user dengan username yang sama dengan yang dimasukkan dari database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");
    $result = mysqli_fetch_assoc($query);

    
    // Verifikasi password dari form dan password dari hasil hash di database
    if(password_verify($password, $result['password'])) {
        //  Jika verifikasi sukses, set $_session login menjadi true. Mengarahkan ke file dashboard
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <!-- Mengirimkan form dengan method post agar tidak tampil url -->
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>