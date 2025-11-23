<?php
session_start();
include "../../koneksi.php";

$category = $_GET['category'] ?? '';

$categoryNames = [
    'math' => 'Mathematic',
    'english' => 'English',
    'science' => 'Science',
    'history' => 'History',
    'indonesian' => 'Indonesian',
    'arts' => 'Arts'
];

$categoryName = $categoryNames[$category] ?? 'Kategori';
$text = $categoryName;
$font = "1000%";
$showInput = false;
$judul = "Buku " . $categoryName;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $categoryName ?> - PagePal</title>
  <link rel="stylesheet" href="categorypage.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap");
  </style>
</head>
 
<body>
  <?php
  $mysqli = new mysqli("localhost", "root", "", "pagepal");
  ?>

  <?php include "../../components/header.php"; ?>
  <?php include "../../components/heroSection.php"; ?>

  <h1 class="judul"><?= $judul ?></h1>

  <div id="booklist">
    <?php
    if (!empty($category)) {
        $result = $mysqli->query("SELECT * FROM buku WHERE kategori = '$category'") 
              or die($mysqli->error);

        $books = [];
        while ($row = $result->fetch_assoc()) {
          $books[] = $row;
        }
        
        $totalBooks = count($books);
        
        if ($totalBooks > 0) {
            $displayCount = floor($totalBooks / 3) * 3;
            
            if ($displayCount == 0 && $totalBooks > 0) {
                $displayCount = min(3, $totalBooks);
            }

            for ($i = 0; $i < $displayCount; $i++): ?>
              <a href="../description/deskripsi.php?bookId=<?= $books[$i]['id'] ?>" class="book">
                <div class="img"><img src="<?= $books[$i]['sampul'] ?>" alt="<?= $books[$i]['judul'] ?>"></div>
                <p id="penulis"><?= $books[$i]['penulis'] ?></p>
                <p id="judul"><?= $books[$i]['judul'] ?></p>
              </a>
            <?php endfor;
            
        } else {
            echo "<p style='grid-column: 1 / -1; text-align: center; font-size: 1.5em; color: #666;'>Tidak ada buku dalam kategori ini.</p>";
        }
    } else {
        echo "<p style='grid-column: 1 / -1; text-align: center; font-size: 1.5em; color: #666;'>Kategori tidak ditemukan.</p>";
    }
    
    $mysqli->close();
    ?>
</div>
  <?php include "../../components/footer.php"; ?>
</body>
</html>