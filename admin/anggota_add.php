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
            <li class="breadcrumb-item active">Master <li class="breadcrumb-item active"> Anggota</li> </li>
          </ul>

       <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Nama *</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtnama" class="form-control is-valid" placeholder="Nama">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label"> Alamat *</label>
                      <div class="col-sm-10">
                        <input type="text" name="txtalamat" class="form-control is-valid" placeholder="Alamat">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">No HP *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txthp" class="form-control is-valid" placeholder="Nomor HP - 852..." min="0">
                      </div>
                </div>
                
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Tanggal Lahir *</label>
                      <div class="col-sm-10">
                        <input type="date" name="txtlahir" class="form-control is-valid">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Tanggal Bergabung *</label>
                      <div class="col-sm-10">
                        <input type="date" name="txtgabung" class="form-control is-valid">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Foto *</label>
                      <div class="col-sm-10">
                      <input type="file" name="txtfoto" class="form-control is-valid" accept="image/*" required>
                      </div>
                  </div>

                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Medali Emas *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtemas" class="form-control is-valid" placeholder="Jumlah Medali Emas" min="0" value="0">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Medali Perak *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtperak" class="form-control is-valid" placeholder="Jumlah Medali Perak" min="0" value="0">
                      </div>
                </div>
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Alamat *</label>
                      <div class="col-sm-10">
                        <input type="number" name="txtperunggu" class="form-control is-valid" placeholder="Jumlah Medali Perunggu" min="0" value="0">
                      </div>
                </div>
                  <div class="form-group row">
                      <label for="txtstatus" class="col-sm-2 form-control-label">Status</label>
                      <div class="col-sm-10">
                          <select name="txtstatus" id="txtstatus" class="form-control">
                              <option value="AKTIF" selected>Aktif</option>
                              <option value="TIDAK AKTIF">Tidak Aktif</option>
                          </select>
                      </div>
                  </div>

                <p align="right"> <input type="submit" name="btnsimpan" class="btn btn-primary" value="Simpan"> </p>
                </div>
              </div>
          </div>
      </section> 
      </form>            

        <?php

                              if (isset($_POST["btnsimpan"])){
                                  $txtnama=$_POST['txtnama'];
                                  $txtalamat=$_POST['txtalamat'];
                                  $txthp=$_POST['txthp'];
                                  $txtlahir=$_POST['txtlahir'];
                                  $txtgabung=$_POST['txtgabung'];
                                  $txtstatus=$_POST['txtstatus'];
                                  $txtemas=$_POST['txtemas'];
                                  $txtperak=$_POST['txtperak'];
                                  $txtperunggu=$_POST['txtperunggu'];
                                  $nama_file   = strtolower($_FILES['txtfoto']['name']);
                                  $lokasi_file = $_FILES['txtfoto']['tmp_name'];

                                $simpan = mysqli_query($konek,"INSERT INTO tbl_anggota (nama,alamat,hp,tgl_lahir,tgl_gabung,foto,status,emas,perak,perunggu) VALUES 
                                ('$txtnama','$txtalamat','$txthp','$txtlahir','$txtgabung','$nama_file','$txtstatus','$txtemas','$txtperak','$txtperunggu')");
                                if(!empty($lokasi_file)){
                          move_uploaded_file($lokasi_file, "../img/agt/$nama_file");
                          echo "Data Berhasil di simpan";
                            ?>
                            <script type="text/javascript">
                            alert('Data Anda Berhasil di Simpan');
                            document.location.href="anggota_add.php";
                            </script>
                          <?php
                          }
                        }
                      ?>
<div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Galeri</h3>
            </div>
            <div class="box-body no-padding">
          <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Anggota</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Tanggahl Lahir</th>
                  <th>Tanggal Bergabung</th>
                  <th>Foto</th>
                  <th>1</th>
                  <th>2</th>
                  <th>3</th>
                  <th>Status</th>
                  <th width="5%" colspan="2">Action</th>
                </tr>
                <?php
                    $no =1;
                      $qry = mysqli_query($konek,"SELECT * FROM tbl_anggota");
                        while ($data=mysqli_fetch_array($qry)) {
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><a href="anggota_tampil.php?id=<?php echo base64_encode($data['kode']); ?>"><?php echo $data['nama']; ?></a></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['hp']; ?></td>
                  <td><?php echo $data['tgl_lahir']; ?></td>
                  <td><?php echo $data['tgl_gabung']; ?></td>
                  <td><?php echo $data['foto']; ?></td>
                  <td><?php echo $data['emas']; ?></td>
                  <td><?php echo $data['perak']; ?></td>
                  <td><?php echo $data['perunggu']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  <td><a href="anggota_edit.php?id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-edit"></td>
                 <td> <a href="anggota_hapus.php?id=<?php echo $data['kode']; ?>" class="fa fa-times" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></td>
                </tr>
                <?php } ?>

              </table>
</div>
            </div>
          </div>
          </div>



 


<?php include'footer.php'; ?>