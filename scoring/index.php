<?php
include '../koneksi.php';

// Ambil data anggota dari database
$qry = mysqli_query($konek, "SELECT kode, nama FROM tbl_anggota");
$anggota = [];
while ($row = mysqli_fetch_assoc($qry)) {
    $anggota[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pemain Panahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> <!-- Menambahkan Alpine.js -->
    <link rel="manifest" href="manifest.json">
</head>
<body class="bg-gray-100 p-2">
    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg" x-data="dropdownData()">
        <a href="https://was.appsbee.my.id" class="text-xs text-blue-500 hover:text-blue-700" target="_blank">
            <i class="fa fa-bullseye mr-2"></i>was.appsbee.my.id
        </a>
        <h3 class="text-xl font-bold text-gray-800">List Pemain</h3>
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-bold mb-4 text-gray-800"><?php echo date('l, d F Y'); ?></h5>
            <div class="flex items-center space-x-2 ml-auto">
                <button onclick="openAddModal()" class="bg-blue-500 text-white text-xs px-3 py-2 rounded-lg shadow hover:bg-blue-600">
                    <i class="fas fa-plus"></i>
                </button>
                <a href="laporan.php?updated=<?php echo time(); ?>" class="bg-green-500 text-white text-xs px-3 py-2 rounded-lg shadow hover:bg-green-600">
                    <i class="far fa-clipboard"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
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
                    $stmt = $konek->prepare("SELECT * FROM tbl_nama WHERE DATE(tanggal) = CURDATE()");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $no = 1;
                    while ($data = $result->fetch_assoc()) {
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
                            class="text-blue-500 hover:text-blue-700 mx-2 text-lg sm:text-xl <?php echo ($data['skor'] > 0) ? 'pointer-events-none opacity-50' : ''; ?>"
                            title="<?php echo ($data['skor'] > 0) ? 'Tidak bisa diedit setelah memiliki skor' : 'Edit Pemain'; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="openModal('<?php echo base64_encode($data['kode']); ?>', '<?php echo htmlspecialchars($data['nama']); ?>')" 
                                    class="text-red-500 hover:text-red-700 mx-2 text-lg sm:text-xl <?php echo ($data['skor'] > 0) ? 'pointer-events-none opacity-50' : ''; ?>"
                                    title="<?php echo ($data['skor'] > 0) ? 'Tidak bisa dihapus setelah memiliki skor' : 'Hapus Pemain'; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pemain -->
    <div id="addModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Pemain</h2>
            <form action="tambah_pemain.php" method="POST" @submit="validateAndSubmit">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Nama Pemain</label>
                    <input type="hidden" name="kode_agt" x-model="selectedKode">
                    <input type="hidden" name="nama" x-model="selectedNama">
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Cari nama..." @focus="open = true" @click.away="open = false"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                        <div class="absolute w-full bg-white border rounded-lg mt-1 max-h-40 overflow-y-auto shadow-md" x-show="open">
                            <template x-for="item in filteredAnggota" :key="item.kode">
                                <div @click="selectItem(item)" class="p-2 cursor-pointer hover:bg-gray-200">
                                    <span x-text="item.nama"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                    <p class="text-red-500 text-sm mt-1" x-show="errorNama">Nama harus sesuai dengan pilihan!</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Jarak (m)</label>
                    <input type="number" name="jarak" x-model="jarak" min="0" value="0" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jarak (m)">
                    <p class="text-red-500 text-sm mt-1" x-show="errorJarak">Jarak tidak boleh 0!</p>
                </div>

                <!-- Input Sesi -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Berapa Sesi?</label>
                    <input type="number" name="sesi" x-model="sesi" min="1" value="1" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jumlah sesi">
                    <p class="text-red-500 text-sm mt-1" x-show="errorSesi">Sesi minimal 1!</p>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden transition-opacity duration-300 ease-in-out">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h5 id="modal-message" class="text-lg font-bold text-gray-800"></h5>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-lg mr-2">Batal</button>
                <a id="deleteLink" href="#" class="bg-red-500 text-white hover:bg-red-600 px-4 py-2 rounded-lg">Hapus</a>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }

        function openModal(id, nama) {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal-message').textContent = `Apakah Anda yakin ingin menghapus pemain "${nama}"?`;
            document.getElementById('deleteLink').setAttribute('href', 'hapus_pemain.php?id=' + id);
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
    <script>
        function dropdownData() {
            return {
                search: '',
                open: false,
                selectedKode: '',
                selectedNama: '',
                jarak: 0,
                sesi: 1,
                errorNama: false,
                errorJarak: false,
                errorSesi: false,
                anggota: <?php echo json_encode($anggota); ?>,
                
                get filteredAnggota() {
                    return this.anggota.filter(a => a.nama.toLowerCase().includes(this.search.toLowerCase()));
                },

                selectItem(item) {
                    this.search = item.nama;
                    this.selectedNama = item.nama;
                    this.selectedKode = item.kode;
                    this.errorNama = false;
                    this.open = false;
                },

                validateAndSubmit(event) {
                    this.errorNama = !this.anggota.some(a => a.nama.toLowerCase() === this.search.toLowerCase());
                    this.errorJarak = this.jarak == 0;
                    this.errorSesi = this.sesi < 1;

                    if (this.errorNama || this.errorJarak || this.errorSesi) {
                        return;
                    }

                    event.target.submit();
                }
            };
        }
    </script>
</body>
</html>
