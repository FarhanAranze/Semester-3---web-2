<?php 
require_once 'app/models/Pelanggan.php';

class pelangganController
{
    public function daftarPelanggan() 
    {
        $pelanggan = new Pelanggan();
        $data = $pelanggan->tampilkanSemuaPelanggan();
        require 'app/views/pelanggan_views.php';

    }
}