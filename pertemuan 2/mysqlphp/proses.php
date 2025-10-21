<?php 
include 'koneksi.php';
$nama = $_POST['nama'];
$pesan = $_POST['pesan'];

//input 
$sql = "insert into tbphp (nama,pesan) values ('$nama','$pesan')";
mysqli_query($koneksi,$sql);
?>
Thanks <?php echo $nama?> , pesan : <?php echo $pesan?>
<a href="index.php">back</a>