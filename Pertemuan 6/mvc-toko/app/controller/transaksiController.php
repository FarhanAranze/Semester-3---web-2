<?php
require_once 'app/models/Transaksi.php';

class transaksiController
{
    public function daftarTransaksi()
    {
        $transaksi = new Transaksi();
        $data = $transaksi->tampilkanSemuaTransaksi();
        require 'app/views/transaksi_views.php';

    }
}
