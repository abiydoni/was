<?php
// Konfigurasi koneksi database
$server = 'localhost';
$user = 'appsbeem_admin';
$password = 'A7by777__';
$database = 'appsbeem_was';

// Membuat koneksi menggunakan MySQLi
$konek = mysqli_connect($server, $user, $password, $database);

// Cek koneksi
if (!$konek) {
    // Log error ke file khusus (pastikan path log file aman)
    error_log("Koneksi database gagal: " . mysqli_connect_error(), 3, '/var/log/db_errors.log');
    // Tampilkan pesan umum untuk pengguna
    die("Koneksi ke database gagal. Silakan coba lagi nanti.");
}

// Mengatur charset untuk mencegah serangan encoding
mysqli_set_charset($konek, 'utf8');
?>