<?php 
include'header.php'; ?>
      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              <form method="POST" enctype="multipart/form-data">
        </div>
      </section>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="master.php">Home</a></li>
            <li class="breadcrumb-item active">Master <li class="breadcrumb-item active"> Posting Artikel</li> </li>
          </ul>

       <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">              
                  <div class="form-group row">
                      <label for="txtkategori" class="col-sm-2 form-control-label">KATEGORI</label>
                      <div class="col-sm-10">
                          <select name="txtkategori" id="txtkategori" class="form-control" required>
                              <option value="berita" selected>Berita</option>
                              <option value="artikel">Artikel</option>
                              <option value="informasi">Informasi</option>
                              <option value="umum">Umum</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">JUDUL</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtjudul" class="form-control is-valid" placeholder="JUDUL NEWS / ARTIKEL">
                      </div>
                </div>
                  <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">KONTEN</label>
                      <div class="col-sm-10">
                        <textarea class="ckeditor" id="ckedtor" name="txtkonten"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="txttanggal" class="col-sm-2 form-control-label">TANGGAL POSTING</label>
                      <div class="col-sm-10">
                          <input type="text" name="txttanggal" id="txttanggal" class="form-control" placeholder="DD/MM/YYYY" readonly>
                      </div>
                  </div>
                  <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">USER</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtuser" value="<?php echo $_SESSION['nama']; ?>" class="form-control is-valid" placeholder="Nama Posting " readonly>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="txtstatus" class="col-sm-2 form-control-label">STATUS</label>
                      <div class="col-sm-10">
                          <select name="txtstatus" id="txtstatus" class="form-control">
                              <option value="aktif" selected>Aktif</option>
                              <option value="tidak_aktif">Tidak Aktif</option>
                          </select>
                      </div>
                  </div>
                    <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">GAMBAR</label>
                      <div class="col-sm-10">
                        <input type="file" name="txtgambar" class="form-control is-valid" placeholder="Status Berita">
                      </div>
                  </div>

                <input type="submit" name="btnsimpan" class="btn btn-primary" value="POSTING BLOG">
              </div>
            </div>
          </div>
      </section> 
      </form>
                        <?php
                                if (isset($_POST["btnsimpan"])){
                                  $txtkategori = $_POST['txtkategori'];
                                  // $txtkategori =$_POST['txtkategori'];
                                  $txtjudul=$_POST['txtjudul'];
                                  $txtkonten=$_POST['txtkonten'];
                                  $txttanggal=$_POST['txttanggal'];
                                  $txtuser=$_POST['txtuser'];
                                  $txtstatus=$_POST['txtstatus'];
                                  $nama_file   = $_FILES['txtgambar']['name'];
                                  $lokasi_file = $_FILES['txtgambar']['tmp_name'];
                                $simpan = mysqli_query($konek,"INSERT INTO tbl_blog (kategori,judul,konten,tgl_posting,user,status,gambar) VALUES ('$txtkategori','$txtjudul','$txtkonten','$txttanggal','$txtuser','$txtstatus','$nama_file')");
                                if(!empty($lokasi_file)){
                          move_uploaded_file($lokasi_file, "../img/blog/$nama_file");
                          echo "Data Berhasil di simpan";
                            ?>
                            <script type="text/javascript">
                            alert('Data Anda Berhasil di Simpan');
                            document.location.href="blog_tampil.php";
                            </script>
                          <?php
                          }
                        }
                      ?>
<?php include'footer.php'; ?>
<script>
    // Menetapkan tanggal sekarang secara otomatis dengan format DD/MM/YYYY
    window.onload = function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0'); // Mendapatkan tanggal 2 digit
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Mendapatkan bulan 2 digit (bulan dimulai dari 0)
        var yyyy = today.getFullYear(); // Mendapatkan tahun 4 digit
        today = yyyy + '/' + mm + '/' + dd; // Format DD/MM/YYYY
        document.getElementById('txttanggal').value = today; // Menetapkan nilai input tanggal
    };
</script>