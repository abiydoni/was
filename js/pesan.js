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
