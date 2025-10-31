<?php
$id = $_GET['id'];

if (isset($_POST['nama_pelanggan'])) {
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    // proses ubah data
    $query = mysqli_query($koneksi, "UPDATE tb_pelanggan 
        SET nama_pelanggan='$nama', 
            alamat_pelanggan='$alamat', 
            no_telp_pelanggan='$no_telepon' 
        WHERE id_pelanggan='$id'");

    if ($query) {
        echo '<script>alert("Data berhasil diubah"); location.href="?page=pelanggan"</script>';
    } else {
        echo '<script>alert("Data gagal diubah");</script>';
    }
}

// mengambil data pelanggan yang akan diubah
$query = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id'");
$data = mysqli_fetch_array($query);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah Data Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ubah Data Pelanggan</li>
    </ol>

    <a href="?page=pelanggan" class="btn btn-warning">Kembali</a>
    <hr>

    <form action="" method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
                    <input class="form-control" 
                           type="text" 
                           name="nama_pelanggan" 
                           value="<?php echo $data['nama_pelanggan']; ?>">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>
                    <textarea class="form-control" 
                              name="alamat" 
                              id="alamat"><?php echo $data['alamat_pelanggan']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td>
                    <input class="form-control" 
                           type="number" 
                           name="no_telepon" 
                           value="<?php echo $data['no_telp_pelanggan']; ?>">
                </td>
            </tr>
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
