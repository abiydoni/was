<?php
// Sertakan file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $nama_pembuat = htmlspecialchars($_POST['nama_pembuat']);

    // Query untuk menyimpan diskusi
    $sql = "INSERT INTO tbl_diskusi (judul, deskripsi, nama_pembuat) VALUES (?, ?, ?)";

    // Persiapkan query dan bind parameter
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("sss", $judul, $deskripsi, $nama_pembuat);

    // Eksekusi query
    if ($stmt->execute()) {
        // Setelah berhasil, alihkan kembali ke halaman forum
        header('Location: contact.php'); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $konek->close();
}
?>
