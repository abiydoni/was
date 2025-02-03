<?php
// Sertakan file koneksi

// Ambil diskusi dari database
$sql = "SELECT * FROM tbl_diskusi ORDER BY tanggal DESC";
$result = $konek->query($sql);

if ($result->num_rows > 0) {
    while ($diskusi = $result->fetch_assoc()) {
        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($diskusi['judul']) . "</h5>";
        echo "<p class='card-text'>" . nl2br(htmlspecialchars($diskusi['deskripsi'])) . "</p>";
        echo "<p class='card-text'><small class='text-muted'>Dibuat oleh " . htmlspecialchars($diskusi['nama_pembuat']) . " pada " . $diskusi['tanggal'] . "</small></p>";
        echo "</div>";

        // Ambil komentar terkait diskusi
        $id_diskusi = $diskusi['id'];
        $sql_komentar = "SELECT * FROM tbl_komentar WHERE id_diskusi = ? ORDER BY tanggal DESC";
        $stmt = $konek->prepare($sql_komentar);
        $stmt->bind_param("i", $id_diskusi);
        $stmt->execute();
        $komentar_result = $stmt->get_result();

        // Menampilkan komentar
        echo "<div class='card-footer'>";
        echo "<h6>Komentar:</h6>";
        if ($komentar_result->num_rows > 0) {
            while ($komentar = $komentar_result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p><strong>" . htmlspecialchars($komentar['nama_pemberi_komentar']) . ":</strong> " . nl2br(htmlspecialchars($komentar['komentar'])) . "</p>";
                echo "<small><i>" . $komentar['tanggal'] . "</i></small>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Tidak ada komentar.</p>";
        }
        echo "</div>";

        // Formulir komentar
        echo "<div class='card-footer'>";
        echo "<form method='POST' action='proses_komentar.php'>";
        echo "<input type='hidden' name='id_diskusi' value='" . $diskusi['id'] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='nama_pemberi_komentar'>Nama Anda:</label>";
        echo "<input type='text' class='form-control' id='nama_pemberi_komentar' name='nama_pemberi_komentar' required>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='komentar'>Komentar:</label>";
        echo "<textarea class='form-control' id='komentar' name='komentar' rows='3' required></textarea>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-primary'>Kirim Komentar</button>";
        echo "</form>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "<p>Tidak ada diskusi saat ini.</p>";
}

$konek->close();
?>
