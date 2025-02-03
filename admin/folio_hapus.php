<?php 
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Validasi ID sebagai angka

    // Ambil data gambar dari database berdasarkan ID
    $query_gambar = mysqli_query($konek, "SELECT gambar FROM tbl_folio WHERE kode = '$id'");
    $data = mysqli_fetch_assoc($query_gambar);

    if ($data) {
        // Siapkan query untuk menghapus data menggunakan prepared statement
        $stmt = mysqli_prepare($konek, "DELETE FROM tbl_folio WHERE kode = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            // Hapus gambar dari folder jika ada
            if (!empty($data['gambar'])) {
                $file_path = "../img/folio/" . $data['gambar'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            // Redirect dengan status sukses
            header('Location: folio_add.php?status=success');
            exit();
        } else {
            // Redirect dengan status error
            header('Location: folio_add.php?status=error');
            exit();
        }
    } else {
        // Redirect jika data tidak ditemukan
        header('Location: folio_add.php?status=not_found');
        exit();
    }
} else {
    // Redirect jika parameter ID tidak valid
    header('Location: folio_add.php?status=invalid');
    exit();
}
?>
