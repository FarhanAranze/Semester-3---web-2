<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_penjualan LEFT JOIN tb_pelanggan on tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan WHERE id_penjualan=$id");
$data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">TDetail Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Detail Penjualan</li>
    </ol>
    <a href="?page=penjualan" class="btn btn-warning">Kembali</a>
    <hr>
    <form action="" method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td><?php echo $data['nama_pelanggan']; ?></td>
            </tr>

            <?php
            $prod = mysqli_query($koneksi, "SELECT * FROM tb_detailpenjualan LEFT JOIN tb_produk on tb_produk.id_produk = tb_detailpenjualan.id_produk WHERE id_penjualan=$id");
            while ($produk = mysqli_fetch_array($prod)) {
            ?>
                <tr>
                    <td><?php echo $produk['nama_produk']; ?></td>
                    <td>:</td>
                    <td>
                        Harga Satuan <?php echo $produk['harga_produk']; ?> <br>
                        Jumlah <?php echo $produk['jumlah_produk']; ?> <br>
                        Sub Total <?php echo $produk['sub_total']; ?> <br>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td>Total</td>
                <td>:</td>
                <td>
                    <?php echo $data['total_harga']; ?>
                </td>
            </tr>
        </table>
    </form>
</div>
