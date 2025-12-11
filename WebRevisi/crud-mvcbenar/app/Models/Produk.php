<?php
class Produk
{
    /**
     * @var mysqli $conn Objek koneksi mysqli
     */
    private $conn;
    private $table_name = "tb_mobil"; 

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY merk ASC";
        
        $result = $this->conn->query($query);
        
        return $result; 
    }

    
    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_mobil = ? LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  (merk, nama_mobil, tahun, plat_nomor, harga_sewa_per_hari, status) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        
        $stmt->bind_param("ssisds", 
            $data['merk'],
            $data['nama_mobil'],
            $data['tahun'],
            $data['plat_nomor'],
            $data['harga_sewa_per_hari'],
            $data['status']
        );
        
        return $stmt->execute(); 
    }

    
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET merk = ?, nama_mobil = ?, tahun = ?, plat_nomor = ?, 
                      harga_sewa_per_hari = ?, status = ? 
                  WHERE id_mobil = ?";
        
        $stmt = $this->conn->prepare($query);
        
        
        $stmt->bind_param("ssisdsi", 
            $data['merk'],
            $data['nama_mobil'],
            $data['tahun'],
            $data['plat_nomor'],
            $data['harga_sewa_per_hari'],
            $data['status'],
            $id
        );
        
        return $stmt->execute();
    }

    
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_mobil = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
}