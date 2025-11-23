<?php
$icon = "../../icon/magnifier.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../components/heroSection.css" />
</head>
<body>
    <div class="hero">
        <p style="font-size: <?= $font ?>;"><?= $text ?></p>
        <?php if ($showInput): ?>
        <div class="dropdown search-container">
            <img src="<?= $icon ?>" class="search-icon" alt="Search">
            <input type="text" placeholder="Search.." id="myInput" onclick="myFunction()" onkeyup="filterFunction()"
                class="dropbtn search-input" />
            <div id="myDropdown" class="dropdown-content">
                <a href="/pages/category/categorypage.php?category=math">Math</a>
                <a href="/pages/category/categorypage.php?category=english">English</a>
                <a href="/pages/category/categorypage.php?category=science">Science</a>
                <a href="/pages/category/categorypage.php?category=history">History</a>
                <a href="/pages/category/categorypage.php?category=indonesian">Indonesian</a>
                <a href="/pages/category/categorypage.php?category=arts">Art</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script src="../../components/heroSection.js"></script>
</body>
</html>