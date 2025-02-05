<?php
include '../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?status=error");
    exit();
}

$id = base64_decode($_GET['id']); // Dekripsi ID pemain
$qry = mysqli_query($konek, "SELECT * FROM tbl_nama WHERE kode = '$id'");
$data = mysqli_fetch_assoc($qry);

if (!$data) {
    header("Location: index.php?status=notfound");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

</head>
<body class="bg-gray-100 p-4 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Scoring</h2>
        <form action="" method="POST">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl flex gap-6">
                <!-- Bagian Kiri: Informasi Pemain -->
                <div class="w-2/3">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Nama Pemain:</label>
                        <p class="text-lg font-semibold text-blue-600"><?php echo htmlspecialchars($data['nama']); ?></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Jarak:</label>
                        <p class="text-lg font-semibold text-green-600"><?php echo htmlspecialchars($data['jarak']); ?> m</p>
                    </div>
                    <button onclick="printReport()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                        Cetak Laporan
                    </button>
                </div>

                <!-- Bagian Kanan: Card Sesi -->
                <div class="w-1/3 flex items-center justify-center">
                    <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-xl w-full text-center">
                        <p class="text-xl font-semibold">Sesi</p>
                        <p class="text-5xl font-bold mt-2"><?php echo htmlspecialchars($data['sesi']); ?></p>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">No</th>
                            <th class="border border-gray-300 p-2">1</th>
                            <th class="border border-gray-300 p-2">2</th>
                            <th class="border border-gray-300 p-2">3</th>
                            <th class="border border-gray-300 p-2">4</th>
                            <th class="border border-gray-300 p-2">5</th>
                            <th class="border border-gray-300 p-2">6</th>
                            <th class="border border-gray-300 p-2 font-bold">Jumlah</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0; // Inisialisasi Grand Total sebelum melakukan loop
                        $qry_skor = mysqli_query($konek, "SELECT * FROM tbl_scoring WHERE kode='$id'");
                        $no = 1;

                        if (mysqli_num_rows($qry_skor) > 0) {
                            while ($row = mysqli_fetch_assoc($qry_skor)) {
                                $jumlah = $row['s1'] + $row['s2'] + $row['s3'] + $row['s4'] + $row['s5'] + $row['s6'];
                                $grandTotal += $jumlah; // Menambahkan jumlah setiap row ke grand total
                                // Lanjutkan proses output tabel
                        ?>
                        <tr>
                            <td class="border border-gray-300 p-2 text-center"><?php echo $no++; ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s1']); ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s2']); ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s3']); ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s4']); ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s5']); ?></td>
                            <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($row['s6']); ?></td>
                            <td class="border border-gray-300 p-2 text-center font-bold"><?php echo $jumlah; ?></td>
                            <td class="border border-gray-300 p-2 text-center">
                            <a href="scoring_hapus.php?id=<?php echo base64_encode($row['nom'] . ',' . $data['kode']); ?>" 
                                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600"
                                onclick="return confirmDelete(this);">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="8" class="border border-gray-300 p-4 text-center text-gray-600">
                                Data masih kosong
                            </td>
                        </tr>
                        <?php } ?>
                        <!-- Grand Total -->
                        <tr class="bg-gray-200">
                            <td colspan="7" class="border border-gray-300 p-2 text-center font-bold">Grand Total</td>
                            <td class="border border-gray-300 p-2 text-center font-bold"><?php echo $grandTotal; ?></td>
                            <td></td> <!-- Kolom Aksi dikosongkan -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between mt-4">
                <a href="index.php?updated=1" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
                <button type="button" 
                    onclick="<?php echo ($grandTotal > 0) ? "confirmFinish('" . base64_encode($data['kode']) . "')" : "return false;"; ?>" 
                    class="px-4 py-2 rounded-lg <?php echo ($grandTotal > 0) ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-gray-300 text-gray-500 opacity-50 cursor-not-allowed'; ?>"
                    <?php echo ($grandTotal == 0) ? 'disabled' : ''; ?>>
                    Selesai
                </button>
                <a href="scoring_edit.php?id=<?php echo base64_encode($data['kode']); ?>" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 inline-block">
                    Mulai
                </a>
            </div>
        </form>
    </div>
    <?php include 'lap_scoring.php'; ?>
    <script>
    function confirmDelete(el) {
        if (confirm("Apakah benar akan menghapus data ini?")) {
            fetch(el.href)
                .then(response => response.text()) // Bisa disesuaikan dengan format respons
                .then(() => location.reload()); // Reload otomatis setelah penghapusan
            return false; // Mencegah navigasi langsung
        }
        return false; // Mencegah navigasi jika batal
        }

    // Paksa reload jika pengguna kembali dari history browser
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                location.reload();
            }
        });
    </script>
    <script>
        function confirmFinish() {
            if (confirm("Apakah yakin Scoring sudah selesai?")) {
                let id = "<?php echo base64_encode($data['kode']); ?>";
                let grandTotal = "<?php echo $grandTotal; ?>";

                fetch("update_skor.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "id=" + id + "&skor=" + grandTotal
                })
                .then(response => response.text())
                .then(result => {
                    if (result === "success") {
                        alert("Scoring berhasil disimpan!");
                        window.location.href = "index.php?updated=1";
                    } else {
                        alert("Terjadi kesalahan, silakan coba lagi.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        }
    </script>

</body>
</html>
