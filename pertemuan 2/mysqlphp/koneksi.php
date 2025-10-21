<?php 
$host = "localhost" ;
$user = "root"; 
$pass = "";
$db = "dbphp";
$koneksi= mysqli_connect($host  ,$user,$pass, $db);
if ($koneksi == false) {
    die("koneksi gagal");
}

?>