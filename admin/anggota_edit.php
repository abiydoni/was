<?php 
include 'header.php'; 

$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_anggota WHERE kode='$id'");
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
  <li class="breadcrumb-item active">Edit Anggota</li>
</ul>

<section class="statistics">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-lg-12">
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Nama *</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtnama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control is-valid" placeholder="Nama">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label"> Alamat *</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtalamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" class="form-control is-valid" placeholder="Alamat">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">No HP *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txthp" value="<?php echo htmlspecialchars($data['hp']); ?>" class="form-control is-valid" placeholder="Nomor HP - 852..." min="0">
                      </div>
                </div>
                
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Tanggal Lahir *</label>
                      <div class="col-sm-10">
                        <input type="date" name="txtlahir" value="<?php echo htmlspecialchars($data['tgl_lahir']); ?>" class="form-control is-valid">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Tanggal Bergabung *</label>
                      <div class="col-sm-10">
                        <input type="date" name="txtgabung" value="<?php echo htmlspecialchars($data['tgl_gabung']); ?>" class="form-control is-valid">
                      </div>
                </div>
                <div class="form-group row has-success">
                  <label class="col-sm-2 form-control-label">Foto *</label>
                  <div class="col-sm-10">
                    <?php if (!empty($data['foto'])): ?>
                      <img id="current-photo" src="../img/agt/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Sebelumnya" class="img-fluid img-thumbnail rounded mb-3" style="max-width: 300px; max-height: 200px;">
                    <?php else: ?>
                      <p class="text-muted mb-3">Tidak ada Foto sebelumnya.</p>
                    <?php endif; ?>
                    
                    <!-- Input untuk memilih foto baru -->
                    <input type="file" name="txtfoto" class="form-control" id="fotoInput" accept="image/*">
                  </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Medali Emas *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtemas" value="<?php echo htmlspecialchars($data['emas']); ?>" class="form-control is-valid" placeholder="Jumlah Medali Emas" min="0" value="0">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Medali Perak *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtperak" value="<?php echo htmlspecialchars($data['perak']); ?>" class="form-control is-valid" placeholder="Jumlah Medali Perak" min="0" value="0">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Alamat *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtperunggu" value="<?php echo htmlspecialchars($data['perunggu']); ?>" class="form-control is-valid" placeholder="Jumlah Medali Perunggu" min="0" value="0">
                      </div>
                </div>
                  <div class="form-group row">
                      <label for="txtstatus" class="col-sm-2 form-control-label">Status</label>
                      <div class="col-sm-10">
                          <select name="txtstatus" value="<?php echo htmlspecialchars($data['status']); ?>" id="txtstatus" class="form-control">
                              <option value="AKTIF" selected>Aktif</option>
                              <option value="TIDAK AKTIF">Tidak Aktif</option>
                          </select>
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
      $txthp=$_POST['txthp'];
      $txtlahir=$_POST['txtlahir'];
      $txtgabung=$_POST['txtgabung'];
      $txtstatus=$_POST['txtstatus'];
      $txtemas=$_POST['txtemas'];
      $txtperak=$_POST['txtperak'];
      $txtperunggu=$_POST['txtperunggu'];
    $nama_file = $_FILES['txtfoto']['name'];
    $lokasi_file = $_FILES['txtfoto']['tmp_name'];

    if (!empty($nama_file)) {
        // Jika gambar diunggah
        $tipe_file = $_FILES['txtfoto']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($tipe_file, $allowed_types)) {
            echo "<script>alert('File yang diunggah harus berupa gambar (JPG, PNG, GIF).');</script>";
            exit;
        }

        $edit = mysqli_query($konek, "UPDATE tbl_anggota SET 
        nama='$txtnama', 
        alamat='$txtalamat', 
        hp='$txthp',
        tgl_lahir='$txtlahir',
        tgl_gabung='$txtgabung',
        status='$txtstatus',
        emas='$txtemas',
        perak='$txtperak',
        perunggu='$txtperunggu',
        foto='$nama_file' 
        WHERE kode='$id'");

        if ($edit) {
            // Hapus gambar lama jika ada
            if (!empty($data['foto']) && file_exists("../img/agt/" . $data['foto'])) {
                unlink("../img/agt/" . $data['foto']);
            }

            // Pindahkan file baru ke folder
            move_uploaded_file($lokasi_file, "../img/agt/$nama_file");
            echo "<script>
              alert('Data berhasil diperbarui!');
              document.location.href='anggota_add.php';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    } else {
        // Jika gambar tidak diunggah
        $edit = mysqli_query($konek, "UPDATE tbl_anggota SET 
        nama='$txtnama', 
        alamat='$txtalamat', 
        hp='$txthp',
        tgl_lahir='$txtlahir',
        tgl_gabung='$txtgabung',
        status='$txtstatus',
        emas='$txtemas',
        perak='$txtperak',
        perunggu='$txtperunggu'
        WHERE kode='$id'");

        if ($edit) {
            echo "<script>
              alert('Data berhasil diperbarui tanpa mengubah gambar!');
              document.location.href='anggota_add.php';
            </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}
?>

<?php include 'footer.php'; ?>
<script>
  // Ambil elemen input file dan elemen gambar
  const fotoInput = document.getElementById('fotoInput');
  const currentPhoto = document.getElementById('current-photo');

  // Event listener untuk mengganti gambar saat file dipilih
  fotoInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    
    // Jika ada file yang dipilih
    if (file) {
      const reader = new FileReader();
      
      // Ketika file dibaca, update gambar
      reader.onload = function(e) {
        currentPhoto.src = e.target.result; // Ganti gambar dengan gambar baru
      };
      
      // Membaca file sebagai data URL (gambar)
      reader.readAsDataURL(file);
    }
  });
</script>

