<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']); // Dekode ID yang dikirim melalui URL

    // Pastikan ID yang diterima adalah angka untuk keamanan
    if (is_numeric($id)) {
        $query = "DELETE FROM tbl_nama WHERE kode = ?";
        $stmt = mysqli_prepare($konek, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
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

// Jika ID tidak valid atau gagal menghapus, redirect kembali dengan status error
header("Location: index.php");
exit();
?>
