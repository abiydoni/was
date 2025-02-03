<?php
// Sertakan file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_diskusi = $_POST['id_diskusi'];
    $nama_pemberi_komentar = htmlspecialchars($_POST['nama_pemberi_komentar']);
    $komentar = htmlspecialchars($_POST['komentar']);

    // Query untuk menyimpan komentar ke database
    $sql = "INSERT INTO tbl_komentar (id_diskusi, nama_pemberi_komentar, komentar) VALUES (?, ?, ?)";

    // Persiapkan query dan bind parameter
    $stmt = $konek->prepare($sql);
    $stmt->bind_param("iss", $id_diskusi, $nama_pemberi_komentar, $komentar);

    // Eksekusi query
    if ($stmt->execute()) {
        // Setelah berhasil, alihkan kembali ke halaman diskusi
        header('Location: index.php'); // Ganti dengan nama halaman yang sesuai
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $konek->close();
}
?>
