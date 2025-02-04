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

     #report-table {
         display: block; /* Agar tetap terlihat di layar normal */
     }
 </style>

 <!-- Tabel Laporan -->
 <div id="report-table" style="display:none;">
     <h2 class="text-center text-2xl font-bold mb-4">Laporan Skor</h2>
     <label class="block text-gray-700 font-semibold">Nama Pemain: <?php echo htmlspecialchars($data['nama']); ?></label>
     <label class="block text-gray-700 font-semibold">Jarak (m): <?php echo htmlspecialchars($data['jarak']); ?>m</label>

     <table class="table table-bordered table-striped table-hover">
         <thead>
             <tr class="info">
                 <th class="text-center">No</th>
                 <th class="text-center">1</th>
                 <th class="text-center">2</th>
                 <th class="text-center">3</th>
                 <th class="text-center">4</th>
                 <th class="text-center">5</th>
                 <th class="text-center">6</th>
                 <th class="text-center">Jumlah</th>
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
             ?>
             <tr>
                 <td class="text-center"><?php echo $no++; ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s1']); ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s2']); ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s3']); ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s4']); ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s5']); ?></td>
                 <td class="text-center"><?php echo htmlspecialchars($row['s6']); ?></td>
                 <td class="text-center font-weight-bold"><?php echo $jumlah; ?></td>
             </tr>
             <?php
                 }
             } else {
             ?>
             <tr>
                 <td colspan="8" class="text-center text-muted">
                     Data masih kosong
                 </td>
             </tr>
             <?php } ?>
             <!-- Grand Total -->
             <tr class="active">
                 <td colspan="7" class="text-center font-weight-bold">Grand Total</td>
                 <td class="text-center font-weight-bold"><?php echo $grandTotal; ?></td>
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
