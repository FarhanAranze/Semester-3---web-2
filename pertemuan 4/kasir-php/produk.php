<div class="container-fluid px-4">
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <a href="?page=tambah_produk" class="btn btn-primary">+ Tambah Data</a>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT*FROM tb_produk");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nama_produk']; ?></td>
                <td><?php echo $data['harga_produk']; ?></td>
                <td><?php echo $data['stok_produk']; ?></td>
                <td>
                    <a href="?page=ubah_produk&&id=<?php echo $data['id_produk']; ?>" class="btn btn-warning">Ubah</a>
                    <a href="?page=hapus_produk&&id=<?php echo $data['id_produk']; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>
