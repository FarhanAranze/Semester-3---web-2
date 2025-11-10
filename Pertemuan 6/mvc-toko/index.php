<?php
require_once 'config/database.php';
require_once 'app/controller/produkController.php';
require_once 'app/controller/pelangganController.php';
require_once 'app/controller/transaksiController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$controller = null;

switch ($page) {
    case "produk":
        $controller = new produkController();
        $controller->daftarProduk();
        break;
        
        case "pelanggan":
            $controller = new pelangganController();
            $controller->daftarPelanggan();
        break;
        
        case "transaksi":
            $controller = new transaksiController();
            $controller->daftarTransaksi();
        break;

    default:
        require_once 'app/views/index.php';
        break;
}