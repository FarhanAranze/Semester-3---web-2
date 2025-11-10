<?php

use LDAP\Result;
require_once 'config/database.php';

class Transaksi
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function tampilkanSemuaTransaksi()
    {
        $sql = "SELECT * FROM transaksi";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}