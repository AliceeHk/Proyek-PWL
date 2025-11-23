<?php
session_start();
include "../../koneksi.php";
$text = "Akses Buku Tanpa Batas, Kapan Saja, di Mana Saja";
$font = "400%";
$showInput = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Page Pal - Your Gateway to the Galaxy of Knowledge</title>
  <link rel="stylesheet" href="allbookspage.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap");
  </style>
</head>

<body>
  <?php
  $mysqli = new mysqli("localhost", "root", "", "pagepal");
  $table = "buku";
  $sampul = $mysqli->query("SELECT * FROM $table") or die($mysqli->error);
  ?>

  <?php include "../../components/header.php"; ?>
  <?php include "../../components/heroSection.php"; ?>

  <h1 class="judul">Top Book</h1>

  <div id="booklist">
    <?php
    $result = $mysqli->query("SELECT * FROM buku") or die($mysqli->error);

    $books = [];
    while ($row = $result->fetch_assoc()) {
      $books[] = $row;
    }
    foreach ($books as $book): ?>
    <div id="book">
      <a href="../description/deskripsi.php?bookId=<?= $book['id'] ?>" class="book">
        <img src="<?= $book['sampul'] ?>" alt="<?= $book['judul'] ?>">
        <p id="penulis"><?= $book['penulis'] ?></p>
        <p id="judul"><?= $book['judul'] ?></p>
      </a>
      </div>
    <?php endforeach; ?>
  </div>
  <?php include "../../components/footer.php" ?>
</body>
</html>