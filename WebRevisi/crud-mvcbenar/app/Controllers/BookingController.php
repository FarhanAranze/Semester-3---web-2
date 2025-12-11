<?php

require_once __DIR__ . '/../Models/Booking.php';
require_once __DIR__ . '/../Models/Produk.php'; 
require_once __DIR__ . '/../Models/User.php';   
require_once __DIR__ . '/../../config/database.php';

class BookingController {

    private $conn;
    private $model;
    
    
    private $produkModel;
    private $userModel;

    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        $this->model = new Booking($this->conn);
        $this->produkModel = new Produk($this->conn); 
        $this->userModel = new User($this->conn);     
    }

    
    public function daftarBooking() {
        $result = $this->model->getAll();
        require_once __DIR__ . '/../Views/booking/index.php';
    }

    
    public function tambah() {
        
        $data_mobil = $this->produkModel->getAll();
        
        
        $data_user = $this->userModel->getAllUsers();
        
        
        require_once __DIR__ . '/../Views/booking/form_tambah.php';
    }

    
    public function simpan() {
        
        $data = [
            'id_mobil' => $_POST['id_mobil'],
            'id_user' => $_POST['id_user'],
            'tanggal_mulai_sewa' => $_POST['tanggal_mulai_sewa'],
            'tanggal_selesai_sewa' => $_POST['tanggal_selesai_sewa'],
            'total_harga' => $_POST['total_harga'],
            'status_booking' => $_POST['status_booking'] 
        ];

        
        if ($this->model->create($data)) {
            
            header("Location: index.php?action=booking_views");
            exit();
        } else {
            
            echo "Error: Gagal menyimpan data booking.";
        }
    }
    
    public function editStatus() {
        $id = $_GET['id'];
        $booking = $this->model->findById($id);
        require_once __DIR__ . '/../Views/booking/form_edit_status.php';
    }

    
    public function updateStatus() {
        $id = $_POST['id_booking'];
        $status = $_POST['status_booking'];

        if ($this->model->updateStatus($id, $status)) {
            header("Location: index.php?action=booking_views");
            exit();
        } else {
            echo "Error: Gagal mengupdate status booking.";
        }
    }

    
    public function hapus() {
        $id = $_GET['id'];

        if ($this->model->delete($id)) {
            header("Location: index.php?action=booking_views");
            exit();
        } else {
            echo "Error: Gagal menghapus data booking.";
        }
    }
}