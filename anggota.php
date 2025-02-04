<?php
include 'header.php'; 

// Query untuk mengambil data jumlah medali
$sql = "SELECT SUM(emas) AS total_emas, SUM(perak) AS total_perak, SUM(perunggu) AS total_perunggu FROM tbl_anggota";
$result = mysqli_query($konek, $sql);
$data = mysqli_fetch_assoc($result);

// Menyimpan total medali
$total_emas = $data['total_emas'] ?? 0;
$total_perak = $data['total_perak'] ?? 0;
$total_perunggu = $data['total_perunggu'] ?? 0;

// Query untuk menghitung total anggota, anggota aktif, dan tidak aktif
$sql_status = "SELECT 
                COUNT(*) AS total_anggota,
                SUM(CASE WHEN status = 'AKTIF' THEN 1 ELSE 0 END) AS total_aktif,
                SUM(CASE WHEN status = 'TIDAK AKTIF' THEN 1 ELSE 0 END) AS total_tidak_aktif
              FROM tbl_anggota";
$result_status = mysqli_query($konek, $sql_status);
$data_status = mysqli_fetch_assoc($result_status);

$total_anggota = $data_status['total_anggota'] ?? 0;
$total_aktif = $data_status['total_aktif'] ?? 0;
$total_tidak_aktif = $data_status['total_tidak_aktif'] ?? 0;
?>

<title>Daftar Anggota dan Grafik Medali</title>

<section id="contact" class="contact section">
    <div class="container">
        <div class="row">
            <!-- Kolom untuk Tabel Anggota -->
            <div class="col-md-8">
                <section class="statistics">
                  <div class="container-fluid">
                    <div class="row justify-content-center">
                      <div class="col-lg-12">
                        <h3 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                          Anggota Wijayakarna Archery Salatiga
                        </h3><br>
                        
                        <!-- Menampilkan Badge -->
                        <div class="text-center mb-3">
                          <span class="badge" style="background-color: #337ab7; padding: 10px;">Total Anggota: <?php echo $total_anggota; ?></span>
                          <span class="badge" style="background-color: #5cb85c; padding: 10px;">Anggota Aktif: <?php echo $total_aktif; ?></span>
                          <span class="badge" style="background-color: #d9534f; padding: 10px;">Anggota Tidak Aktif: <?php echo $total_tidak_aktif; ?></span>
                        </div><br>

                        <div class="card shadow-lg rounded p-4">
                          <div class="card-body">
                            <table class="table table-bordered table-striped" id="anggotaTable">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama</th>
                                  <th class="text-center">Medali Emas</th>
                                  <th class="text-center">Medali Perak</th>
                                  <th class="text-center">Medali Perunggu</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                // Query untuk mengambil data anggota, diurutkan berdasarkan tgl_gabung
                                $sql_anggota = "SELECT * FROM tbl_anggota ORDER BY tgl_gabung ASC"; // Urutkan berdasarkan tgl_gabung
                                $result_anggota = mysqli_query($konek, $sql_anggota);
                                $data_anggota = mysqli_fetch_all($result_anggota, MYSQLI_ASSOC);
                                ?>
                                <!-- Data akan di-load menggunakan JavaScript -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
            </div>

            <!-- Kolom untuk Grafik -->
            <div class="col-md-4 d-flex justify-content-center align-items-center"">
                <section class="statistics">
                  <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
                      <div class="col-lg-12 text-center">
                        <h3>Total Perolehan Medali</h3>
                        
                        <!-- Gambar Medali di tengah -->
                        <div class="mb-4">
                          <img src="img/medali.png" style="max-width: 150px; height: auto;" alt="Medali">
                        </div>
                
                        <!-- Menampilkan Grafik -->
                        <canvas id="medaliChart" width="600" height="600"></canvas>
                      </div>
                    </div>
                  </div>
                </section>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                // Membuat grafik dengan Chart.js
                var ctx = document.getElementById('medaliChart').getContext('2d');
                var medaliChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ['Emas', 'Perak', 'Perunggu'], // Label untuk jenis medali
                    datasets: [{
                      label: 'Total Medali',
                      data: [<?php echo $total_emas; ?>, <?php echo $total_perak; ?>, <?php echo $total_perunggu; ?>], // Data dari database
                      backgroundColor: ['#FFD700', '#C0C0C0', '#CD7F32'], // Warna untuk masing-masing medali
                      borderColor: ['#FFD700', '#C0C0C0', '#CD7F32'],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      tooltip: {
                        callbacks: {
                          label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                          }
                        }
                      }
                    }
                  }
                });
                </script>
            </div>
        </div>
    </div>
</section>

<script>
  // Data yang diambil dari PHP
  const anggotaData = <?php echo json_encode($data_anggota); ?>;

  // Menentukan jumlah baris per halaman
  const rowsPerPage = 10;
  let currentPage = 0;

  function loadTablePage() {
    const tableBody = document.querySelector("#anggotaTable tbody");
    tableBody.innerHTML = ''; // Kosongkan isi tabel sebelumnya

    // Menentukan data yang akan ditampilkan
    const startIndex = currentPage * rowsPerPage;
    const endIndex = startIndex + rowsPerPage;
    const currentData = anggotaData.slice(startIndex, endIndex);

    // Menambahkan data ke dalam tabel
    currentData.forEach((row, index) => {
      const tableRow = document.createElement('tr');
      tableRow.innerHTML = `
        <td>${startIndex + index + 1}</td>
        <td>${row.nama.slice(0, 3)}${' *'.repeat(Math.min(10, row.nama.length - 3))}</td>
        <td class="text-center">${row.emas}</td>
        <td class="text-center">${row.perak}</td>
        <td class="text-center">${row.perunggu}</td>
      `;
      tableBody.appendChild(tableRow);
    });
    
    // Perbarui halaman saat mencapai data terakhir
    currentPage = (currentPage + 1) % Math.ceil(anggotaData.length / rowsPerPage);
  }

  // Memuat halaman pertama
  loadTablePage();

  // Mengatur interval untuk berpindah halaman setiap 10 detik
  setInterval(loadTablePage, 10000);
</script>
<script>
    // Paksa reload jika pengguna kembali dari history browser
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            location.reload();
        }
    });
</script>

<?php include 'footer.php'; ?>
