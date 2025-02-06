<?php
include '../koneksi.php';

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_agt = mysqli_real_escape_string($konek, $_POST['kode_agt']);
    $nama = mysqli_real_escape_string($konek, $_POST['nama']);
    $jarak = mysqli_real_escape_string($konek, $_POST['jarak']);
    $sesi = intval($_POST['sesi']); // Ambil jumlah sesi

    if ($sesi < 1) {
        header("Location: tambah_pemain.php?status=error_sesi");
        exit();
    }

    $success = true;
    for ($i = 1; $i <= $sesi; $i++) {
        $sql = "INSERT INTO tbl_nama (kode_agt, nama, jarak, sesi) VALUES ('$kode_agt', '$nama', '$jarak', '$i')";
        if (!mysqli_query($konek, $sql)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }
    exit();
}
?>
