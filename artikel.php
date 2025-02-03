<?php include 'header.php'; ?>
<title>Artikel</title>
<section id="blog" class="blog">
    <div class="container section">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="section-title text-center">
                    <h2>DAFTAR <span>ARTIKEL</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (!$konek) {
                die("Koneksi database gagal: " . mysqli_connect_error());
            }

            $stmt = mysqli_prepare($konek, "SELECT kode, judul, kategori, tgl_posting, gambar FROM tbl_blog");
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="single-news" style="min-height: 350px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden; background: #fff; margin-bottom: 20px;">
                        <div class="news-head">
                            <img src="img/blog/<?php echo htmlspecialchars($data['gambar']); ?>" 
                                 alt="<?php echo htmlspecialchars($data['judul']); ?>" 
                                 class="img-responsive" 
                                 style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="news-date text-center" style="background: #007bff; color: white; padding: 50px; font-size: 14px;">
                                <?php echo htmlspecialchars($data['tgl_posting']); ?>
                            </div>
                        </div>
                        <div class="news-body text-center" style="padding: 5px;">
                            <span class="text-muted"><i class="fa fa-tag"></i> <?php echo htmlspecialchars($data['kategori']); ?></span>
                            <h3 class="news-title" style="font-size: 12px; margin-top: 10px; height: 50px; overflow: hidden;">
                                <a href="artikel_detail.php?id=<?php echo base64_encode($data['kode']); ?>" class="text-primary">
                                    <?php echo htmlspecialchars($data['judul']); ?>
                                </a>
                            </h3>
                            <a href="artikel_detail.php?id=<?php echo base64_encode($data['kode']); ?>" class="btn btn-primary btn-sm" style="margin-top: 10px;">
                                Read More <i class="fa fa-angle-double-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php include 'footer.php'; ?>
