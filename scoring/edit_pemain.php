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
    $nama = mysqli_real_escape_string($konek, $_POST['nama']);
    $jarak = mysqli_real_escape_string($konek, $_POST['jarak']);

    $sql = "UPDATE tbl_nama SET nama='$nama', jarak='$jarak' WHERE kode='$id'";

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

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Jarak (m)</label>
                <input type="number" name="jarak" value="<?php echo htmlspecialchars($data['jarak']); ?>" required class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div class="flex justify-between">
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
