<?php 
require_once 'app/models/Produk.php';

class produkController
{
    public function daftarProduk() 
    {
        $produk = new Produk();
        $data = $produk->tampilkanSemuaProduk();
        require 'app/views/produk_views.php';

    }
}