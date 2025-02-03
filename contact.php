<?php include 'header.php'; ?>
<title>Contact</title>

<section id="contact" class="contact section">
    <div class="container">
        <div class="row">
            <!-- Bagian Informasi Kontak -->
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="contact-info">
                    <h4>Tentang Saya</h4>

                    <?php
                    $qry = mysqli_query($konek, "SELECT * FROM tbl_profil LIMIT 1");
                    $data = mysqli_fetch_assoc($qry);
                    if ($data): ?>
                        <p>
                            <?php echo $data['visi_misi']; ?>
                        </p>
                        <span><i class="fa fa-globe"></i> Contact Person: <?php echo htmlspecialchars($data['cp']); ?></span>
                        <span><i class="fa fa-phone-square"></i><a href="https://api.whatsapp.com/send?phone=62<?php echo htmlspecialchars($data['hp']); ?>"> +62<?php echo htmlspecialchars($data['hp']); ?></a></span>
                        <span><i class="fa fa-map-marker"></i> Alamat: <?php echo htmlspecialchars($data['alamat']); ?></span>
                        <span><i class="fa fa-instagram"></i><a href="<?php echo htmlspecialchars($data['ig']); ?>"> Instagram</a></span>
                    <?php else: ?>
                        <p class="text-danger">Data kontak tidak tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bagian Menampilkan Logo -->
            <div class="col-md-8 col-sm-12 col-xs-12 text-center">
                <?php if (!empty($data['logo']) && file_exists("img/" . $data['logo'])): ?>
                    <img src="img/<?php echo htmlspecialchars($data['logo']); ?>" alt="Logo" class="img-fluid" style="max-width: 300px; height: auto;">
                <?php else: ?>
                    <p class="text-warning">Logo tidak tersedia.</p>
                <?php endif; ?>
            </div>
        </div><br>

    </div>
</section>

<?php include 'footer.php'; ?>
