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
<body class="bg-gray-100 p-4 flex items-center justify-center min-h-screen">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg w-full">
        <h3 class="text-xl font-bold text-gray-800 mb-4">List Pemain</h3>
        <div class="flex items-center justify-between mb-4">
            <button onclick="openAddModal()" class="bg-blue-500 text-white text-xs px-3 py-2 rounded-lg shadow hover:bg-blue-600">
                <i class="fas fa-plus"></i> Tambah Pemain
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">Nama</th>
                        <th class="border border-gray-300 p-2">Sesi</th>
                        <th class="border border-gray-300 p-2">Jarak (m)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $stmt = $konek->prepare("SELECT * FROM tbl_nama WHERE DATE(tanggal) = CURDATE()");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $no = 1;
                    while ($data = $result->fetch_assoc()) {
                    ?>
                    <tr class="hover:bg-gray-100 odd:bg-white even:bg-gray-50">
                        <td class="border border-gray-300 p-2 text-center"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 p-2"><?php echo htmlspecialchars($data['nama']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['sesi']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['jarak']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="addModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Pemain</h2>
            <form action="tambah_pemain.php" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Nama Pemain</label>
                    <input type="text" name="nama" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Jarak (m)</label>
                    <input type="number" name="jarak" min="0" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jarak (m)" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Berapa Sesi?</label>
                    <input type="number" name="sesi" min="1" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jumlah sesi" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
    </script>
</body>
</html>
