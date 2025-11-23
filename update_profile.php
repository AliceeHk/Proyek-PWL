<?php
session_start();
include "../../koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../signin/signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Initialize variables
    $foto_profil = '';
    $error = '';
    $success = '';

    // Handle file upload - SIMPLIFIED
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        $max_size = 2 * 1024 * 1024; // 2MB
        
        $file_type = $_FILES['foto_profil']['type'];
        $file_size = $_FILES['foto_profil']['size'];
        
        // Check file type and size
        if (in_array($file_type, $allowed_types) && $file_size <= $max_size) {
            
            // Generate unique filename
            $ext = strtolower(pathinfo($_FILES['foto_profil']['name'], PATHINFO_EXTENSION));
            $foto_profil = 'profile_' . $user_id . '_' . time() . '.' . $ext;
            $upload_dir = '../../uploads/profiles/';
            $upload_path = $upload_dir . $foto_profil;
            
            // Create directory if not exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $upload_path)) {
                $success .= "Foto profil berhasil diupload. ";
                
                // Delete old profile picture if exists
                $old_query = "SELECT foto_profil FROM akun WHERE id = '$user_id'";
                $old_result = mysqli_query($koneksi, $old_query);
                if ($old_result && mysqli_num_rows($old_result) > 0) {
                    $old_data = mysqli_fetch_assoc($old_result);
                    if (!empty($old_data['foto_profil']) && 
                        file_exists($upload_dir . $old_data['foto_profil']) &&
                        $old_data['foto_profil'] != $foto_profil) {
                        unlink($upload_dir . $old_data['foto_profil']);
                    }
                }
            } else {
                $error .= "Gagal mengupload foto profil. ";
            }
        } else {
            if (!in_array($file_type, $allowed_types)) {
                $error .= "File harus berupa gambar (JPG, PNG, GIF). ";
            }
            if ($file_size > $max_size) {
                $error .= "Ukuran file maksimal 2MB. ";
            }
        }
    }
    
    // Check if email already exists (excluding current user)
    $email_check_query = "SELECT id FROM akun WHERE email = '$email' AND id != '$user_id'";
    $email_check_result = mysqli_query($koneksi, $email_check_query);
    
    if ($email_check_result && mysqli_num_rows($email_check_result) > 0) {
        $error .= "Email sudah digunakan oleh akun lain. ";
    }
    
    // If no errors, update the profile
    if (empty($error)) {
        // Build update query
        $update_fields = [
            "nama = '$nama'", 
            "email = '$email'", 
            "kelas = '$kelas'"
        ];
        
        if (!empty($foto_profil)) {
            $update_fields[] = "foto_profil = '$foto_profil'";
        }
        
        if (!empty($password)) {
            // Validate password confirmation
            if ($password !== ($_POST['confirmPassword'] ?? '')) {
                $error .= "Password dan konfirmasi password tidak cocok. ";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_fields[] = "password = '$hashed_password'";
                $success .= "Password berhasil diubah. ";
            }
        }
        
        // Only proceed with update if no password error
        if (empty($error)) {
            $update_query = "UPDATE akun SET " . implode(', ', $update_fields) . " WHERE id = '$user_id'";
            
            if (mysqli_query($koneksi, $update_query)) {
                // Update session data
                $_SESSION['nama'] = $nama;
                if (!empty($foto_profil)) {
                    $_SESSION['foto_profil'] = $foto_profil;
                }
                
                if (empty($success)) {
                    $success = "Profil berhasil diperbarui!";
                }
                $_SESSION['success'] = $success;
            } else {
                $error = "Gagal memperbarui profil: " . mysqli_error($koneksi);
            }
        }
    }
    
    // Set error message if any
    if (!empty($error)) {
        $_SESSION['error'] = $error;
    }
    
    header("Location: profile.php");
    exit();
} else {
    // If not POST method, redirect to profile
    header("Location: profile.php");
    exit();
}
?>