<?php 
include'header.php'; ?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>

      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              <form method="POST" enctype="multipart/form-data">
        </div>
      </section>
          <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="master.php">Home</a></li>
          <li class="breadcrumb-item active">Data Master <li class="breadcrumb-item active">Rekor</li> </li>
          </ul>

       <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Uraian </label>
                      <div class="col-sm-10">
                        <input type="text" name="txturaian" class="form-control is-valid" placeholder="Uraian" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')"> </input>
                      </div>
                </div>


                 <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Nilai Rekor (%)</label>
                      <div class="col-sm-10">
                      <input type="number" name="txtskor" class="form-control is-valid" placeholder="0-100" min="0" max="100" required oninvalid="this.setCustomValidity('Harap masukkan angka antara 0 dan 100')" oninput="setCustomValidity('')">
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
                                $txturaian=$_POST['txturaian'];
                                $txtskor=$_POST['txtskor'];
                                $simpan = mysqli_query($konek,"INSERT INTO tbl_skor (uraian,skor) VALUES ('$txturaian','$txtskor')");
                                   if(!empty($simpan)){
                            ?>
                            <script type="text/javascript">
                            alert('Data Anda Berhasil di Simpan');
                            document.location.href="skil_add.php";
                            </script>
                          <?php
                          }
                        }
                      ?>

    <br>
    <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h4 class="box-title">Data Rekor</h4>
            </div>
            <div class="box-body no-padding">
          <div class="table-responsive">
              <table class="table table-striped">
                <tr>
                  <th width="5%">No</th>
                  <th>Uraian</th>
                  <th>Progress Skill</th>
                  <th width="5%" colspan="2">Action</th>
                </tr>
                <?php
                    $no =1;
                      $qry = mysqli_query($konek,"SELECT * FROM tbl_skor");
                        while ($data=mysqli_fetch_array($qry)) {
                  ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['uraian']; ?></td>
                  <td><?php echo $data['skor']; ?></td>
                  <td><a href="skil_edit.php?id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-edit"></td>
                 <td> <a href="skil_hapus.php?id=<?php echo $data['kode']; ?>" class="fa fa-times" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"></td>
                </tr>
                <?php } ?>

              </table>
</div>
            </div>
          </div>
          </div>

<?php include'footer.php'; ?>