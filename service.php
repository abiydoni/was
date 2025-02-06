
<?php include'header.php'; ?>
<head>
<title>Service</title>
</head>
<section id="service" class="service section">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="section-title">
						<!-- <h1><span><a href="scoring/index.php?updated=<?php echo time(); ?>"><i class="fa fa-bullseye"></i> Scoring Apps</a></span></h1><br> -->
						<h1><span><a href="500.php"><i class="fa fa-bullseye"></i> Scoring Apps</a></span></h1><br>
						<h2>My <span>Service</span></h2>
						</div> 
					</div>
					<div class="col-md-8 col-sm-12 col-xs-12">
						<div class="row">
							<?php
	            				$qry = mysqli_query($konek,"SELECT * FROM tbl_jabatan limit 200");
	                			while ($data=mysqli_fetch_assoc($qry)) {
                			?>
							<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.4s">
								<div class="single-service">
									<i class="fa fa-bullseye"></i>									
									<h5><?php echo $data['uraian']; ?></h5>
								</div>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php include'footer.php'; ?>
