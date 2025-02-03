<?php 
include'header.php'; 
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM tbl_profil WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>
      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              <form method="POST" enctype="multipart/form-data">
        </div>
      </section>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="master.php">Home</a></li>
            <li class="breadcrumb-item active">Master <li class="breadcrumb-item active">Profil</li> </li>
          </ul>

       <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">Nama Club</label>
                <div class="col-sm-10">
                  <input type="text" name="txtnama" value="<?php echo $data['nama'] ?>" class="form-control is-valid" placeholder="Nama Club">
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" name="txtalamat" value="<?php echo $data['alamat'] ?>" class="form-control is-valid" placeholder="Alamat">
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">Contact Person</label>
                <div class="col-sm-10">
                  <input type="text" name="txtcp" value="<?php echo $data['cp'] ?>" class="form-control is-valid" placeholder="Contact Person">
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">Nomor WhatsApp</label>
                <div class="col-sm-10">
                  <input type="text" name="txthp" value="<?php echo $data['hp'] ?>" class="form-control is-valid" placeholder="exc: +62852...">
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">Logo</label>
                <div class="col-sm-10">
                  <?php if (!empty($data['logo'])): ?>
                    <img src="../img/<?php echo htmlspecialchars($data['logo']); ?>" alt="Gambar Sebelumnya" class="img-fluid img-thumbnail rounded mb-3" style="max-width: 300px; max-height: 200px;">
                  <?php else: ?>
                    <p class="text-muted mb-3">Tidak ada gambar sebelumnya.</p>
                  <?php endif; ?>
                  <input type="file" name="txtgambar" class="form-control is-valid" accept="img/*">
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">URL Video Youtobe</label>
                <div class="col-sm-10">
                  <input type="text" name="txtyoutube" value="<?php echo $data['youtube'] ?>" class="form-control is-valid" placeholder="URL video youtube" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')"> </input>
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-2 form-control-label">URL Instagram</label>
                <div class="col-sm-10">
                  <input type="text" name="txtig" value="<?php echo $data['ig'] ?>" class="form-control is-valid" placeholder="URL video youtube" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')"> </input>
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-5 form-control-label">Tentang Saya (Halaman Utama)</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="visi" placeholder="Konten" name="txtvisi" required><?php echo $data['visi_misi'];?></textarea>
                </div>
              </div>
              <div class="form-group row has-success">
                <label class="col-sm-5 form-control-label">Detail Rekor Scoring (halaman utama)</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="alamat" placeholder="Konten" name="txtsejarah" required><?php echo $data['sejarah'];?></textarea>
                </div>
              </div>
              <input type="submit" name="btnedit" class="btn btn-primary" value="Update Profil">
            </div>
          </div>
        </div>
      </section> 
      </form>
            <?php
                 if (isset($_POST["btnedit"])){
                  $txtsejarah=$_POST['txtsejarah'];
                  $txtvisi=$_POST['txtvisi'];
                  $txtnama=$_POST['txtnama'];
                  $txtalamat=$_POST['txtalamat'];
                  $txtcp=$_POST['txtcp'];
                  $txthp=$_POST['txthp'];
                  $txtyoutube=$_POST['txtyoutube'];
                  $txtig=$_POST['txtig'];

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
                  
                      $edit = mysqli_query($konek,"UPDATE  tbl_profil SET 
                        sejarah='$txtsejarah',
                        visi_misi='$txtvisi',
                        nama='$txtnama',
                        alamat='$txtalamat',
                        cp='$txtcp',
                        hp='$txthp',
                        logo='$nama_file',
                        youtube='$txtyoutube',
                        ig='$txtig'
                        WHERE kode='$id'");

                    if ($edit) {
                      // Hapus gambar lama jika ada
                      if (!empty($data['gambar']) && file_exists("../img/" . $data['gambar'])) {
                          unlink("../img/" . $data['gambar']);
                      }

                      // Pindahkan file baru ke folder
                      move_uploaded_file($lokasi_file, "../img/$nama_file");
                      echo "<script>
                        alert('Data berhasil diperbarui!');
                        document.location.href='master.php';
                      </script>";
                    } else {
                      echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
                    }
                  } else {
                    // Jika gambar tidak diunggah
                    $edit = mysqli_query($konek,"UPDATE  tbl_profil SET 
                    sejarah='$txtsejarah',
                    visi_misi='$txtvisi',
                    nama='$txtnama',
                    alamat='$txtalamat',
                    cp='$txtcp',
                    hp='$txthp',
                    youtube='$txtyoutube',
                    ig='$txtig'
                    WHERE kode='$id'");

                    if ($edit) {
                      echo "<script>
                        alert('Data berhasil diperbarui tanpa mengubah gambar!');
                        document.location.href='master.php';
                      </script>";
                    } else {
                      echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
                    }
                    }
                    }
    ?>

    <?php include'footer.php'; ?>