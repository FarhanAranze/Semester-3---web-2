<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// koneksi database
require_once 'config/database.php';
require_once 'app/Controllers/AuthController.php'; 
require_once 'app/Controllers/ProdukController.php';
require_once 'app/Controllers/BookingController.php';
require_once 'app/Controllers/LaporanController.php'; 

//DB
$db = (new Database())->getConnection();

// Action
$action = $_GET['action'] ?? 'login';

// cek
if (!isset($_SESSION['user'])) {
    
    if ($action !== 'login' && $action !== 'loginProcess' && $action !== 'logout') { 
        header("Location: index.php?action=login");
        exit;
    }
}

// Controller
$auth = new AuthController(); 


switch ($action) {

    
    case 'login':
        $auth->login();
        break;
    case 'loginProcess':
        $auth->loginProcess();
        break;
    
    
    case 'logout':
        $auth->logout();
        break;

    
    case 'produk':
        $controller = new ProdukController(); 
        $subaction = $_GET['subaction'] ?? 'daftarProduk';
        switch ($subaction) {
            
            case 'daftarProduk': $controller->daftarProduk(); break;
            case 'tambah': $controller->tambah(); break;
            case 'simpan': $controller->simpan(); break;
            case 'edit': $controller->edit(); break;
            case 'update': $controller->update(); break;
            case 'hapus': $controller->hapus(); break;
            default: echo "Aksi produk tidak ditemukan!";
        }
        break;

    
    case 'booking_views':
        $controller = new BookingController();
        $subaction = $_GET['subaction'] ?? 'daftarBooking';
        switch ($subaction) {
           
            case 'daftarBooking': $controller->daftarBooking(); break;
            case 'tambah': $controller->tambah(); break;
            case 'simpan': $controller->simpan(); break;
            case 'editStatus': $controller->editStatus(); break;
            case 'updateStatus': $controller->updateStatus(); break;
            case 'hapus': $controller->hapus(); break;
            default: echo "Aksi booking tidak ditemukan!";
        }
        break;

    
    case 'laporan_views':
       
        $controller = new LaporanController();
        $controller->tampilkanLaporan();
        break;
    
        
    
    case 'dashboard':
        require 'app/Views/index.php'; 
        break;
        
    case 'index': 
    default:
        if (isset($_SESSION['user'])) {
            require 'app/Views/index.php';
        } else {
            $auth->login();
        }
        break;
}