<?php include 'header.php'; ?>

<title>Video</title>

<section id="latest-works" class="latest-works">
  <div class="container section">
    <div class="row">
      <div class="col-xs-12">
        <div class="section-title">
          <h2>My <span>VIDEO</span></h2>
        </div>

        <div class="row" style="margin-bottom: 20px;">
          <div class="col-md-6">
            <label>Tampilkan: 
              <select id="perPageSelect" class="form-control" style="width: auto; display: inline-block;">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select> video per halaman
            </label>
          </div>
          <div class="col-md-6 text-right">
            <div id="page-info"></div>
          </div>
        </div>

        <div id="video-container" class="row" style="margin-top: 20px;">
          <!-- Video akan muncul di sini -->
        </div>

        <div id="pagination" style="text-align: center; margin-top: 20px;">
          <button id="prev-btn" class="btn btn-primary">Sebelumnya</button>
          <span id="page-number" style="margin: 0 15px;"></span>
          <button id="next-btn" class="btn btn-primary">Berikutnya</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  const API_KEY = 'AIzaSyC50TKuv65HSJQiNMHIHezFCQHpnYl_xv4';
  const CHANNEL_ID = 'UCV8z4gSEZhptQsxL2ZAjQEw';

  let videos = [];
  let perPage = 10;
  let currentPage = 1;

  document.getElementById('perPageSelect').addEventListener('change', (e) => {
    perPage = parseInt(e.target.value);
    currentPage = 1;
    renderPage();
  });

  document.getElementById('prev-btn').addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      renderPage();
    }
  });

  document.getElementById('next-btn').addEventListener('click', () => {
    if (currentPage < getTotalPages()) {
      currentPage++;
      renderPage();
    }
  });

  function getTotalPages() {
    return Math.ceil(videos.length / perPage);
  }

  function renderPage() {
    const startIndex = (currentPage - 1) * perPage;
    const currentVideos = videos.slice(startIndex, startIndex + perPage);

    renderVideos(currentVideos);

    document.getElementById('page-number').textContent = `Halaman ${currentPage} dari ${getTotalPages()}`;
    document.getElementById('page-info').textContent = `Total Video: ${videos.length} | Total Halaman: ${getTotalPages()}`;

    document.getElementById('prev-btn').disabled = currentPage === 1;
    document.getElementById('next-btn').disabled = currentPage === getTotalPages();
  }

  function renderVideos(currentVideos) {
    const container = document.getElementById('video-container');
    container.innerHTML = '';

    currentVideos.forEach(item => {
      const videoId = item.id.videoId;
      const title = item.snippet.title;

      const col = document.createElement('div');
      col.className = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';

      col.innerHTML = `
        <div class="video-container">
          <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/${videoId}" title="${title}" allowfullscreen></iframe>
          </div>
          <div class="video-title" title="${title}">${title}</div>
        </div>
      `;

      container.appendChild(col);
    });
  }

  async function fetchAllVideos() {
    let nextPageToken = '';
    do {
      const url = `https://www.googleapis.com/youtube/v3/search?key=${API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&type=video&maxResults=50${nextPageToken ? `&pageToken=${nextPageToken}` : ''}`;
      const response = await fetch(url);
      const data = await response.json();
      if (!data.items) break;

      videos.push(...data.items);
      nextPageToken = data.nextPageToken;
    } while (nextPageToken);

    renderPage();
  }

  fetchAllVideos();
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
    padding-bottom: 56.25%;
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
