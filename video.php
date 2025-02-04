<?php include 'header.php'; ?>
<title>Video</title>

<section id="about" class="service section">
    <div class="container ">
        <div class="row text-center mb-4">
            <div class="col-12">
                <h1 class="fw-bold">VIDEO</h1>
            </div>
        </div>
        <div class="row"> <!-- Mengatur jarak antar kolom -->
            <?php
            include 'koneksi.php';  // Koneksi ke database
            $qry = mysqli_query($konek, "SELECT * FROM tbl_bulan LIMIT 200");  // Ambil data video dari database

            while ($data = mysqli_fetch_assoc($qry)) {
                // Pastikan URL video dalam format embed
                $video_url = $data['uraian'];
                if (strpos($video_url, "watch?v=") !== false) {
                    $video_url = str_replace("watch?v=", "embed/", $video_url);  // Ubah URL YouTube ke embed
                }
            ?>
                <div class="col-md-4 col-sm-6 col-xs-12"> <!-- Responsif untuk perangkat kecil -->
                    <div class="card shadow-sm border-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <!-- Menampilkan video embed langsung -->
                            <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
