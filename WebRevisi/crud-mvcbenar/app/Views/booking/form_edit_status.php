<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit();
}

// $booking dari controller
if (!isset($booking)) {
    echo "Error: Data booking tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Ubah Status Booking - Rental Mobil</title>
    
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand ps-3" href="index.php?action=dashboard">Rental mobil</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="index.php?action=logout" onclick="return confirm('Anda yakin ingin logout?')">Logout</a></li> 
                </ul>
            </li>
        </ul>
    </nav>
    
    <div id="layoutSidenav">
        
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    <h1 class="mt-4">Ubah Status Booking</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php?action=booking_views">Manajemen Booking</a></li>
                        <li class="breadcrumb-item active">Ubah Status</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Formulir Ubah Status (ID Booking: <?php echo $booking['id_booking']; ?>)
                        </div>
                        <div class="card-body">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">                                    
                                    <p><strong>Mobil:</strong> <?php echo htmlspecialchars($booking['merk'] . ' - ' . $booking['nama_mobil']); ?></p>
                                    <p><strong>Mulai Sewa:</strong> <?php echo htmlspecialchars($booking['tanggal_mulai_sewa']); ?></p>
                                    <p><strong>Selesai Sewa:</strong> <?php echo htmlspecialchars($booking['tanggal_selesai_sewa']); ?></p>
                                    </div>
                                    
                            </div>
                            <hr>

                            <form action="index.php?action=booking_views&subaction=updateStatus" method="POST">
                                
                                <input type="hidden" name="id_booking" value="<?php echo $booking['id_booking']; ?>">
                                
                                <div class="mb-3">
                                    <label for="status_booking" class="form-label">Ubah Status Booking</label>
                                    <select class="form-select" id="status_booking" name="status_booking">
                                        <option value="Pending" <?php if($booking['status_booking'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                        <option value="Dikonfirmasi" <?php if($booking['status_booking'] == 'Dikonfirmasi') echo 'selected'; ?>>Dikonfirmasi</option>
                                        <option value="Selesai" <?php if($booking['status_booking'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                                        <option value="Dibatalkan" <?php if($booking['status_booking'] == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success">Update Status</button>
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
    <script src="js/scripts.js"></script>
</body>
</html>