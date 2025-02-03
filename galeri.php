<title>Galeri</title>
<?php include 'header.php'; ?>

<style>
.single-work {
  position: relative;
  overflow: hidden;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow utama */
  transition: all 0.3s ease-in-out;
}

.single-work:hover {
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Shadow saat hover */
  transform: translateY(-5px); /* Sedikit melayang saat hover */
}

.single-work img {
  width: 100%;
  height: 200px; /* Ukuran gambar seragam */
  object-fit: cover; /* Memastikan gambar tidak terdistorsi */
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

.works-hover {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6); /* Latar belakang gelap transparan */
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
}

.single-work:hover .works-hover {
  opacity: 1;
}

.works-hover h4 a {
  color: #fff;
  font-size: 1.2rem;
  text-decoration: none;
  text-align: center;
}

.works-hover h4 a:hover {
  text-decoration: underline;
}
</style>

<section id="latest-works" class="latest-works">
    <div class="container section">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h2>My <span>GALERI</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="isotop-active">
                <?php
                $qry = mysqli_query($konek, "SELECT * FROM tbl_folio");
                while ($data = mysqli_fetch_assoc($qry)) {
                    // Fallback jika gambar kosong
                    $gambar = !empty($data['gambar']) ? "img/folio/{$data['gambar']}" : "img/placeholder.png";
                ?>
                    <div class="col-md-2 col-sm-6 col-xs-12 mb-4 text-center">
                        <div class="single-work position-relative">
                            <!-- Gambar -->
                            <img src="<?php echo $gambar; ?>" alt="Gambar <?php echo htmlspecialchars($data['nama']); ?>">

                            <!-- Hover -->
                            <div class="works-hover">
                                <h4>
                                    <a href="<?php echo $gambar; ?>" target="_blank">
                                        <?php echo htmlspecialchars($data['nama']); ?> <br>
                                    </a>
                                </h4>
                            </div>
                        </div>
						<small><?php echo htmlspecialchars($data['alamat']); ?></small>
					</div>
				<?php } ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
