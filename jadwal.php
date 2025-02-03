
<?php include'header.php'; ?>

 <title>Jadwal</title>

		<section id="story" class="story section">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h2>JADWAL<span> EVENT</span></h2>
						</div>
					</div>
				</div>
				<?php
					$qry = mysqli_query($konek,"SELECT * FROM tbl_jadwal WHERE kode='EVE' AND status=1 limit 12");
					while ($data=mysqli_fetch_assoc($qry)) {
				?>
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
						<div class="story-content">
							<!-- single-story -->
							<div class="single-story">
								<span class="year wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.4s"><?php echo $data['bulan']; ?></span>
								<div class="inner-content wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
									<h3><?php echo $data['nama']; ?></h3>
									<p><?php echo $data['keterangan']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</section>

		<section id="story" class="story section">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="section-title">
							<h2>JADWAL<span> LATIHAN</span></h2>
						</div>
					</div>
				</div>
				<?php
					$qry = mysqli_query($konek,"SELECT * FROM tbl_jadwal WHERE kode='LAT' AND status=1 limit 7");
					while ($data=mysqli_fetch_assoc($qry)) {
				?>
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
						<div class="story-content">
							<!-- single-story -->
							<div class="single-story">
								<span class="year wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.4s"><?php echo $data['bulan']; ?></span>
								<div class="inner-content wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
									<h3><?php echo $data['nama']; ?></h3>
									<p><?php echo $data['keterangan']; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</section>
		
<?php include'footer.php'; ?>
