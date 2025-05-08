<?php include 'header.php'; ?>
<title>Video</title>

<section id="latest-works" class="latest-works">
    <div class="container section">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h2>My <span>VIDEO</span></h2>
                </div>
                <div id="video-container" class="grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <!-- Video akan ditampilkan di sini -->
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
              <div class="overflow-hidden rounded mb-2 transition-transform duration-300 hover:scale-105">
                <iframe 
                  class="w-full aspect-video" 
                  src="https://www.youtube.com/embed/${videoId}" 
                  frameborder="0" 
                  allowfullscreen>
                </iframe>
              </div>
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