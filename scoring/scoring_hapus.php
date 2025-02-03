<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    // Dekode ID yang dikirim melalui URL
    $id_data = base64_decode($_GET['id']);

    // Pisahkan data berdasarkan koma
    list($id, $kode) = explode(',', $id_data);

    // Pastikan ID yang diterima adalah angka untuk keamanan
    if (is_numeric($id)) {
        // Query untuk menghapus data berdasarkan ID
        $query = "DELETE FROM tbl_scoring WHERE nom = ?";
        $stmt = mysqli_prepare($konek, $query);

        if ($stmt) {
            // Binding parameter untuk query
            mysqli_stmt_bind_param($stmt, "i", $id);
            $execute = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Redirect ke halaman scoring setelah berhasil atau gagal
            if ($execute) {
                header("Location: scoring.php?id=" . base64_encode($kode)); // Kembalikan kode yang sudah di-encode
                exit();
            } else {
                // Jika gagal, redirect kembali
                header("Location: scoring.php?id=" . base64_encode($kode)); 
                exit();
            }
        } else {
            // Jika query gagal disiapkan
            header("Location: scoring.php?id=" . base64_encode($kode)); 
            exit();
        }
    }
}

// Jika ID tidak valid atau tidak ada ID yang diterima, redirect kembali
header("Location: index.php");
exit();
?>
