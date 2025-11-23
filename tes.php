<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Reminder</title>
    <link rel="stylesheet" href="tes.css" />
</head>
<body>

<button id="openPopup" class="open-btn">Pinjam Buku</button>

<!-- =============================
      POPUP FORM PEMINJAMAN
============================= -->
<div id="popup" class="popup-overlay">
    <div class="popup-box">
        <span id="closePopup" class="close-btn">&times;</span>

        <h2>Proses Peminjaman</h2>

        <div class="form-row">
            <label>Tanggal Peminjaman</label>
            <input type="date">
        </div>

        <div class="form-row">
            <label>Lama Peminjaman</label>
            <select>
                <option>Pilih Lama Peminjaman</option>
                <option>7 Hari</option>
                <option>14 Hari</option>
                <option>21 Hari</option>
            </select>
        </div>

        <div class="form-row">
            <label>Foto KTP/KIA</label>
            <div class="upload-box">
                <input type="file">
            </div>
        </div>

        <div class="form-row">
            <label>Nomor Telepon</label>
            <input type="text" placeholder="Masukan Nomor Telepon">
        </div>

        <p class="note">
            "Jika pengambilan buku lambat lebih dari 3 hari, maka peminjaman otomatis dibatalkan.
             Dan pengembalian buku lebih dari 5 hari akan mendapat denda 2rb/hari."
        </p>

        <h3>In Stock</h3>

        <div class="quantity-box">
            <span>Quantity:</span>
            <button id="minusBtn">−</button>
            <span id="qtyValue">1</span>
            <button id="plusBtn">+</button>
        </div>

        <button id="borrowBtn" class="borrow-btn">Borrow Now</button>
    </div>
</div>


<!-- =============================
          POPUP REMINDER
============================= -->
<div id="reminderPopup" class="popup-overlay">
    <div class="reminder-box">
        <span id="closeReminder" class="close-btn">&times;</span>

        <h2 class="reminder-title">REMINDER</h2>

        <p class="reminder-text">
            Anda sudah melakukan peminjaman bukunya, silahkan ambil buku ini di perpustakaan
            dengan jangka waktu 1 minggu. Jika lewat dari 1 minggu, peminjaman buku anda akan
            secara otomatis dibatalkan.
        </p>

        <div class="dot-indicator">
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>

        <button id="nextReminder" class="next-btn">NEXT</button>
    </div>
</div>

<script src="tes.js"></script>
</body>
</html>