<?php include 'header.php'; ?>

<title>Video</title>

<section id="latest-works" class="latest-works">
  <div class="container section">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-title">
          <h2>My <span>VIDEO</span></h2>
        </div>
        <div id="video-container" class="row" style="margin-top: 30px;">
          <!-- Video akan muncul di sini -->
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  const API_KEY = 'AIzaSyC50TKuv65HSJQiNMHIHezFCQHpnYl_xv4';
  const CHANNEL_ID = 'UCV8z4gSEZhptQsxL2ZAjQEw';
  const MAX_RESULTS_PER_PAGE = 50;
  const MAX_TOTAL = 150; // ganti sesuai kebutuhan

  let videos = [];
  let nextPageToken = '';

  async function fetchAllVideos() {
    while (videos.length < MAX_TOTAL) {
      const url = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&maxResults=${MAX_RESULTS_PER_PAGE}${nextPageToken ? `&pageToken=${nextPageToken}` : ''}`;
      
      const response = await fetch(url);
      const data = await response.json();
      
      if (!data.items) break;

      videos.push(...data.items.filter(item => item.id.kind === 'youtube#video'));

      if (!data.nextPageToken) break;
      nextPageToken = data.nextPageToken;
    }

    renderVideos(videos);
  }

  function renderVideos(videos) {
    const container = document.getElementById('video-container');
    videos.forEach(item => {
      const videoId = item.id.videoId;
      const title = item.snippet.title;

      const col = document.createElement('div');
      col.className = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';

      col.innerHTML = `
        <div class="video-container">
          <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/${videoId}" allowfullscreen></iframe>
          </div>
          <div class="video-title" title="${title}">${title}</div>
        </div>
      `;

      container.appendChild(col);
    });
  }

  fetchAllVideos();
</script>

<?php include 'footer.php'; ?>

<style>
  .video-container {
    margin-bottom: 30px;
    transition: transform 0.3s ease;
  }
  .video-container:hover {
    transform: scale(1.05);
  }
  .video-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    padding-top: 25px;
    height: 0;
    overflow: hidden;
    border-radius: 4px;
  }
  .video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
  }
  .video-title {
    margin-top: 8px;
    font-weight: bold;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>
