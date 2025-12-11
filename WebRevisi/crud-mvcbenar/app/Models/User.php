<?php
class User
{
    /**
     * @var mysqli $conn Objek koneksi mysqli
     */
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Mencari user berdasarkan username menggunakan sintaks mysqli.
     * @param string $username
     * @return mixed Mengembalikan array data user jika ditemukan, atau null jika tidak.
     */
    public function findUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    
    public function getAllUsers()
    {
        
        $query = "SELECT id, username FROM tb_user ORDER BY username ASC";
        
        $result = $this->conn->query($query);
        
        return $result; 
    }
}