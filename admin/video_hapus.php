<?php 
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validasi ID sebagai angka

    // Siapkan query menggunakan prepared statement
    $stmt = mysqli_prepare($konek, "DELETE FROM tbl_bulan WHERE kode = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect dengan status sukses
        header('Location: video_add.php?status=success');
        exit();
    } else {
        // Redirect dengan status error
        header('Location: video_add.php?status=error');
        exit();
    }
} else {
    // Redirect jika parameter ID tidak valid
    header('Location: video_add.php?status=invalid');
    exit();
}
?>
