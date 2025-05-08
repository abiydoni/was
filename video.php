<?php include 'header.php'; ?>
<title>Video</title>

<section id="latest-works" class="latest-works">
    <div class="container section">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h2>My <span>VIDEO</span></h2>
                </div>
            </div>
        </div>
        <div class="row"> <!-- Mengatur jarak antar kolom -->
            <div class="col-md-4 col-sm-6 col-xs-12 mb-4"> <!-- Responsif untuk perangkat kecil -->
                <div class="card video-card shadow-lg rounded" style="border: none; overflow: hidden;">
                    <div id="video-container" class="embed-responsive embed-responsive-16by9">
                        <!-- Menampilkan video embed langsung -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const API_KEY = 'AIzaSyBC_mSpXb1S1r_W5cl6sbMFv5NFxQftlNw';
    const CHANNEL_ID = 'UCx6AKQV9hHeAm8JU6p7XejQ';
    const MAX_RESULTS = 20;

    fetch(`https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&maxResults=${MAX_RESULTS}`)
      .then(response => response.json())
      .then(data => {
        const videos = data.items;
        const container = document.getElementById('video-container');

        videos.forEach(item => {
          if (item.id.kind === 'youtube#video') {
            const videoId = item.id.videoId;
            const title = item.snippet.title;

            const card = document.createElement('div');
            card.className = 'bg-white rounded-lg shadow p-4';

            card.innerHTML = `
              <iframe 
                class="w-full aspect-video mb-2 rounded" 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" 
                allowfullscreen>
              </iframe>
              <p class="text-sm font-medium text-gray-700 truncate" title="${title}">
                ${title}
              </p>
            `;

            container.appendChild(card);
          }
        });
      });
  </script>

<?php include 'footer.php'; ?>

<!-- CSS untuk penyesuaian jarak antar card dan styling tambahan -->
<style>
    .card {
        border-radius: 15px; /* Menambahkan kelengkungan pada card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Menambahkan efek shadow pada card */
        margin-bottom: 30px; /* Menambahkan jarak antar card */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Efek transisi saat hover */
    }

    .card:hover {
        transform: translateY(-10px); /* Efek angkat card saat hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Shadow lebih besar saat hover */
    }

    .card-body {
        padding: 15px; /* Mengatur padding pada card-body */
    }
</style>
