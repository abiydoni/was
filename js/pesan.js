function konfirmasiHapus(id, nama) {
  Swal.fire({
    title: "Apakah Anda yakin?",
    text: `Pemain "${nama}" akan dihapus secara permanen!`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `hapus_pemain.php?id=${id}`;
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success",
      });
    }
  });
}

function confirmDelete(event, element) {
  event.preventDefault(); // Mencegah langsung ke link

  Swal.fire({
    title: "Yakin ingin menghapus?",
    text: "Data yang dihapus tidak bisa dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      // Tampilkan loading sebelum menghapus
      Swal.fire({
        title: "Menghapus...",
        text: "Silakan tunggu",
        icon: "info",
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      // Kirim request penghapusan menggunakan fetch agar tidak perlu pindah halaman
      fetch(element.href, { method: "GET" })
        .then((response) => response.text())
        .then((data) => {
          Swal.fire({
            title: "Deleted!",
            text: "Data telah dihapus.",
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
          });

          // Reload halaman setelah 2 detik agar tabel terupdate
          setTimeout(() => {
            location.reload();
          }, 2000);
        })
        .catch((error) => {
          Swal.fire({
            title: "Error!",
            text: "Terjadi kesalahan saat menghapus data.",
            icon: "error",
            timer: 2000,
            showConfirmButton: false,
          });
        });
    }
  });

  return false; // Mencegah action default
}
