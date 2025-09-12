<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page Pal - Your Gateway to the Galaxy of Knowledge</title>
    <link rel="stylesheet" href="./landingpage.css" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap");
    </style>
</head>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "pagepal");
    $table = "buku";

    $sampul = $mysqli->query("SELECT * FROM $table") or die($mysqli->error);
    while ($data = $sampul->fetch_assoc()) {
        // print_r($data);
    }
    ?>
    <nav>
        <div class="left">
            <a href="landingpage.php">Home</a>
            <a href="signin.php">Books</a>
            <a href="signup.php">History</a>
        </div>
        <img src="logo/pagepal(white).png" />
        <div class="right">
            <a href="signin.php">Signin</a>
        </div>
    </nav>

    <div class="hero">
        <p>Akses Buku Tanpa Batas, Kapan Saja, di Mana Saja</p>
        <div class="dropdown">
            <input type="text" placeholder="Search.." id="myInput" onclick="myFunction()" onkeyup="filterFunction()"
                class="dropbtn" />
            <div id="myDropdown" class="dropdown-content">
                <a href="#about">Math</a>
                <a href="#base">English</a>
                <a href="#blog">Science</a>
                <a href="#contact">History</a>
                <a href="#custom">Indonesian</a>
                <a href="#support">Art</a>
            </div>
        </div>
    </div>

    <div id="allbooks">
        <img src="icon/All books.png" class="allbooks" />
        <p>Rekomendasi Buku</p>
    </div>

    <div id="booklist">
        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 1") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>Produk Kreatif dan Kewirausahaan</p>';
            echo '</div>';
        }
        ?>

        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 2") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>Belajar Bahasa Inggris</p>';
            echo '</div>';
        }
        ?>

        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 3") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>Bahasa Indonesia</p>';
            echo '</div>';
        }
        ?>

        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 4") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>Dasar-Dasar Seni Rupa</p>';
            echo '</div>';
        }
        ?>
        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 5") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>The Big Fat</p>';
            echo '</div>';
        }
        ?>

        <?php
        $first = $mysqli->query("SELECT * FROM buku WHERE id = 6") or die($mysqli->error);
        while ($data = $first->fetch_assoc()) {
            echo '<div id="book">';
            echo '<img src="' . $data['sampul'] . '">';
            echo '<p>Sains</p>';
            echo '</div>';
        }
        ?>
    </div>
    <p id="viewall">View All</p>
    <hr />

    <div id="category">
        <div id="cat">
            <p class="math">Mathematic</p>
        </div>
        <div id="cat">
            <p class="eng">English</p>
        </div>
        <div id="cat">
            <p class="sci">Science</p>
        </div>
        <div id="cat">
            <p class="hist">History</p>
        </div>
        <div id="cat">
            <p class="ind">Indonesian</p>
        </div>
        <div id="cat">
            <p class="art">Arts</p>
        </div>
    </div>
    <hr />

    <footer id="footer">
  <div class="footer-container">
    <div class="footer-download">
      <h3>Download the App</h3>
      <div class="download-box">
        <input type="text" placeholder="Enter phone number to send a link">
        <button>&rarr;</button>
      </div>
      <p class="rates">Message and data rates may apply</p>
<div class="store-buttons">
  <a href="#" class="download-btn">
    <img src="logo/apple.png" alt="Apple">
    <div>
      <p>Download on the</p>
      <p class="big">App Store</p>
    </div>
  </a>

  <a href="#" class="download-btn">
    <img src="logo/playstore.png" alt="Google Play">
    <div>
      <p>GET IT ON</p>
      <p class="big">Google Play</p>
    </div>
  </a>
</div>
    </div>

    <div class="footer-links">
      <h3>Need Help?</h3>
      <ul>
        <li><a href="#">Customer Service</a></li>
        <li><a href="#">Report illegal content</a></li>
        <li><a href="#">Returns & Replacements</a></li>
      </ul>
    </div>

    <div class="footer-links">
      <h3>About</h3>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Our Team</a></li>
        <li><a href="#">News</a></li>
      </ul>
    </div>

    <div class="footer-social">
      <h3>Follow Us</h3>
      <ul>
        <li><a href="#"><img src="logo/instagram.png"> Instagram</a></li>
        <li><a href="#"><img src="logo/x.png"> X</a></li>
        <li><a href="#"><img src="logo/tiktok.png"> TikTok</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2023 Page pal. All rights reserved.</p>
  </div>
</footer>



    <script src="landingpage.js"></script>
</body>

</html>