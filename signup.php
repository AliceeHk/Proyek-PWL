<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page Pal - Your Gateway to the Galaxy of Knowledge</title>
    <link rel="icon" type="image/x-icon" href="logo/favicon.png">
    <link rel="stylesheet" href="signUpPage.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap');
    </style>
</head>

<body>
    <?php
    if (isset($_POST["signup"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword =$_POST["confirmPassword"];
        $hashed = hash("sha512", $password);
        if ($password === $confirmPassword) {
            $query = mysqli_query($koneksi, query: "INSERT INTO akun (nama, email, password, peran) VALUES ('$nama', '$email', '$hashed', 'murid')");
            if ($query) {
                echo "<script>alert('Akun berhasil dibuat! Silakan masuk.'); window.location.href = 'signin.php';</script>";
            } else {
                echo "<script>alert('Gagal membuat akun. Silakan coba lagi.');</script>";
            }
        } else {
            echo "<script>alert('Kata sandi tidak cocok. Silakan coba lagi.');</script>";
        }
    }
    ?>

    <div id="login" class="login">
        <h1>Sign Up</h1>
        <form method="POST" action="">
            <div class="input">
                <input type="text" id="namaDepan" name="nama" placeholder="Username">
                <br>
                <input type="text" id="email" name="email" placeholder="Email">
                <br>
                <input type="password" id="newPassword" name="password" placeholder="New Password">
                <br>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
            </div>
            <button type="submit" name="signup">Daftar</button>
        </form>
        <p>Sudah ada akun? <a href="signin.php"><u>Sign In</u></a></p>
    </div>
    </div>
    </div>
</body>

</html>