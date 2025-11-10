<?php 
class database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "dbtoko";
    private $conn;

    public function __construct() {
        $this->connect();
    }
    private function connect (){
        $this->conn =new mysqli($this->host,$this->user,$this->password,$this->dbname);
        if ($this->conn->connect_error) {
        die ("koneksi gagal : ". $this->conn->connect_error);
        }        
    }

    public function getConnection(){
        return $this->conn;
    }

}
?>