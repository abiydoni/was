<?php 
include 'header.php'; 

$id = base64_decode($_GET['id']);
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_jadwal WHERE bulan='$id'");
$data = mysqli_fetch_array($sqlku);
?>
<section class="statistics">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col-lg-12">
                <form method="POST" enctype="multipart/form-data">
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="master.php">Home</a></li>
        <li class="breadcrumb-item active">Master</li>
        <li class="breadcrumb-item active">Edit Jadwal</li>
    </ul>

    <section class="statistics">
        <div class="container-fluid">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <!-- Form Input Hari/Bulan -->
                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Hari/Bulan</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtbulan" value="<?php echo htmlspecialchars($data['bulan']); ?>" class="form-control is-valid" placeholder="Hari/Bulan" readonly>
                        </div>
                    </div>
                    
                    <!-- Form Input Nama Kegiatan -->
                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nama Kegiatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtnama" value="<?php echo htmlspecialchars($data['nama']); ?>" class="form-control is-valid" placeholder="Nama Kegiatan">
                        </div>
                    </div>
                    
                    <!-- Form Input Keterangan -->
                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Detail</label>
                        <div class="col-sm-10">
                            <textarea class="ckeditor" id="keterangan" placeholder="Keterangan" name="txtketerangan" required><?php echo htmlspecialchars($data['keterangan']); ?></textarea>
                        </div>
                    </div>
                    
                    <input type="submit" name="btnedit" class="btn btn-primary" value="Update Keterangan">
                </div>
            </div>
        </div>
    </section> 
</form>

<?php
if (isset($_POST["btnedit"])) {
    // Sanitasi input untuk mencegah SQL Injection
    $txtbulan = mysqli_real_escape_string($konek, $_POST['txtbulan']);
    $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
    $txtketerangan = mysqli_real_escape_string($konek, $_POST['txtketerangan']);
    $status = 1;

    // Query UPDATE untuk mengupdate data
    $edit = mysqli_query($konek, "UPDATE tbl_jadwal SET bulan='$txtbulan', nama='$txtnama', keterangan='$txtketerangan', status='$status' WHERE bulan='$id'");
    
    if ($edit) {
        echo "<script type='text/javascript'>
                document.location.href='project_tampil.php';
              </script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui data.";
    }
}
?>

<?php include 'footer.php'; ?>
