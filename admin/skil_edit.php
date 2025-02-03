<?php 
include'header.php'; 
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM tbl_skor WHERE kode='$id'");
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
            <li class="breadcrumb-item active">Master <li class="breadcrumb-item active">Edit Rekor</li> </li>
          </ul>

       <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-12">
              
                <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Uraian</label>
                      <div class="col-sm-10">
                        <input type="text" name="txturaian" value="<?php echo $data['uraian'] ?>" class="form-control is-valid" placeholder="Input">
                      </div>
                </div>


                 <div class="form-group row has-success">
                      <label class="col-sm-2 form-control-label">Nilai Rekor (%)</label>
                      <div class="col-sm-10">
                      <input type="number" name="txtskor" value="<?php echo $data['skor'] ?>" class="form-control is-valid" placeholder="0-100" min="0" max="100" required oninvalid="this.setCustomValidity('Harap masukkan angka antara 0 dan 100')" oninput="setCustomValidity('')">
                      </div>
                </div>
             <p align="right">   <input type="submit" name="btnedit" class="btn btn-primary" value="Ubah Data"> </p>
                </div>
              </div>
          </div>
      </section> 
      </form>
            <?php
                 if (isset($_POST["btnedit"])){
                                  $txturaian=$_POST['txturaian'];
                                  $txtskor=$_POST['txtskor'];
                  $edit = mysqli_query($konek,"UPDATE  tbl_skor SET uraian='$txturaian',skor='$txtskor' WHERE kode='$id'");
                  if ($edit){
                    if(!empty($edit)){
                    ?>
                    <script type="text/javascript">
                      alert('Data Berhasil di Edit');
                      document.location.href="skil_add.php";
                    </script>
                    <?php
                  }else{
                    echo "Terjadi kesalahan Gagal";
                  }
                }
              }
              ?>
    <?php include'footer.php'; ?>