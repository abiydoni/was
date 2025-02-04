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

// Jika tombol Simpan ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $nama = mysqli_real_escape_string($konek, $_POST['nama']);
    $jarak = mysqli_real_escape_string($konek, $_POST['jarak']);

    $sql = "UPDATE tbl_nama SET jarak='$jarak' WHERE kode='$id'";

    if (mysqli_query($konek, $sql)) {
        header("Location: index.php?status=updated");
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
    <title>Edit Pemain</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Pemain</h2>

        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Nama Pemain</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" readonly>
            </div>

            <!-- Input Jarak -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Jarak (m)</label>
                <input type="number" name="jarak" x-model="jarak" min="0" value="<?php echo htmlspecialchars($data['jarak']); ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan jarak (m)">
                <p class="text-red-500 text-sm mt-1" x-show="errorJarak">Jarak tidak boleh 0!</p>
            </div>


            <div class="flex justify-between">
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    <script>
        function dropdownData() {
            return {
                jarak: 0,
                errorJarak: false,
                validateAndSubmit(event) {
                    this.errorJarak = this.jarak == 0;
                    if (this.errorJarak) {
                        // alert("Jarak tidak boleh 0!");
                    } else {
                        event.target.submit();
                    }
                }
            };
        }
    </script>
</body>
</html>
