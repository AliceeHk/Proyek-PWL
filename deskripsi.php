<?php
session_start();
include "../../koneksi.php";

// AMBIL bookId DARI URL PARAMETER
$bookId = isset($_GET['bookId']) ? intval($_GET['bookId']) : 0;

if (empty($bookId)) {
    die("Book ID tidak ditemukan");
}

// CEK APAKAH USER SUDAH LOGIN UNTUK FITUR PEMINJAMAN
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;

$mysqli = new mysqli("localhost", "root", "", "pagepal");
$result = $mysqli->query("SELECT * FROM buku WHERE id = '$bookId'");
$book = $result->fetch_assoc();

if (!$book) {
    die("Buku tidak ditemukan");
}

// PROSES PEMINJAMAN JIKA FORM DISUBMIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_borrow'])) {
    if (!$isLoggedIn) {
        echo "<script>alert('Silakan login terlebih dahulu untuk meminjam buku'); 
                location.href='../signin/signin.php';</script>";
        exit();
    }

    $buku_id = $bookId;
    $lama_pinjaman = $_POST['lama_pinjaman'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Proses peminjaman menggunakan function dari koneksi.php
    $result = prosesPeminjaman($user_id, $buku_id, $lama_pinjaman, $nomor_telepon);

    if ($result['success']) {
        echo "<script>alert('" . $result['message'] . "');</script>";
    } else {
        echo "<script>alert('" . $result['message'] . "');</script>";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $book['judul'] ?> - Page Pal</title>
    <link rel="stylesheet" href="deskripsi.css" />
</head>

<body>
    <?php include "../../components/header.php"; ?>

    <img src="<?= $book['sampul'] ?>"
        style="width: 23%;margin-top:10%; margin-left: 5%; box-shadow: 0 0px 10px rgba(0,0,0,0.5);float: left; border-radius: 15px 15px 0px 0px;">

    <div class="deskripsi_b">
        <h3 class="judul_buku"><?= $book['judul'] ?></h3>
        <p class="tanggal_buku">Tahun Terbit: <?= $book['tahun_terbit'] ?></p>
        <p class="penerbit">by <span style="color: dodgerblue;"><?= $book['penulis'] ?></span></p>

        <div class="starr">
            <img src="../../icon/star.png" height="20px" />
            <img src="../../icon/star.png" height="20px" />
            <img src="../../icon/star.png" height="20px" />
            <img src="../../icon/star.png" height="20px" />
            <img src="../../icon/star.png" height="20px" />
            <p style="margin-left: 10px;">5.0 </p>
            <img src="../../icon/down-arrow.png" height="20px" style="margin-left: 10px;">
            <p style="color: dodgerblue; margin-left: 30px;">304 ratings</p>
        </div>

        <div class="garis"></div>

        <div class="comment">
            <img src="../../icon/chat-box.png" style="width: 20px;">
            <p style="color: dodgerblue; margin-left: 10px;">Report an issue with this product</p>
        </div>

        <div class="garis"></div>

        <div class="informasi">
            <table>
                <tr>
                    <th>Print Length</th>
                    <th>Publisher</th>
                    <th>Publication Date</th>
                    <th>Cover</th>
                    <th>Size</th>
                </tr>
                <tr>
                    <td><img src="../../icon/document.png"></td>
                    <td><img src="../../icon/building (1).png"></td>
                    <td><img src="../../icon/calendar (1).png"></td>
                    <td><img src="../../icon/document.png"></td>
                    <td><img src="../../icon/building (1).png"></td>
                </tr>
                <tr>
                    <td>
                        <p><?= $book['halaman'] ?> pages</p>
                    </td>
                    <td>
                        <p><?= $book['penerbit'] ?? 'Checklist' ?></p>
                    </td>
                    <td>
                        <p><?= $book['tahun_terbit'] ?></p>
                    </td>
                    <td>
                        <p><?= $book['cover'] ?></p>
                    </td>
                    <td>
                        <p><?= $book['ukuran'] ?></p>
                    </td>

                </tr>
            </table>
        </div>

        <div class="follow" style="">
            <h3 style="margin-left: 3%; margin-top: -3%;margin-bottom: 1%; font-size: 150%;">Follow the authors</h3>
            <div class="bag">
                <img src="../../icon/profile-picture.png" style="width: 3%;margin-left: 4%;margin-right: 1%;">
                <h5 style="margin-top: 1%;"><?= $book['penulis'] ?></h5>
                <button
                    style="margin-left: 1%; width: 6%; height: 7%;margin-top: 1%;background-color: #4885b3; color: white; border: none;border-radius: 5px 5px 5px 5px;">Follow</button>
            </div>
        </div>

        <p class="details" style="color: dodgerblue;">See all details</p>
        <div class="garis_tbh"></div>
        <button
            style="margin-left: 44%; width: 11%; height: 10%;margin-top: 5%;background-color: #4885b3; color: white; border: none;border-radius: 5px 5px 5px 5px;font-size: 20px;"
            id="borrowBtn" class="borrow-btn">Borrow Now</button>

        <!-- POPUP FORM PEMINJAMAN -->
        <div id="popup" class="popup-overlay">
            <div class="popup-box">
                <span id="closePopup" class="close-btn">&times;</span>

                <h2>Proses Peminjaman</h2>

                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-row">
                        <label>Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_pinjam" required>
                    </div>

                    <div class="form-row">
                        <label>Lama Peminjaman</label>
                        <select name="lama_pinjaman" required>
                            <option value="">Pilih Lama Peminjaman</option>
                            <option value="7">7 Hari</option>
                            <option value="14">14 Hari</option>
                            <option value="21">21 Hari</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label>Foto KTP/KIA</label>
                        <div class="upload-box">
                            <input type="file" name="foto_ktp">
                        </div>
                    </div>

                    <div class="form-row">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" placeholder="Masukan Nomor Telepon" required>
                    </div>

                    <p class="note">
                        "Jika pengambilan buku lambat lebih dari 3 hari, maka peminjaman otomatis dibatalkan.
                        Dan pengembalian buku lebih dari 5 hari akan mendapat denda 2rb/hari."
                    </p>

                    <h3>In Stock</h3>

                    <div class="quantity-box">
                        <span>Quantity:</span>
                        <button id="minusBtn" type="button">−</button>
                        <span id="qtyValue">1</span>
                        <button id="plusBtn" type="button">+</button>
                    </div>

                    <button type="submit" name="submit_borrow" class="borrow-btn">Borrow Now</button>
                </form>
            </div>
        </div>

        <!-- POPUP REMINDER -->
        <div id="reminderPopup" class="popup-overlay">
            <div class="reminder-box">
                <span id="closeReminder" class="close-btn">&times;</span>

                <!-- Halaman 1 Reminder -->
                <div id="reminderPage1" class="reminder-page active">
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

                <!-- Halaman 2 Reminder -->
                <div id="reminderPage2" class="reminder-page">
                    <h2 class="reminder-title">REMINDER</h2>

                    <p class="reminder-text">
                        Silahkan cek tanggal<br>
                        pengembalian buku anda<br>
                        di bagian History anda
                    </p>

                    <div class="dot-indicator">
                        <span class="dot"></span>
                        <span class="dot active"></span>
                    </div>

                    <button id="confirmReminder" class="confirm-btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "../../components/footer.php"; ?>

    <script src="deskripsi.js"></script>
</body>

</html>