<?php
include 'database.php';
$db = new Database();

// var_dump($_GET['aksi']); //uji coba klik tombol simpan

//membuat variable aksi, digunakan untuk menangkap aktifitas yang dilakukan oleh user
$aksi = $_GET['aksi'];

if ($aksi == "tambah") {
    // pengujian kirim data
    // var_dump($_POST['nama']);

    // tambah data
    $db->tambahData($_POST['nama'], $_POST['alamat'], $_POST['nohp']);
    // mengarahkan tampilan ke index
    header("location:index.php");

} elseif ($aksi == "update") {
    //update data
    $db->updateData($_POST['id'], $_POST['nama'], $_POST['alamat'], $_POST['nohp']);
    header("location:index.php");

} elseif ($aksi == "hapus") {
    //hapus data
    $db->hapusData($_GET['id']);
    header("location:index.php");

}

