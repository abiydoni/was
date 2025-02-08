<?php
include '../koneksi.php';

header('Content-Type: application/json');

$qry = mysqli_query($konek, "SELECT kode, nama, sesi, jarak, skor FROM tbl_nama WHERE DATE(tanggal) = CURDATE() ORDER BY nama ASC");
$pemain = [];
while ($row = mysqli_fetch_assoc($qry)) {
    $pemain[] = $row;
}

echo json_encode($pemain);
