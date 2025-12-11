<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit();
}

// $data_mobil dari BookingController.php
if (!isset($data_mobil)) {
    echo "Error: Gagal memuat data mobil.";
    exit();
}

// Ambil id_user dari session
$id_user = $_SESSION['user']['id']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Booking - Rental Mobil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand ps-3" href="index.php?action=dashboard">Rental mobil</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    
    <div id="layoutSidenav">
        
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    <h1 class="mt-4">Tambah Booking Baru</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php?action=booking_views">Manajemen Booking</a></li>
                        <li class="breadcrumb-item active">Tambah Booking</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-plus me-1"></i>
                            Formulir Tambah Booking
                        </div>
                        <div class="card-body">
                            <form action="index.php?action=booking_views&subaction=simpan" method="POST">
                                
                                <!-- Kirim id_user secara hidden -->
                                <input type="hidden" name="id_user" value="<?= $id_user ?>">

                                <div class="mb-3">
                                    <label for="id_mobil" class="form-label">Pilih Mobil</label>
                                    <select class="form-select" id="id_mobil" name="id_mobil" required>
                                        <option value="">-- Pilih Mobil --</option>
                                        <?php
                                        if ($data_mobil->num_rows > 0) {
                                            while($mobil = $data_mobil->fetch_assoc()) {
                                                echo '<option value="' . $mobil['id_mobil'] . '" data-harga="' . $mobil['harga_sewa_per_hari'] . '">'
                                                    . htmlspecialchars($mobil['merk'] . ' - ' . $mobil['nama_mobil']) .
                                                    ' (Rp ' . number_format($mobil['harga_sewa_per_hari']) . '/hari)</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_mulai_sewa" class="form-label">Tanggal Mulai Sewa</label>
                                            <input type="date" class="form-control" id="tanggal_mulai_sewa" name="tanggal_mulai_sewa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_selesai_sewa" class="form-label">Tanggal Selesai Sewa</label>
                                            <input type="date" class="form-control" id="tanggal_selesai_sewa" name="tanggal_selesai_sewa" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="total_harga" class="form-label">Total Harga (Rp)</label>
                                            <input type="number" class="form-control" id="total_harga" name="total_harga" placeholder="Akan terisi otomatis" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status_booking" class="form-label">Status Booking</label>
                                            <select class="form-select" id="status_booking" name="status_booking">
                                                <option value="Dikonfirmasi" selected>Dikonfirmasi</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Dibatalkan">Dibatalkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan Booking</button>
                                    <a href="index.php?action=booking_views" class="btn btn-secondary">Batal</a>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
            
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- SCRIPT HITUNG TOTAL HARGA OTOMATIS -->
    <script>
        const mobilSelect = document.getElementById('id_mobil');
        const tglMulai = document.getElementById('tanggal_mulai_sewa');
        const tglSelesai = document.getElementById('tanggal_selesai_sewa');
        const totalHargaInput = document.getElementById('total_harga');

        function hitungTotalHarga() {
            const hargaPerHari = parseInt(mobilSelect.selectedOptions[0]?.getAttribute('data-harga') || 0);
            const mulai = new Date(tglMulai.value);
            const selesai = new Date(tglSelesai.value);

            if (!isNaN(mulai) && !isNaN(selesai) && hargaPerHari > 0) {
                let selisihHari = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24)) + 1;
                if (selisihHari > 0) {
                    const total = selisihHari * hargaPerHari;
                    totalHargaInput.value = total;
                } else {
                    totalHargaInput.value = 0;
                }
            } else {
                totalHargaInput.value = 0;
            }
        }

        mobilSelect.addEventListener('change', hitungTotalHarga);
        tglMulai.addEventListener('change', hitungTotalHarga);
        tglSelesai.addEventListener('change', hitungTotalHarga);

        // Agar tanggal tidak bisa sebelumnya dari hari ini
        const today = new Date().toISOString().split('T')[0];
        tglMulai.setAttribute('min', today);
        tglSelesai.setAttribute('min', today);
    </script>

</body>
</html>
