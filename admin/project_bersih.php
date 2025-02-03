<?php
// Hubungkan ke database
include '../koneksi.php'; // Pastikan file koneksi sudah benar

// Periksa parameter `id`
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $bulan = $_GET['id']; // Ambil parameter `id`

    // Query untuk update data
    $sql = "UPDATE tbl_jadwal SET nama='-', keterangan='-', status=0 WHERE bulan=?";
    $stmt = $konek->prepare($sql); // Gunakan prepared statement untuk keamanan

    if ($stmt) {
        // Bind parameter ke statement
        $stmt->bind_param("s", $bulan);

        // Eksekusi query dan cek apakah berhasil
        if ($stmt->execute()) {
            header("Location: project_tampil.php"); // Redirect setelah update berhasil
            exit;
        } else {
            echo "Gagal memperbarui data: " . $stmt->error;
        }
    } else {
        echo "Gagal mempersiapkan query: " . $konek->error;
    }
} else {
    echo "ID tidak valid atau tidak ditemukan!";
}
?>
