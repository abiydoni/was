<?php
include 'header.php'; 

// Ambil ID anggota yang ingin ditampilkan (misal dari parameter URL)
$id = base64_decode($_GET["id"]);

// Query untuk mendapatkan data anggota berdasarkan kode
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_anggota WHERE kode='$id'");
$data = mysqli_fetch_array($sqlku);
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
    <li class="breadcrumb-item active">Master <li class="breadcrumb-item active"> Detail Anggota</li> </li>
  </ul>

<section class="biodata">
  <div class="container-fluid">
    <div class="row d-flex">
      <div class="col-lg-12">
        <h1 class="card-title"><?php echo htmlspecialchars($data['nama']); ?></h1>
        <div class="row mt-4">
          <!-- Kolom Foto Anggota -->

            <div class="col-lg-4">
              <div class="card d-flex rounded justify-content-center align-items-center shadow-lg" style="width: 100%; height: 350px;">
                <?php if (!empty($data['foto'])): ?>
                  <img src="../img/agt/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Anggota" class="img-fluid img-thumbnail rounded" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                  <p class="text-muted text-center">Tidak ada foto anggota.</p>
                <?php endif; ?>
              </div>
            </div>

          <!-- Kolom Data Anggota -->
          <div class="col-lg-8">
            <div class="card rounded shadow-lg" style="height: 350px; object-fit: cover;">
              <div class="card-body">
                <p><strong>Alamat: </strong><?php echo htmlspecialchars($data['alamat']); ?></p>
                <p><strong>Nomor HP: </strong><?php echo htmlspecialchars($data['hp']); ?></p>
                <p><strong>Tanggal Lahir: </strong><?php echo htmlspecialchars($data['tgl_lahir']); ?></p>
                <p><strong>Tanggal Bergabung: </strong><?php echo htmlspecialchars($data['tgl_gabung']); ?></p>
                <p><strong>Status: </strong><?php echo htmlspecialchars(ucfirst($data['status'])); ?></p>
                <p><strong>Medali Emas: </strong><?php echo htmlspecialchars($data['emas']); ?></p>
                <p><strong>Medali Perak: </strong><?php echo htmlspecialchars($data['perak']); ?></p>
                <p><strong>Medali Perunggu: </strong><?php echo htmlspecialchars($data['perunggu']); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="javascript:history.back()" class="btn btn-danger rounded">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
