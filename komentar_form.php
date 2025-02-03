<!-- Formulir Komentar Pengunjung -->
<div class="comment-section my-5">
  <h3>Berikan Komentar Anda</h3>
  <form method="POST" action="komentar_proses.php">
    <div class="form-group">
      <label for="nama"><i class="fas fa-user"></i> Nama Anda:</label>
      <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama Anda">
    </div>
    <div class="form-group">
      <label for="komentar"><i class="fa fa-comment-dots"></i> Komentar Anda:</label>
      <textarea class="form-control" id="komentar" name="komentar" rows="4" required placeholder="Tulis komentar Anda di sini..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim Komentar</button>
  </form>
</div>

<hr>

<!-- Daftar Komentar Pengunjung -->
<div class="comments-list">
  <h4>Komentar Pengunjung</h4>
  <?php

    if ($konek->connect_error) {
        die("Connection failed: " . $konek->connect_error);
    }

    $sql = "SELECT nama, komentar, tanggal FROM komentar ORDER BY tanggal DESC";
    $result = $konek->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='comment-item'>";
            echo "<h5>" . htmlspecialchars($row['nama']) . "</h5>";
            echo "<p>" . nl2br(htmlspecialchars($row['komentar'])) . "</p>";
            echo "<small><i>" . $row['tanggal'] . "</i></small>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>Tidak ada komentar.</p>";
    }

    $konek->close();
  ?>
</div>
