<?php
include '../koneksi.php';

if (isset($_GET['nom'])) {
    // Dekode nom yang dikirim melalui URL
    $nom_data = base64_decode($_GET['nom']);

    // Pisahkan data berdasarkan koma
    list($nom, $kode) = explode(',', $nom_data);

    // Pastikan nom yang diterima adalah angka untuk keamanan
    if (is_numeric($nom)) {
        // Query untuk menghapus data berdasarkan nom
        $query = "DELETE FROM tbl_scoring WHERE nom = ?";
        $stmt = mysqli_prepare($konek, $query);

        if ($stmt) {
            // Binding parameter untuk query
            mysqli_stmt_bind_param($stmt, "i", $nom);
            $execute = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Redirect ke halaman scoring setelah berhasil atau gagal
            if ($execute) {
                header("Location: scoring.php?nom=" . base64_encode($kode)); // Kembalikan kode yang sudah di-encode
                exit();
            } else {
                // Jika gagal, redirect kembali
                header("Location: scoring.php?nom=" . base64_encode($kode)); 
                exit();
            }
        } else {
            // Jika query gagal disiapkan
            header("Location: scoring.php?nom=" . base64_encode($kode)); 
            exit();
        }
    }
}

// Jika nom tidak valid atau tidak ada ID yang diterima, redirect kembali
header("Location: index.php");
exit();
?>
