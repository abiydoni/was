<?php include 'header.php'; ?>
<title>Video</title>

<section id="latest-works" class="latest-works">
    <div class="container section">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h2>My <span>VIDEO</span></h2>
                </div>
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
                <div class="col-md-4 col-sm-6 col-xs-12 mb-4"> <!-- Responsif untuk perangkat kecil -->
                    <div class="card video-card shadow-lg rounded" style="border: none; overflow: hidden;">
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

<!-- CSS untuk penyesuaian jarak antar card dan styling tambahan -->
<style>
    .card {
        border-radius: 15px; /* Menambahkan kelengkungan pada card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan efek shadow pada card */
        margin-bottom: 30px; /* Menambahkan jarak antar card */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Efek transisi saat hover */
    }

    .card:hover {
        transform: translateY(-10px); /* Efek angkat card saat hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Shadow lebih besar saat hover */
    }

    .card-body {
        padding: 15px; /* Mengatur padding pada card-body */
    }
</style>
