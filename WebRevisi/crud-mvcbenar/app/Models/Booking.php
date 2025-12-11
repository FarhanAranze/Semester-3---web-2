<?php
class Booking
{
    /**
     * @var mysqli $conn Objek koneksi mysqli
     */
    private $conn;
    private $table_name = "tb_booking";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    
    public function getAll()
    {
        $query = "SELECT 
                    b.id_booking,
                    b.tanggal_booking,
                    b.tanggal_mulai_sewa,
                    b.tanggal_selesai_sewa,
                    b.total_harga,
                    b.status_booking,
                    m.merk AS merk_mobil,
                    m.nama_mobil,
                    u.username AS nama_user
                  FROM 
                    " . $this->table_name . " b
                  JOIN 
                    tb_mobil m ON b.id_mobil = m.id_mobil
                  JOIN 
                    tb_user u ON b.id_user = u.id
                  ORDER BY 
                    b.tanggal_booking DESC";
        
        $result = $this->conn->query($query);
        
        return $result;
    }

    
    public function findById($id)
    {
        $query = "SELECT 
                    b.*, 
                    m.merk, 
                    m.nama_mobil,
                    u.username
                  FROM 
                    " . $this->table_name . " b
                  JOIN 
                    tb_mobil m ON b.id_mobil = m.id_mobil
                  JOIN 
                    tb_user u ON b.id_user = u.id
                  WHERE 
                    b.id_booking = ? 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    public function updateStatus($id, $status)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET status_booking = ? 
                  WHERE id_booking = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $status, $id);
        
        return $stmt->execute();
    }

    
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_booking = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    
    /**
     * Menyimpan data booking BARU ke database.
     */
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_mobil, id_user, tanggal_mulai_sewa, tanggal_selesai_sewa, total_harga, status_booking) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bind_param("iissds", 
            $data['id_mobil'],
            $data['id_user'],
            $data['tanggal_mulai_sewa'],
            $data['tanggal_selesai_sewa'],
            $data['total_harga'],
            $data['status_booking']
        );
        
        return $stmt->execute();
    }

    
    public function getBookingsByDateRange($tgl_mulai, $tgl_selesai)
    {
        
        $query = "SELECT 
                    b.id_booking,
                    b.tanggal_booking,
                    b.tanggal_mulai_sewa,
                    b.tanggal_selesai_sewa,
                    b.total_harga,
                    b.status_booking,
                    m.merk AS merk_mobil,
                    m.nama_mobil,
                    u.username AS nama_user
                  FROM 
                    " . $this->table_name . " b
                  JOIN 
                    tb_mobil m ON b.id_mobil = m.id_mobil
                  JOIN 
                    tb_user u ON b.id_user = u.id
                  WHERE 
                    b.tanggal_mulai_sewa BETWEEN ? AND ?
                    AND b.status_booking IN ('Dikonfirmasi', 'Selesai')
                  ORDER BY 
                    b.tanggal_mulai_sewa ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $tgl_mulai, $tgl_selesai);
        $stmt->execute();
        
        return $stmt->get_result(); // Kirim result set ke controller
    }
}