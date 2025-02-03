<?php
include '../koneksi.php';
session_start();

if (!isset($_SESSION['kode'])) {
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Konfirmasi Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="modal fade show" style="display: block;" id="loginModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Akses Ditolak</h5>
                    </div>
                    <div class="modal-body">
                        <p>Opps...! Waktu login Anda sudah habis</p>
                        <p>Mohon untuk login kembali.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="login.php" class="btn btn-primary">Login Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "login.php";
            }, 10000); // Redirect otomatis setelah 10 detik
        </script>
    </body>
    </html>';
    exit;
}
?>
