<?php include 'header.php'; ?>
<title>Video</title>

<section id="about" class="about py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-12">
                <h1 class="fw-bold">VIDEO</h1>
            </div>
        </div>
        <div class="row g-3"> <!-- Mengatur jarak antar kolom dengan g-3 -->
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
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="ratio ratio-16x9">
                            <!-- Tombol untuk membuka modal video -->
                            <button type="button" class="btn btn-link video-btn" data-toggle="modal" data-target="#videoModal" data-video-url="<?php echo $video_url; ?>">
                                <!-- Menampilkan thumbnail video -->
                                <img src="https://img.youtube.com/vi/<?php echo substr($video_url, strpos($video_url, "embed/") + 6); ?>/0.jpg" class="img-fluid rounded" alt="Video Thumbnail">
                                <div class="play-icon">
                                    <i class="fa fa-play"></i>
                                </div>
                            </button>
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

<!-- Modal untuk Video -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80vw; max-height: 80vh; margin: auto;">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Menyesuaikan ukuran iframe -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="videoIframe" src="" title="Video" allowfullscreen class="embed-responsive-item"></iframe>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

