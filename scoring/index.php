<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pemain Panahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <link rel="manifest" href="manifest.json">
</head>
<body class="bg-gray-100 p-2">
    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg">
        <a href="../index.php" class="text-blue-500 hover:text-blue-700"><i class="fa fa-bullseye mr-2"></i>https://was.appsbee.my.id</a>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">List Pemain</h3>
            <a href="tambah_pemain.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                <i class="fas fa-plus"></i> Tambah Pemain
            </a>
        </div>
        <h5 class="font-bold mb-4 text-gray-800"><?php echo date('l, d F Y'); ?></h5>

        <!-- <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="bg-green-500 text-white p-4 rounded mb-4">Data berhasil diperbarui!</div>';
            } elseif ($_GET['status'] == 'error') {
                echo '<div class="bg-red-500 text-white p-4 rounded mb-4">Terjadi kesalahan, data gagal diperbarui.</div>';
            }
        }
        ?> -->

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <!-- Tambahkan efek hover dan zebra stripes -->
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">Nama</th>
                        <th class="border border-gray-300 p-2">Sesi</th>
                        <th class="border border-gray-300 p-2">Jarak (m)</th>
                        <th class="border border-gray-300 p-2">Skor</th>
                        <th class="border border-gray-300 p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $qry = mysqli_query($konek, "SELECT * FROM tbl_nama WHERE DATE(tanggal) = CURDATE()");
                    $no = 1;
                    while ($data = mysqli_fetch_array($qry)) {
                    ?>
                    <tr class="hover:bg-gray-100 odd:bg-white even:bg-gray-50">
                        <td class="border border-gray-300 p-2 text-center"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 p-2">
                            <a href="<?php echo ($data['skor'] > 0) ? 'scoring_end.php?id=' . base64_encode($data['kode']) : 'scoring.php?id=' . base64_encode($data['kode']); ?>" 
                            class="<?php echo ($data['skor'] > 0) ? 'text-gray-500 hover:text-gray-700' : 'text-blue-500 hover:text-blue-700'; ?>">
                                <?php echo htmlspecialchars($data['nama']); ?>
                            </a>
                        </td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['sesi']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['jarak']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['skor']); ?></td>
                        <td class="border border-gray-300 p-2 text-center">
                            <a href="edit_pemain.php?id=<?php echo base64_encode($data['kode']); ?>" 
                            class="text-blue-500 hover:text-blue-700 mx-2 text-lg sm:text-xl 
                            <?php echo ($data['skor'] > 0) ? 'pointer-events-none opacity-50' : ''; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="openModal('<?php echo base64_encode($data['kode']); ?>', '<?php echo htmlspecialchars($data['nama']); ?>')" 
                                    class="text-red-500 hover:text-red-700 mx-2 text-lg sm:text-xl 
                                    <?php echo ($data['skor'] > 0) ? 'pointer-events-none opacity-50' : ''; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <!-- <div class="mt-4">
            <a href="../service.php" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 inline-flex items-center">
                <i class="fa fa-bullseye mr-2"></i> Keluar
            </a>
        </div>
 -->
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h5 id="modal-message" class="text-lg font-bold text-gray-800"></h5>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-lg mr-2">Batal</button>
                <a id="deleteLink" href="#" class="bg-red-500 text-white hover:bg-red-600 px-4 py-2 rounded-lg">Hapus</a>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, name) {
            document.getElementById('modal-message').innerHTML = 'Apakah Anda yakin ingin menghapus data dengan nama: ' + name + '?';
            document.getElementById('deleteLink').href = "hapus_pemain.php?id=" + id;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        document.addEventListener("DOMContentLoaded", function () {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('updated')) {
                loadTable();  // Update data langsung setelah kembali ke index.php
                window.history.replaceState({}, document.title, "index.php"); // Hapus parameter dari URL agar tidak trigger ulang saat refresh
            }
        });
    </script>
    <script>
        // Register the service worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then((registration) => {
                console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch((error) => {
                console.error('Service Worker registration failed:', error);
                });
            });
        }
    </script>
</body>
</html>
