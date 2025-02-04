<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pemain Panahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg">
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
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">Nama</th>
                        <th class="border border-gray-300 p-2">Sesi</th>
                        <th class="border border-gray-300 p-2">Jarak (m)</th>
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
                    <tr>
                        <td class="border border-gray-300 p-2 text-center"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 p-2">
                            <a href="scoring.php?id=<?php echo base64_encode($data['kode']); ?>" class="text-blue-500 hover:text-blue-700"><?php echo htmlspecialchars($data['nama']); ?></a>
                        </td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['sesi']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['jarak']); ?></td>
                        <td class="border border-gray-300 p-2 text-center">
                            <a href="edit_pemain.php?id=<?php echo base64_encode($data['kode']); ?>" class="text-blue-500 hover:text-blue-700 mx-2 text-lg sm:text-xl">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="openModal('<?php echo base64_encode($data['kode']); ?>', '<?php echo htmlspecialchars($data['nama']); ?>')" class="text-red-500 hover:text-red-700 mx-2 text-lg sm:text-xl">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
		<a href="../service.php"><i class="fa fa-bullseye text-red-500"></i> Keluar</a>

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
    </script>
    <script>
        // Paksa reload jika pengguna kembali dari history browser
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                location.reload();
            }
        });
    </script>

</body>
</html>
