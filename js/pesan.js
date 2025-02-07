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
      window.location.href = `scoring_hapus.php?id=${id}`;
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success",
      });
    }
    location.reload();
  });

  return false; // Mencegah action default
}
