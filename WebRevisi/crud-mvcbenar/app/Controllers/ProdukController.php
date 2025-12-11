<?php
require_once __DIR__ . '/../Models/Produk.php';
require_once __DIR__ . '/../../config/database.php'; 
class ProdukController {

    private $conn;
    private $model;

    
    public function __construct() {
        
        $database = new Database();
        $this->conn = $database->getConnection();
        
        
        $this->model = new Produk($this->conn);
    }

    
    public function daftarProduk() {
        
        $result = $this->model->getAll();
        
        require_once __DIR__ . '/../Views/produk/index.php';
    }

    
    public function tambah() {
        
        require_once __DIR__ . '/../Views/produk/form_tambah.php';
    }

    
    public function simpan() {
        // Ambil data,method POST
        $data = [
            'merk' => $_POST['merk'],
            'nama_mobil' => $_POST['nama_mobil'],
            'tahun' => $_POST['tahun'],
            'plat_nomor' => $_POST['plat_nomor'],
            'harga_sewa_per_hari' => $_POST['harga_sewa_per_hari'],
            'status' => $_POST['status']
        ];

        
        if ($this->model->create($data)) {
            header("Location: index.php?action=produk");
            exit();
        } else {
            echo "Error: Gagal menyimpan data mobil.";
        }
    }

    
    public function edit() {
        
        $id = $_GET['id'];
        
        
        $mobil = $this->model->findById($id);

        
        require_once __DIR__ . '/../Views/produk/form_edit.php';
    }

    
    public function update() {
       
        $id = $_POST['id_mobil'];

        $data = [
            'merk' => $_POST['merk'],
            'nama_mobil' => $_POST['nama_mobil'],
            'tahun' => $_POST['tahun'],
            'plat_nomor' => $_POST['plat_nomor'],
            'harga_sewa_per_hari' => $_POST['harga_sewa_per_hari'],
            'status' => $_POST['status']
        ];

        // Kirim ke model untuk update
        if ($this->model->update($id, $data)) {
            
            header("Location: index.php?action=produk");
            exit();
        } else {
            
            echo "Error: Gagal mengupdate data mobil.";
        }
    }

    
    public function hapus() {
        
        $id = $_GET['id'];

        
        if ($this->model->delete($id)) {
            header("Location: index.php?action=produk");
            exit();
        } else {
            
            echo "Error: Gagal menghapus data mobil.";
        }
    }
}