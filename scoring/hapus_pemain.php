<?php
include '../koneksi.php';

if (isset($_GET['nom'])) {
    $nom = base64_decode($_GET['nom']); // Dekode nom yang dikirim melalui URL

    // Pastikan nom yang diterima adalah angka untuk keamanan
    if (is_numeric($nom)) {
        $query = "DELETE FROM tbl_nama WHERE kode = ?";
        $stmt = mysqli_prepare($konek, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $nom);
            $execute = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($execute) {
                header("Location: index.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }
}

// Jika nom tidak valid atau gagal menghapus, redirect kembali dengan status error
header("Location: index.php");
exit();
?>
