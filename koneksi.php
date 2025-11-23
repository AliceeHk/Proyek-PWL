<?php
function prosesPeminjaman($akun_id, $buku_id, $lama_pinjaman, $nomor_telepon) {
    $mysqli = new mysqli("localhost", "root", "", "pagepal");
    
    // CEK STOK BUKU
    $stok_result = $mysqli->query("SELECT stok FROM buku WHERE id = '$buku_id'");
    $stok_data = $stok_result->fetch_assoc();
    
    if ($stok_data['stok'] < 1) {
        return ['success' => false, 'message' => 'Maaf, buku sedang tidak tersedia'];
    }
    
    // GENERATE KODE PEMINJAMAN
    $kode_peminjaman = 'PJN' . date('Ymd') . rand(1000, 9999);
    
    // TANGGAL PEMINJAMAN (hari ini)
    $tanggal_pinjam = date('Y-m-d');
    
    // TANGGAL HARUS KEMBALI (berdasarkan lama pinjaman)
    $tanggal_harus_kembali = date('Y-m-d', strtotime("+$lama_pinjaman days"));
    
    // INSERT DATA PEMINJAMAN
    $query = "INSERT INTO peminjaman (akun_id, buku_id, kode_peminjaman, tanggal_pinjam, tanggal_harus_kembali, nomor_telepon, status) 
              VALUES ('$akun_id', '$buku_id', '$kode_peminjaman', '$tanggal_pinjam', '$tanggal_harus_kembali', '$nomor_telepon', 'dipinjam')";
    
    if ($mysqli->query($query)) {
        // UPDATE STOK BUKU (kurangi 1)
        $mysqli->query("UPDATE buku SET stok = stok - 1 WHERE id = '$buku_id'");
        
        $mysqli->close();
        return ['success' => true, 'message' => 'Peminjaman berhasil! Kode: ' . $kode_peminjaman];
    } else {
        $mysqli->close();
        return ['success' => false, 'message' => 'Gagal memproses peminjaman: ' . $mysqli->error];
    }
}
?>