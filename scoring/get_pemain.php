<?php
include '../koneksi.php';

$stmt = $konek->prepare("SELECT * FROM tbl_nama WHERE DATE(tanggal) = CURDATE()");
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($data = $result->fetch_assoc()) {
    echo "<tr class='hover:bg-gray-100 odd:bg-white even:bg-gray-50'>";
    echo "<td class='border border-gray-300 p-2 text-center'>" . $no++ . "</td>";
    echo "<td class='border border-gray-300 p-2'>
            <a href='" . ($data['skor'] > 0 ? "scoring_end.php?id=" . base64_encode($data['kode']) : "scoring.php?id=" . base64_encode($data['kode'])) . "' 
            class='" . ($data['skor'] > 0 ? "text-gray-500 hover:text-gray-700" : "text-blue-500 hover:text-blue-700") . "'>
                " . htmlspecialchars($data['nama']) . "
            </a>
          </td>";
    echo "<td class='border border-gray-300 p-2 text-center'>" . htmlspecialchars($data['sesi']) . "</td>";
    echo "<td class='border border-gray-300 p-2 text-center'>" . htmlspecialchars($data['jarak']) . "</td>";
    echo "<td class='border border-gray-300 p-2 text-center'>" . htmlspecialchars($data['skor']) . "</td>";
    echo "<td class='border border-gray-300 p-2 text-center'>
            <a href='edit_pemain.php?id=" . base64_encode($data['kode']) . "' 
            class='text-blue-500 hover:text-blue-700 mx-2 text-lg sm:text-xl " . ($data['skor'] > 0 ? "pointer-events-none opacity-50" : "") . "'
            title='" . ($data['skor'] > 0 ? "Tidak bisa diedit setelah memiliki skor" : "Edit Pemain") . "'>
                <i class='fas fa-edit'></i>
            </a>
            <button onclick=\"konfirmasiHapus('" . base64_encode($data['kode']) . "', '" . htmlspecialchars($data['nama']) . "')\"
            class='text-red-500 hover:text-red-700 mx-2 text-lg sm:text-xl " . ($data['skor'] > 0 ? "pointer-events-none opacity-50" : "") . "'
            title='" . ($data['skor'] > 0 ? "Tidak bisa dihapus setelah memiliki skor" : "Hapus Pemain") . "'>
                <i class='fas fa-trash-alt'></i>
            </button>
          </td>";
    echo "</tr>";
}
?>
