<?php
session_start();
require_once 'koneksi.php'; // Pastikan file ini terhubung ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validasi input
    if (!empty($email) && !empty($password)) {
        // Cek apakah email yang dimasukkan adalah untuk admin
        if ($email === 'admin' && $password === 'admin') {
            // Set session untuk admin
            $_SESSION['user'] = [
                'email' => 'admin',
                'nama' => 'Admin',
                'role' => 'admin'
            ];
            header('Location: admin/dashboard_admin.php'); // Halaman dashboard admin
            exit();
        } else {
            // Jika bukan admin, cek apakah email valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_message = "Format email tidak valid.";
            } else {
                // Menggunakan prepared statement untuk mencegah SQL Injection
                $stmt = $koneksi->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    // Verifikasi password
                    if (password_verify($password, $user['password'])) {
                        // Login berhasil
                        $_SESSION['user'] = [
                            'email' => $user['email'],
                            'nama' => $user['nama'],
                            'role' => $user['role']
                        ];
                        header('Location: dashboard.php'); // Halaman dashboard pengguna biasa
                        exit();
                    } else {
                        $error_message = "Login gagal. Password Anda salah.";
                    }
                } else {
                    $error_message = "Login gagal. Email tidak ditemukan.";
                }

                $stmt->close();
            }
        }
    } else {
        $error_message = "Harap isi email dan password.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="text" name="email" id="email" required><br> <!-- Ubah type menjadi text untuk menerima email atau admin -->
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Registrasi di sini</a></p>
</body>
</html>
