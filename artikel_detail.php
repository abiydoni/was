<?php 
include 'header.php'; 
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_blog WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>
<head>
    <title><?php echo htmlspecialchars($data['judul']); ?></title>
    <style>
        .article-header {
            position: relative;
            width: 100%;
            height: 300px;
            background: url('img/blog/<?php echo htmlspecialchars($data['gambar']); ?>') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .article-header::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Overlay gelap agar teks lebih jelas */
        }
        .article-title {
            position: relative;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            padding: 10px 20px;
        }
        .article-meta {
            position: relative;
            font-size: 14px;
            color: #ddd;
        }
    </style>
</head>

<section id="blog" class="blog section">
    <div class="article-header">
        <div>
            <h1 class="article-title"><?php echo htmlspecialchars($data['judul']); ?></h1>
            <p class="article-meta">
                <i class="fa fa-tag"></i> <?php echo htmlspecialchars($data['kategori']); ?> |
                <i class="fa fa-calendar"></i> <?php echo htmlspecialchars($data['tgl_posting']); ?> |
                <i class="fa fa-user"></i> <?php echo htmlspecialchars($data['user']); ?>
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="single-news">
                    <div class="news-body" style="margin-top: 20px; text-align: justify;">
                        <p><?php echo nl2br($data['konten']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
