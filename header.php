<?php
session_start();

$current_page = basename($_SERVER['PHP_SELF']);
switch ($current_page) {
    case 'historypage.php':
        $hero_text = 'History';
        break;
    case 'landingpage.php':
        $hero_text = 'Akses Buku Tanpa Batas, Kapan Saja, di Mana Saja';
        break;
    default:
        $hero_text = 'Selamat Datang di Website Kami';
        break;
}

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['nama'] : '';
$isProfilePage = ($current_page === 'profile.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../components/header.css" />
    <style>
        /* Style untuk dropdown profile (digunakan di semua halaman kecuali profile.php) */
        .profile-menu {
            position: relative;
            display: inline-block;
        }
        
        .profile-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            min-width: 200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 10000;
            margin-top: 10px;
        }
        
        .profile-dropdown.active {
            display: block;
        }
        
        .profile-dropdown a {
            display: block;
            padding: 12px 20px;
            color: #333 !important;
            text-decoration: none;
            font-size: 16px !important;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .profile-dropdown a:hover {
            background: #f8f9fa;
        }
        
        .profile-dropdown a:last-child {
            border-bottom: none;
            color: #e74c3c !important;
        }
        
        .profile-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
            white-space: nowrap;
        }
        
        .profile-toggle:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .profile-toggle.active {
            background: rgba(255,255,255,0.2);
        }

        /* Style untuk tombol Log Out langsung (hanya di profile.php) */
        .logout-btn {
            background: none;
            border: none;
            color: #e74c3c;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            white-space: nowrap;
            text-decoration: none;
            display: inline-block;
        }
        
        .logout-btn:hover {
            background: rgba(231, 76, 60, 0.1);
        }

        /* Tambahan untuk layout yang lebih baik */
        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="left">
                <a href="../../pages/landing/landingpage.php">Home</a>
                <a href="../../pages/allbooks/allbookspage.php">Books</a>
                <a href="../../pages/history/historypage.php">History</a>
            </div>
            
            <div class="logo-container">
                <img src="../../logo/pagepal(white).png" />
            </div>
            
            <div class="right">
                <?php if ($isLoggedIn): ?>
                    <?php if ($isProfilePage): ?>
                        <!-- Jika di halaman profile, tampilkan tombol Log Out langsung -->
                        <a href="../../pages/signout/logout.php" class="logout-btn" style="color: red;">Log Out</a>
                    <?php else: ?>
                        <!-- Jika di halaman lainnya, tampilkan dropdown profile -->
                        <div class="profile-menu" id="profileMenu">
                            <button class="profile-toggle" id="profileToggle">
                                <span>Account</span>
                                <span style="font-size: 16px;">▼</span>
                            </button>
                            <div class="profile-dropdown" id="profileDropdown">
                                <a href="../../pages/profile/profile.php">My Profile</a>
                                <a href="../../pages/history/historypage.php">My History</a>
                                <a href="../../pages/signout/logout.php">Logout</a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Jika belum login, tampilkan Sign In -->
                    <a href="../../pages/signin/signin.php">Sign In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if ($isLoggedIn && !$isProfilePage): ?>
    <script>
        // JavaScript untuk toggle dropdown (hanya diperlukan di halaman non-profile)
        document.addEventListener('DOMContentLoaded', function() {
            const profileToggle = document.getElementById('profileToggle');
            const profileDropdown = document.getElementById('profileDropdown');
            const profileMenu = document.getElementById('profileMenu');
            
            if (profileToggle && profileDropdown) {
                // Toggle dropdown ketika tombol diklik
                profileToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle('active');
                    profileToggle.classList.toggle('active');
                });
                
                // Tutup dropdown ketika klik di luar
                document.addEventListener('click', function(e) {
                    if (!profileMenu.contains(e.target)) {
                        profileDropdown.classList.remove('active');
                        profileToggle.classList.remove('active');
                    }
                });
                
                // Tutup dropdown ketika item dipilih (opsional)
                const dropdownItems = profileDropdown.querySelectorAll('a');
                dropdownItems.forEach(item => {
                    item.addEventListener('click', function() {
                        profileDropdown.classList.remove('active');
                        profileToggle.classList.remove('active');
                    });
                });
            }
        });
    </script>
    <?php endif; ?>
</body>
</html>