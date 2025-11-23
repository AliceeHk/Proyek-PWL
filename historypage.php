<?php
$text = "My History";
$font = "1000%";
$showInput = false;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../pages/history/historypage.css">
</head>

<body>
  <?php include "../../components/header.php"; ?>
  <?php include "../../components/heroSection.php"; ?>

  <section class="isi">
    <h2 class="judul">Baru saja</h2>

    <div class="buku">
      <img src="../../sampul buku/Ensiklopedia Sains.png" alt="Ensiklopedia Sains">
      <div class="info">
        <h3>ENSIKLOPEDIA SAINS - Belinda Gallagher</h3>
        <p>Tanggal Peminjaman: 9-05-2025</p>
        <p>Tanggal Pengembalian: 14-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>

    <div class="buku">
      <img src="../../sampul buku/Art Of War.png" alt="Art of War">
      <div class="info">
        <h3>Art Of War - Asti Musman</h3>
        <p>Tanggal Peminjaman: 9-05-2025</p>
        <p>Tanggal Pengembalian: 15-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>
  </section>

  <section class="isi">
    <h2 class="judul">Kemarin</h2>

    <div class="buku">
      <img src="../../sampul buku/Mahfud MD.png" alt="Mahfud MD">
      <div class="info">
        <h3>Mahfud MD - Weda Satyanaegara</h3>
        <p>Tanggal Peminjaman: 6-05-2025</p>
        <p>Tanggal Pengembalian: 8-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>
  </section>

    <section class="isi">
    <h2 class="judul">2 Hari yang Lalu</h2>

    <div class="buku">
      <img src="../../sampul buku/Sekak Math!.png" alt="SekakMath">
      <div class="info">
        <h3>SekakMath - Muh. Fajarudin</h3>
        <p>Tanggal Peminjaman: 4-05-2025</p>
        <p>Tanggal Pengembalian: 7-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>

    <div class="buku">
      <img src="../../sampul buku/Indonesian for Beginners.png" alt="Indonesia For Beginners">
      <div class="info">
        <h3>Indonesia For Beginners - Kesaint Blanc</h3>
        <p>Tanggal Peminjaman: 4-05-2025</p>
        <p>Tanggal Pengembalian: 6-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>

    <div class="buku">
      <img src="../../sampul buku/Ratu Kalinyamal.png" alt="RatuKalinyamal">
      <div class="info">
        <h3>Ratu Kalinyamal - Setyo Wardoyo</h3>
        <p>Tanggal Peminjaman: 4-05-2025</p>
        <p>Tanggal Pengembalian: 8-05-2025</p>
      </div>
      <button class="tombol">Ingatkan aku</button>
    </div>
  </section>
  <?php include "../../components/footer.php"; ?>
</body>
</html>