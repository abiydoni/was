<?php
include '../koneksi.php';

// Ambil data anggota dari database
$qry = mysqli_query($konek, "SELECT kode, nama FROM tbl_anggota");
$anggota = [];
while ($row = mysqli_fetch_assoc($qry)) {
    $anggota[] = $row;
}

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode_agt = mysqli_real_escape_string($konek, $_POST['kode_agt']);
    $nama = mysqli_real_escape_string($konek, $_POST['nama']);
    $jarak = mysqli_real_escape_string($konek, $_POST['jarak']);

    // Query insert data
    $sql = "INSERT INTO tbl_nama (kode_agt, nama, jarak) VALUES ('$kode_agt', '$nama', '$jarak')";
    
    if (mysqli_query($konek, $sql)) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemain</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 p-4 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Pemain</h2>
        
        <form action="tambah_pemain.php" method="POST" x-data="dropdownData()" @submit.prevent="validateAndSubmit">
            <!-- Input Nama Pemain -->
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

            <!-- Input Jarak -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Jarak (m)</label>
                <input type="number" name="jarak" x-model="jarak" min="0" value="0" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jarak (m)">
                <p class="text-red-500 text-sm mt-1" x-show="errorJarak">Jarak tidak boleh 0!</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        function dropdownData() {
            return {
                search: '',
                open: false,
                selectedKode: '',
                selectedNama: '',
                jarak: 0,
                errorNama: false,
                errorJarak: false,
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

                    if (this.errorNama) {
                        alert("Nama pemain harus sesuai dengan daftar yang ada!");
                    } else if (this.errorJarak) {
                        alert("Jarak tidak boleh 0!");
                    } else {
                        event.target.submit();
                    }
                }
            };
        }
    </script>
</body>
</html>
