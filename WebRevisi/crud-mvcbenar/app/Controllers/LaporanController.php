<?php
require_once __DIR__ . '/../Models/Booking.php';
require_once __DIR__ . '/../../config/database.php';

class LaporanController {

    private $conn;
    private $bookingModel;

    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        
       
        $this->bookingModel = new Booking($this->conn);
    }

    
    public function tampilkanLaporan() {
        
        
        $result = null; 
        $tgl_mulai = null;
        $tgl_selesai = null;
        $total_pendapatan = 0;
        $jumlah_booking = 0;

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_selesai = $_POST['tgl_selesai'];

            
            $result = $this->bookingModel->getBookingsByDateRange($tgl_mulai, $tgl_selesai);

            
            if ($result->num_rows > 0) {
                
                $result->data_seek(0); 
                while ($row = $result->fetch_assoc()) {
                    $total_pendapatan += $row['total_harga'];
                }
                $jumlah_booking = $result->num_rows;
                
                
                $result->data_seek(0);
            }

        }
        require_once __DIR__ . '/../Views/laporan/index.php';
    }

}