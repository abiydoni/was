<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = base64_decode($_POST['id']);
    $skor = intval($_POST['skor']);

    $update = mysqli_query($konek, "UPDATE tbl_nama SET skor = '$skor' WHERE kode = '$id'");

    if ($update) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
