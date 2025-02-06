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
        <h3 class="text-xl font-bold text-gray-800">List Pemain</h3>
        <div class="flex justify-between items-center mb-4">
            <h5 class="font-bold mb-4 text-gray-800"><?php echo date('l, d F Y'); ?></h5>
            <a href="laporan.php" class="bg-green-500 text-white text-xs px-3 py-2 rounded-lg shadow hover:bg-green-600">
                <i class="fas fa-print"></i>
            </a>
        </div>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $qry = mysqli_query($konek, "SELECT * FROM tbl_nama");
                    $no = 1;
                    while ($data = mysqli_fetch_array($qry)) {
                    ?>
                    <tr class="hover:bg-gray-100 odd:bg-white even:bg-gray-50">
                        <td class="border border-gray-300 p-2 text-center"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['nama']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['sesi']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['jarak']); ?></td>
                        <td class="border border-gray-300 p-2 text-center"><?php echo htmlspecialchars($data['skor']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="mt-4">
            <a href="index.php?updated=<?php echo time(); ?>" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 inline-flex items-center">
                <i class="fa fa-bullseye mr-2"></i> Kembali
            </a>
        </div>

    </div>
</body>
</html>
