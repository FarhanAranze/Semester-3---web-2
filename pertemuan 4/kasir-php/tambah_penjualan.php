<?php
if (isset($_POST['id_pelanggan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y/m/d');

    //insert data penjualan
    $query = mysqli_query($koneksi, "INSERT INTO tb_penjualan(tanggal_penjualan, id_pelanggan) values('$tanggal','$id_pelanggan')");
    //menampilkan data penjualan
    $idTerakhir = mysqli_fetch_array(mysqli_query($koneksi,"SELECT*FROM tb_penjualan ORDER BY id_penjualan DESC"));
    $id_penjualan = $idTerakhir['id_penjualan'];

    foreach ($produk as $key => $value) {
        $pr = mysqli_fetch_array(mysqli_query($koneksi, "SELECT*FROM tb_produk WHERE id_produk=$key"));
        if ($value > 0) {
            $sub = $value * $pr['harga_produk'];
            $total += $sub;
            $query = mysqli_query($koneksi,"INSERT INTO tb_detailpenjualan(id_penjualan, id_produk, jumlah_produk, sub_total) values('$id_penjualan','$key','$value','$sub')");

            // update produk
            $updateProduk = mysqli_query($koneksi,"UPDATE tb_produk set stok_produk=stok_produk-$value WHERE id_produk=$key");
        }
    }
    //update data penjualan setelah melakukan transaksi
    $query = mysqli_query($koneksi,"UPDATE tb_penjualan SET total_harga=$total WHERE id_penjualan=$id_penjualan");

    if ($query) {
        echo '<script>alert("Data berhasil disimpan"); location.href="?page=penjualan"</script>';
    }else{
        echo '<script>alert("Data gagal disimpan")</script>';
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Penjualan</li>
    </ol>
    <a href="?page=penjualan" class="btn btn-warning">Kembali</a>
    <hr>
    <form action="" method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
                    <select class="form-control form-select" name="id_pelanggan" id="">
                        <?php
                        $plg = mysqli_query($koneksi, "SELECT*FROM tb_pelanggan");
                        while ($pel = mysqli_fetch_array($plg)) {
                        ?>
                            <option value="<?php echo $pel['id_pelanggan']; ?>"><?php echo $pel['nama_pelanggan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <?php
            $prod = mysqli_query($koneksi, "SELECT*FROM tb_produk");
            while ($produk = mysqli_fetch_array($prod)) {
            ?>
                <tr>
                    <td><?php echo $produk['nama_produk'] . '<br>' . '(Stok : ' .$produk['stok_produk'].')'; ?></td>
                    <td>:</td>
                    <td><input class="form-control" type="number" step="0" value="0" max="<?php echo $produk['stok_produk']; ?>" name="produk[<?php echo $produk['id_produk']; ?>]" ></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </td>
            </tr>
        </table>
    </form>
</div>
