<?php 
include 'header.php'; 

$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_folio WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>

<section class="statistics">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-lg-12">
        <form method="POST" enctype="multipart/form-data">
      </div>
    </div>
  </div>
</section>

<ul class="breadcrumb">
  <li class="breadcrumb-item"><a href="master.php">Home</a></li>
  <li class="breadcrumb-item active">Master</li>
  <li class="breadcrumb-item active">Edit Galeri</li>
</ul>

<section class="statistics">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-lg-12">

        <div class="form-group row has-success">
          <label class="col-sm-2 form-control-label">Nama *</label>
          <div class="col-sm-10">
            <input type="text" name="txtnama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control is-valid" placeholder="Input Data" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
          </div>
        </div>

        <div class="form-group row has-success">
          <label class="col-sm-2 form-control-label">Deskripsi *</label>
          <div class="col-sm-10">
            <input type="text" name="txtalamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" class="form-control is-valid" placeholder="Input Data" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')">
          </div>
        </div>

        <div class="form-group row has-success">
          <label class="col-sm-2 form-control-label">Gambar *</label>
          <div class="col-sm-10">
            <?php if (!empty($data['gambar'])): ?>
              <img src="../img/folio/<?php echo htmlspecialchars($data['gambar']); ?>" alt="Gambar Sebelumnya" class="img-fluid img-thumbnail rounded mb-3" style="max-width: 300px; max-height: 200px;">
            <?php else: ?>
              <p class="text-muted mb-3">Tidak ada gambar sebelumnya.</p>
            <?php endif; ?>
            <input type="file" name="txtgambar" class="form-control is-valid" accept="img/*">
          </div>
        </div>

        <p align="right">
          <input type="submit" name="btnedit" class="btn btn-primary" value="Edit">
        </p>
      </div>
    </div>
  </div>
</section>
</form>

<?php
if (isset($_POST["btnedit"])) {
    $txtnama   = htmlspecialchars($_POST['txtnama']);
    $txtalamat = htmlspecialchars($_POST['txtalamat']);
    $nama_file = $_FILES['txtgambar']['name'];
    $lokasi_file = $_FILES['txtgambar']['tmp_name'];

    if (!empty($nama_file)) {
        // Jika gambar diunggah
        $tipe_file = $_FILES['txtgambar']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($tipe_file, $allowed_types)) {
            echo "<script>alert('File yang diunggah harus berupa gambar (JPG, PNG, GIF).');</script>";
            exit;
        }

        $edit = mysqli_query($konek, "UPDATE tbl_folio SET nama='$txtnama', alamat='$txtalamat', gambar='$nama_file' WHERE kode='$id'");

        if ($edit) {
            // Hapus gambar lama jika ada
            if (!empty($data['gambar']) && file_exists("../img/folio/" . $data['gambar'])) {
                unlink("../img/folio/" . $data['gambar']);
            }

            // Pindahkan file baru ke folder
            move_uploaded_file($lokasi_file, "../img/folio/$nama_file");
            echo "<script>
              alert('Data berhasil diperbarui!');
              document.location.href='folio_add.php';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } else {
        // Jika gambar tidak diunggah
        $edit = mysqli_query($konek, "UPDATE tbl_folio SET nama='$txtnama', alamat='$txtalamat' WHERE kode='$id'");

        if ($edit) {
            echo "<script>
              alert('Data berhasil diperbarui tanpa mengubah gambar!');
              document.location.href='folio_add.php';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}
?>

<?php include 'footer.php'; ?>
