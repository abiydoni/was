<?php
include '../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: scoring.php?status=error");
    exit();
}

$id = base64_decode($_GET['id']); // Dekripsi ID pemain

// Cek apakah data pemain ada di tbl_nama
$qry_nama = mysqli_query($konek, "SELECT * FROM tbl_nama WHERE kode = '$id'");
$data_nama = mysqli_fetch_assoc($qry_nama);

if (!$data_nama) {
    header("Location: scoring.php?status=notfound");
    exit();
}

// Cek apakah data sudah ada di tbl_scoring
$qry_skor = mysqli_query($konek, "SELECT * FROM tbl_scoring WHERE kode = '$id'");
$data_skor = mysqli_fetch_assoc($qry_skor);

// Jika tombol Simpan ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari input hidden
    $s1 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-1-Input']);
    $s2 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-2-Input']);
    $s3 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-3-Input']);
    $s4 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-4-Input']);
    $s5 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-5-Input']);
    $s6 = mysqli_real_escape_string($konek, $_POST['Anak-Panah-6-Input']);

    $sql = "INSERT INTO tbl_scoring (kode, nama, jarak, s1, s2, s3, s4, s5, s6) 
            VALUES ('$id', '{$data_nama['nama']}', '{$data_nama['jarak']}', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6')";

    if (mysqli_query($konek, $sql)) {
        header("Location: scoring.php?id=" . base64_encode($data_nama['kode'])); // Perbaiki dengan operator .
        exit(); // Jangan lupa untuk exit setelah header untuk menghentikan eksekusi lebih lanjut.
    } else {
        echo "Error: " . mysqli_error($konek); // Cek error jika ada
        header("Location: scoring.php?status=error");
        exit(); // Pastikan eksekusi dihentikan setelah header
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Scoring</h2>

        <form action="" method="POST">
            <div class="mb-4">
                <a href="#" class="text-gray-500">Nama Pemain: <?php echo htmlspecialchars($data_nama['nama']); ?></a>
                <a href="#" class="text-gray-500">Sesi: <?php echo htmlspecialchars($data_nama['sesi']); ?> Jarak (m): <?php echo htmlspecialchars($data_nama['jarak']); ?>m</a>
            </div>

            <div class="flex flex-wrap gap-4 justify-center">
                <?php
                $fields = ['Anak-Panah-1', 'Anak-Panah-2', 'Anak-Panah-3', 'Anak-Panah-4', 'Anak-Panah-5', 'Anak-Panah-6'];
                $values = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
                $counter = 1;  // Nomor urut

                foreach ($fields as $field) {
                    $value = isset($data_skor[$field]) ? htmlspecialchars($data_skor[$field]) : '';
                    echo "<div class='w-full flex items-center gap-4 mb-4'>";

                    // Menampilkan nomor urut dan card dengan angka besar di sebelah kiri
                    echo "<div class='flex flex-col items-center'>";
                    echo "<div id='card-{$field}' class='w-20 p-3 bg-gray-200 rounded-lg shadow-md flex flex-col justify-center items-center'>
                            <span class='text-xs text-gray-500 mb-1'>Nilai {$counter}</span> <!-- Nomor Urut -->
                            <span id='display-{$field}' class='text-4xl font-bold text-gray-800'>0</span> <!-- Nilai -->
                          </div>";
                    echo "</div>";
                    
                    echo "<div class='flex flex-wrap gap-1'>"; // Tombol-tombol nilai di dalam satu baris

                    // Tombol nilai dari 10 sampai 1
                    foreach ($values as $i) {
                        $colorClass = ''; // Menentukan warna tombol berdasarkan nilai
                        if ($i == 10 || $i == 9) {
                            $colorClass = 'bg-yellow-500 text-white';
                        } elseif ($i == 8 || $i == 7) {
                            $colorClass = 'bg-red-500 text-white';
                        } elseif ($i == 6 || $i == 5) {
                            $colorClass = 'bg-blue-500 text-white';
                        } elseif ($i == 4 || $i == 3) {
                            $colorClass = 'bg-black text-white';
                        } else {
                            $colorClass = 'bg-gray-200 text-white';
                        }

                        // Menambahkan border dan shadow ke tombol
                        $borderClass = 'border-2 border-gray-200';
                        $shadowClass = 'shadow-lg';
                        echo "<button type='button' name='{$field}-{$i}' value='$i' class='$colorClass $borderClass $shadowClass rounded-full px-3 py-1 text-base hover:bg-green-300 transition-all duration-300'>$i</button>";
                    }

                    echo "</div>";  // Menutup div untuk set tombol
                    echo "<input type='hidden' name='{$field}-Input' value='{$value}'>";  // Input hidden untuk menyimpan nilai
                    echo "</div>";  // Menutup div untuk setiap field

                    $counter++; // Increment nomor urut
                }
                ?>
            </div>

            <div class="flex justify-between mt-4">
                <a href="scoring.php?id=<?php echo base64_encode($data_nama['kode']); ?>" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fields = ['Anak-Panah-1', 'Anak-Panah-2', 'Anak-Panah-3', 'Anak-Panah-4', 'Anak-Panah-5', 'Anak-Panah-6'];

            fields.forEach(function(field) {
                const buttons = document.querySelectorAll(`[name^="${field}"]`);
                buttons.forEach(function(button) {
                    button.addEventListener("click", function () {
                        // Mendapatkan nilai saat ini yang dipilih
                        const selectedValue = button.value;
                        const displayElement = document.getElementById(`display-${field}`);
                        const hiddenInput = document.querySelector(`[name="${field}-Input"]`);

                        // Jika tombol yang dipilih sudah sama dengan nilai yang ada, reset
                        if (displayElement.innerText === selectedValue) {
                            // Reset tampilan card ke nilai awal (0)
                            displayElement.innerText = '0';

                            // Reset nilai pada input tersembunyi ke nilai awal (kosong atau nol)
                            hiddenInput.value = '';

                            // Reset gaya tombol ke default
                            buttons.forEach(function(btn) {
                                btn.classList.remove("bg-yellow-500", "bg-red-500", "bg-blue-500", "bg-black", "bg-gray-200", "text-white");
                                btn.classList.add("bg-gray-400", "text-white"); // Tombol default style
                            });
                        } else {
                            // Perbarui angka yang ditampilkan di card
                            displayElement.innerText = selectedValue;

                            // Perbarui nilai pada input tersembunyi
                            hiddenInput.value = selectedValue;

                            // Reset gaya tombol ke default
                            buttons.forEach(function(btn) {
                                btn.classList.remove("bg-yellow-500", "bg-red-500", "bg-blue-500", "bg-black", "bg-gray-200", "text-white");
                                btn.classList.add("bg-gray-400", "text-white"); // Tombol default style
                            });

                            // Setel gaya tombol yang dipilih
                            button.classList.remove("bg-gray-400", "text-white"); // Menghapus gaya default
                            if (button.value == 10 || button.value == 9) {
                                button.classList.add("bg-yellow-500", "text-white");
                            } else if (button.value == 8 || button.value == 7) {
                                button.classList.add("bg-red-500", "text-white");
                            } else if (button.value == 6 || button.value == 5) {
                                button.classList.add("bg-blue-500", "text-white");
                            } else if (button.value == 4 || button.value == 3) {
                                button.classList.add("bg-black", "text-white");
                            } else {
                                button.classList.add("bg-gray-200", "text-white");
                            }
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
