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

        <div id="pagination" style="text-align: center; margin-top: 20px;">
          <button id="prev-btn" disabled class="btn btn-primary">Sebelumnya</button>
          <button id="next-btn" class="btn btn-primary">Berikutnya</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  const API_KEY = 'AIzaSyC50TKuv65HSJQiNMHIHezFCQHpnYl_xv4';
  const CHANNEL_ID = 'UCV8z4gSEZhptQsxL2ZAjQEw';
  const MAX_RESULTS = 10;

  let nextPageToken = '';
  let prevPageToken = '';
  let currentPageToken = '';

  async function fetchVideos(pageToken = '') {
    const url = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&type=video&maxResults=${MAX_RESULTS}${pageToken ? `&pageToken=${pageToken}` : ''}`;
    const response = await fetch(url);
    const data = await response.json();

    if (data.items) {
      renderVideos(data.items);
      nextPageToken = data.nextPageToken || '';
      prevPageToken = data.prevPageToken || '';
      currentPageToken = pageToken;
      updatePaginationButtons();
    }
  }

  function renderVideos(videos) {
    const container = document.getElementById('video-container');
    container.innerHTML = '';

    videos.forEach(item => {
      const videoId = item.id.videoId;
      const title = item.snippet.title;

      const col = document.createElement('div');
      col.className = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';

      col.innerHTML = `
        <div class="video-container">
          <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/${videoId}" title="${title}" aria-label="${title}" allowfullscreen></iframe>
          </div>
          <div class="video-title" title="${title}">${title}</div>
        </div>
      `;

      container.appendChild(col);
    });
  }

  function updatePaginationButtons() {
    document.getElementById('prev-btn').disabled = !prevPageToken;
    document.getElementById('next-btn').disabled = !nextPageToken;
  }

  document.getElementById('next-btn').addEventListener('click', () => {
    if (nextPageToken) fetchVideos(nextPageToken);
  });

  document.getElementById('prev-btn').addEventListener('click', () => {
    if (prevPageToken) fetchVideos(prevPageToken);
  });

  fetchVideos(); // Load pertama
</script>

<?php include 'footer.php'; ?>

<style>
  .video-container {
    margin-bottom: 30px;
    transition: transform 0.3s ease;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 10px;
  }
  .video-container:hover {
    transform: scale(1.03);
  }
  .video-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    border-radius: 6px;
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
