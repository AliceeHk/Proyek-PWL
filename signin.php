<?php
session_start();
include "../../koneksi.php"; // Dari pages/signin/ ke root (naik 2 level)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="signInPage.css">
    <title>Page Pal - Your Gateway to the Galaxy of Knowledge</title>
    <link rel="icon" type="image/x-icon" href="../../logo/favicon.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap');
    </style>
</head>

<body>

    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashed = hash("sha512", $password);
        $query = mysqli_query($koneksi, "SELECT * FROM akun where email='$email' and password='$hashed'");

        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_array($query);
            
            // SET SESSION YANG BENAR
            $_SESSION["user_id"] = $data['id'];
            $_SESSION["akun"] = $data;
            $_SESSION["nama"] = $data['nama'];
            $_SESSION["peran"] = $data['peran'];
            
            echo "<script>alert('Selamat datang, " . $data['nama'] . "'); 
                    location.href='../landing/landingpage.php';</script>";
        } else {
            echo "<script>alert('Email atau password tidak sesuai');</script>";
        }
    }
    ?>
    <div id="login" class="login">
        <h1>Sign In</h1>
        <form method="POST" action="">
            <div class="input">
                <input type="text" class="inputEmail" name="email" placeholder="Email">
                <br>
                <input type="password" class="inputPassword" name="password" placeholder="Password">
            </div>
            <button name="login" type="submit">Masuk</button>
        </form>
        <h4>or</h4>
        <div class="loginSosmed">
            <a href="https://web.facebook.com/?_rdc=1&_rdr#">
                <button class="loginGoogle">
                    <img src="../../logo/google.png">Masuk dengan Google
                </button>
            </a>
        </div>
        <p style="margin-left: 30px; margin-top: -1px;">Belum ada akun? <a href="../signup/signup.php"><u>Buat Sekarang</u></a>
        </p>
    </div>
</body>

</html>