<div class="container-fluid px-4">
    <h1 class="mt-4">Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Penjualan</li>
    </ol>
    <a href="?page=tambah_penjualan" class="btn btn-primary">+ Tambah Data</a>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tanggal Pembelian</th>
            <th>Nama Pelanggan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        //mengambil data dari tb pelanggan dan tb penjualan
        $query = mysqli_query($koneksi, "SELECT*FROM tb_penjualan LEFT JOIN tb_pelanggan on tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['tanggal_penjualan']; ?></td>
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td><?php echo $data['total_harga']; ?></td>
                <td>
                    <a href="?page=detail_penjualan&&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-warning">Detail</a>
                    <a href="?page=hapus_penjualan&&id=<?php echo $data['id_penjualan']; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </table>
</div>
