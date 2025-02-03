<!-- Formulir Diskusi -->
<div class="container my-5">
    <h3>Buat Diskusi Baru</h3>
    <form method="POST" action="diskusi_proses.php">
        <div class="form-group">
            <label for="judul">Judul Diskusi:</label>
            <input type="text" class="form-control" id="judul" name="judul" required placeholder="Masukkan judul diskusi">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required placeholder="Masukkan deskripsi diskusi"></textarea>
        </div>
        <div class="form-group">
            <label for="nama_pembuat">Nama Anda:</label>
            <input type="text" class="form-control" id="nama_pembuat" name="nama_pembuat" required placeholder="Masukkan nama Anda">
        </div>
        <button type="submit" class="btn btn-primary">Buat Diskusi</button>
    </form>
</div>
