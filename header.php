<?php include'koneksi.php'; ?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">       
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/was_logo.png">
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300i,400,400i,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/slicknav.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
	
		<!-- Xman CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
		
		<!-- Social -->
		<div class="social-body">
			<?php
				$qry = mysqli_query($konek,"SELECT * FROM tbl_profil limit 1");
				while ($data=mysqli_fetch_assoc($qry)) {
			?>
			<ul>
				<li class="whatsapp"><a href="https://api.whatsapp.com/send?phone=62<?php echo $data['hp']; ?>"><i class="fa fa-whatsapp"></i></a></li>
				<li class="instagram"><a href="<?php echo $data['ig']; ?>"><i class="fa fa-instagram"></i></a></li>
			</ul>
			<?php } ?>
		</div>
		<!--/ End Social -->
		
		<!-- Header Area -->
		<header id="header" class="header">
			<div class="header-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-2 col-xs-12 ">
							<div class="text-center my-4">
								<a href="index.php">
									<img src="img/was_logo2.png" alt="Logo Website" class="img-fluid" style="max-height: 64px;">
								</a>
							</div>
						</div>
						<div class="col-md-9 col-sm-10 col-xs-12">
							<div class="mobile-menu"></div>
							<nav class="navbar navbar-default">
								<div class="collapse navbar-collapse">
									<ul id="nav" class="nav navbar-nav">
										<li><a href="index.php">Beranda</a></li>
										<li><a href="service.php">Layanan</a></li>
										<li><a href="video.php">Video</a></li>
										<li><a href="jadwal.php?updated=<?php echo time(); ?>">Jadwal Terbaru</a></li>
										<li><a href="galeri.php">Galeri</a></li>
										<li><a href="artikel.php">Artikel</a></li>
										 <li><a href="anggota.php?updated=<?php echo time(); ?>">Anggota</a></li> 
										<li><a href="contact.php">Contact</a></li>
										<li><a href="admin/index.php">Login</a></li>
									</ul>
								</div> 
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>