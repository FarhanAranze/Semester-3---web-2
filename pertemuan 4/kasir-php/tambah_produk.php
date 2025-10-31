<?php
if (isset($_POST['nama_produk'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $query = mysqli_query($koneksi, "INSERT INTO tb_produk(nama_produk, harga_produk, stok_produk) 
                                    VALUES('$nama', '$harga', '$stok')");
    if ($query) {
        echo '<script>alert("Data berhasil disimpan"); location.href="?page=produk"</script>';
    } else {
        echo '<script>alert("Data gagal disimpan")</script>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>

    <a href="?page=produk" class="btn btn-warning">Kembali</a>

    <form action="" method="post">
        <div class="mb-3 mt-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok Produk</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>