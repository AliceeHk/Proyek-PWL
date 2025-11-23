<?php
session_start();
include "../../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signin/signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Tampilkan pesan sukses/error
if (isset($_SESSION['success'])) {
    $success_message = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Ambil data user dari database
$query = "SELECT * FROM akun WHERE id = '$user_id'";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Ambil statistik peminjaman user
$stats_query = "SELECT 
    COUNT(*) as total_pinjaman,
    SUM(CASE WHEN status = 'dipinjam' THEN 1 ELSE 0 END) as sedang_dipinjam,
    SUM(CASE WHEN status = 'terlambat' THEN 1 ELSE 0 END) as terlambat,
    SUM(denda) as total_denda
FROM peminjaman 
WHERE akun_id = '$user_id'";
$stats_result = mysqli_query($koneksi, $stats_query);
$stats = mysqli_fetch_assoc($stats_result);

// Ambil riwayat peminjaman terbaru
$history_query = "SELECT 
    p.kode_peminjaman,
    b.judul,
    b.penulis,
    b.sampul,
    p.tanggal_pinjam,
    p.tanggal_harus_kembali,
    p.tanggal_kembali,
    p.status,
    p.denda
FROM peminjaman p
JOIN buku b ON p.buku_id = b.id
WHERE p.akun_id = '$user_id'
ORDER BY p.tanggal_pinjam DESC
LIMIT 5";
$history_result = mysqli_query($koneksi, $history_query);
$riwayat = [];
while ($row = mysqli_fetch_assoc($history_result)) {
    $riwayat[] = $row;
}

// Ambil semua riwayat untuk section history
$full_history_query = "SELECT 
    p.kode_peminjaman,
    b.judul,
    b.penulis,
    p.tanggal_pinjam,
    p.tanggal_harus_kembali,
    p.tanggal_kembali,
    p.status,
    p.denda
FROM peminjaman p
JOIN buku b ON p.buku_id = b.id
WHERE p.akun_id = '$user_id'
ORDER BY p.tanggal_pinjam DESC";
$full_history_result = mysqli_query($koneksi, $full_history_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - <?= $user['nama'] ?> | Page Pal</title>
    <link rel="stylesheet" href="profile.css" />
    <link href="https://fonts.googleapis.com/css2?family=Platypi:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include "../../components/header.php"; ?>

    <div class="profile-container">
        <!-- SIDEBAR PROFILE -->
        <div class="profile-sidebar">
            <div class="user-info">
                <div class="avatar" id="avatarContainer">
                    <?php
                    $profile_picture = '../../icon/profile-picture.png';
                    if (!empty($user['foto_profil']) && file_exists('../../uploads/profiles/' . $user['foto_profil'])) {
                        $profile_picture = '../../uploads/profiles/' . $user['foto_profil'];
                    }
                    ?>
                    <img src="<?= $profile_picture ?>" alt="Profile Picture" id="avatarImage">
                    <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                    <div class="avatar-overlay" id="avatarOverlay">
                        <span>Ganti Foto</span>
                    </div>
                </div>
                <h2 class="user-name"><?= $user['nama'] ?></h2>
                <p class="user-email"><?= $user['email'] ?></p>
                <p class="user-role"><?= ucfirst($user['peran']) ?></p>
                <?php if ($user['kelas']): ?>
                    <p class="user-class">Kelas: <?= $user['kelas'] ?></p>
                <?php endif; ?>
            </div>

            <a href="#overview" class="nav-item active">
                    <span>Dashboard</span>
                </a>
                <a href="#history" class="nav-item">
                    <span>Riwayat</span>
                </a>
                <a href="#settings" class="nav-item">
                    <span>Pengaturan</span>
                </a>
                <a href="../../pages/signout/logout.php" class="nav-item logout">
                    <span>Log Out</span>
                </a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="profile-content">
            <!-- OVERVIEW SECTION -->
            <section id="overview" class="content-section active">
                <div class="section-header">
                    <h1>Dashboard Overview</h1>
                    <p>Ringkasan aktivitas peminjaman Anda</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <img src="../../icon/books.png" alt="Total Books">
                        </div>
                        <div class="stat-info">
                            <h3><?= $stats['total_pinjaman'] ?? 0 ?></h3>
                            <p>Total Peminjaman</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <img src="../../icon/book.png" alt="Borrowed">
                        </div>
                        <div class="stat-info">
                            <h3><?= $stats['sedang_dipinjam'] ?? 0 ?></h3>
                            <p>Sedang Dipinjam</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <img src="../../icon/calendar.png" alt="Late">
                        </div>
                        <div class="stat-info">
                            <h3><?= $stats['terlambat'] ?? 0 ?></h3>
                            <p>Keterlambatan</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <img src="../../icon/money.png" alt="Fine">
                        </div>
                        <div class="stat-info">
                            <h3>Rp <?= number_format($stats['total_denda'] ?? 0, 0, ',', '.') ?></h3>
                            <p>Total Denda</p>
                        </div>
                    </div>
                </div>

                <div class="recent-activity">
                    <h2>Aktivitas Terbaru</h2>
                    <div class="activity-list">
                        <?php if (empty($riwayat)): ?>
                            <div class="empty-state">
                                <img src="icon/empty-book.png" alt="No Activity">
                                <p>Belum ada aktivitas peminjaman</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($riwayat as $peminjaman): ?>
                                <div class="activity-item">
                                    <div class="book-cover">
                                        <img src="<?= $peminjaman['sampul'] ?>" alt="Book Cover">
                                    </div>
                                    <div class="activity-details">
                                        <h4><?= $peminjaman['judul'] ?></h4>
                                        <p class="author"><?= $peminjaman['penulis'] ?></p>
                                        <div class="activity-meta">
                                            <span class="kode">Kode: <?= $peminjaman['kode_peminjaman'] ?></span>
                                            <span class="tanggal">Pinjam: <?= $peminjaman['tanggal_pinjam'] ?></span>
                                            <span class="status <?= $peminjaman['status'] ?>">
                                                <?= ucfirst($peminjaman['status']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- HISTORY SECTION -->
            <section id="history" class="content-section">
                <div class="section-header">
                    <h1>Riwayat Peminjaman</h1>
                    <p>Semua history peminjaman buku Anda</p>
                </div>
                <div class="history-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Kode Pinjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($full_history_result) > 0): ?>
                                <?php while ($history = mysqli_fetch_assoc($full_history_result)): ?>
                                    <tr>
                                        <td class="book-info">
                                            <strong><?= $history['judul'] ?></strong>
                                            <br>
                                            <small><?= $history['penulis'] ?></small>
                                        </td>
                                        <td><?= $history['kode_peminjaman'] ?></td>
                                        <td><?= $history['tanggal_pinjam'] ?></td>
                                        <td><?= $history['tanggal_harus_kembali'] ?></td>
                                        <td>
                                            <span class="status-badge <?= $history['status'] ?>">
                                                <?= ucfirst($history['status']) ?>
                                            </span>
                                        </td>
                                        <td class="denda">
                                            Rp <?= number_format($history['denda'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px;">
                                        <div class="empty-state">
                                            <img src="icon/empty-book.png" alt="No History">
                                            <p>Belum ada riwayat peminjaman</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- SETTINGS SECTION -->
            <section id="settings" class="content-section">
                <div class="section-header">
                    <h1>Pengaturan Akun</h1>
                    <p>Kelola informasi profil Anda</p>
                </div>

                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success">
                        <?= $success_message ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-error">
                        <?= $error_message ?>
                    </div>
                <?php endif; ?>

                <div class="settings-form">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" id="kelas" name="kelas" value="<?= $user['kelas'] ?? '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="foto_profil">Foto Profil</label>
                            <input type="file" id="foto_profil" name="foto_profil" accept="image/*">
                            <small>Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Password Baru</label>
                            <input type="password" id="confirmPassword" name="confirmPassword">
                        </div>

                        <button type="submit" class="save-btn">Simpan Perubahan</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script src="profile.js"></script>
</body>

</html>