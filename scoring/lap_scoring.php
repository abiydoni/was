<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #report-table, #report-table * {
            visibility: visible;
        }
        #report-table {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>
    

<!-- Tabel Laporan -->
    <div id="report-table" style="display:none;">
        <h2 class="text-center text-2xl font-bold mb-4">Laporan Skor</h2>
        <label class="block text-gray-700 font-semibold">Nama Pemain: <?php echo htmlspecialchars($data['nama']); ?></label>
        <label class="block text-gray-700 font-semibold">Jarak (m): <?php echo htmlspecialchars($data['jarak']); ?>m</label>

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
                </tr>
            </tbody>
        </table>
    </div>

<script>
    function printReport() {
            document.getElementById("report-table").style.display = "block";
            window.print();
            document.getElementById("report-table").style.display = "none";
        }
</script>
