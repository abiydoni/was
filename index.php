
<?php include'header.php' ?>
<?php
	$qry = mysqli_query($konek,"SELECT * FROM tbl_profil limit 1");
	while ($data=mysqli_fetch_assoc($qry)) {
?>

 <title><?php echo $data['nama'];?></title>
		<section id="slider" class="slider" style="background-image:url('img/background.jpg')">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="text">

							<h1>Selamat Datang</h1>
							<p>di <?php echo $data['nama'];?></p>
							<div class="button">
								<a href="jadwal.php" class="btn primary "><i class="fa fa-briefcase"></i>Jadwal Terkini</a>
								<a href="contact.php" class="btn"><i class="fa fa-phone"></i>Hubungi Kami</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="about" class="about-section" style="padding: 50px 0; background-color: #f9f9f9;">
			<div class="container">
				<div class="row">
					<!-- Judul -->
					<div class="col-md-2 col-sm-3 col-xs-12">
						<div class="section-title">
							<h2 class="text-primary">Tentang <span class="text-danger">Saya</span></h2>
						</div>
					</div>
					
					<!-- Visi Misi -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="single-about">
							<p class="lead">
								<?php echo isset($data['visi_misi']) ? htmlspecialchars($data['visi_misi']) : "Visi dan misi belum tersedia."; ?>
							</p>
						</div>
					</div>

					<!-- Gambar dan Video -->
					<div class="col-md-4 col-sm-3 col-xs-12 text-center">
						<div class="image">
							<?php if (!empty($data['logo'])): ?>
								<img src="img/<?php echo htmlspecialchars($data['logo']); ?>" alt="Logo" class="img-responsive img-thumbnail" style="max-width: 200px; height: auto;">
							<?php endif; ?>

							<?php if (!empty($data['youtube'])): ?>
								<div class="mt-3">
									<a href="<?php echo htmlspecialchars($data['youtube']); ?>" class="btn btn-danger btn-lg video-popup">
										<i class="fa fa-play"></i> Tonton Video
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="skill" class="skill section">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<div class="section-title">
							<h2>My <span>Score</span></h2>
						</div>
					</div>
					<div class="col-md-10 col-sm-12 col-xs-12">
						<div class="skill-head">
							<div class="row">

						<?php
            				$qry = mysqli_query($konek,"SELECT * FROM tbl_profil limit 1");
                			while ($data=mysqli_fetch_assoc($qry)) {
                		?>	
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="skill-content">
										<h3>REKOR SCORING</h3>
										<p>
											<?php echo $data['sejarah']; ?>
										</p>
									</div>
								</div>
						<?php } ?>

								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="skill-main">

								<?php
		            				$qry = mysqli_query($konek,"SELECT * FROM tbl_skor limit 20");
		                			while ($data=mysqli_fetch_assoc($qry)) {
		                		?>
										<div class="single-skill">
											<div class="skill-title">
												<h4><?php echo $data['uraian']; ?></h4>
											</div>
											<div class="progress two">
												<div class="progress-bar" data-percent="<?php echo $data['skor']; ?>">
													<span><?php echo $data['skor']; ?>%</span>
												</div>
											</div>
										</div>
								<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>
	<?php include'footer.php' ?>