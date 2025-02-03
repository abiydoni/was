		
		<!--/ End Clients -->
		
		<!-- Footer -->
		<footer id="footer" class="footer section">
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>© 2025 Copyright<a href="https://api.whatsapp.com/send?phone=6285225106200"> | appsBee</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--/ End Footer -->
		
        <script src="js/jquery.min.js">  </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nav.js"></script>
        <script src="js/jquery.slicknav.min.js"></script>
        <script src="js/easing.min.js"></script>
		<script src="js/jquery-appear.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
		<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> -->
		<script src="js/jquery.counterup.min.js"></script>
		<script src="js/isotope.pkgd.min.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyC0RqLa90WDfoJedoE3Z_Gy7a7o8PCL2jw"></script> -->
        <script type="text/javascript" src="js/gmaps.min.js"></script>
        <script src="js/main.js"></script>
		<script src="js/jquery-3.6.0.min.js"></script>

		<script>
			// Tunggu sampai dokumen selesai dimuat
			$(document).ready(function() {
				// Ketika tombol video diklik
				$('.video-btn').click(function() {
					var videoUrl = $(this).data('video-url');  // Ambil URL video dari data-video-url
					$('#videoIframe').attr('src', videoUrl);   // Atur URL video pada iframe modal
				});

				// Ketika modal ditutup, kosongkan iframe untuk menghentikan video
				$('#videoModal').on('hidden.bs.modal', function() {
					$('#videoIframe').attr('src', '');  // Kosongkan src untuk menghentikan video
				});
			});
		</script>

    </body>
</html>
