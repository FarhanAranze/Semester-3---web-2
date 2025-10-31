<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM tb_penjualan WHERE id_penjualan='$id'");
$query = mysqli_query($koneksi, "DELETE FROM tb_detailpenjualan WHERE id_penjualan='$id'");

if ($query) {
    echo '<script>alert("Data berhasil dihapus"); location.href="?page=penjualan"</script>';
} else {
    echo '<script>alert("Data gagal dihapus")</script>';
}
?>