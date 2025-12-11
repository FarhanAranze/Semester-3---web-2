<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit();
}

// $mobil dari controller
if (!isset($mobil)) {
    echo "Error: Data mobil tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Mobil - Rental Mobil</title>
    
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
                    <h1 class="mt-4">Edit Data Mobil</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php?action=produk">Manajemen Mobil</a></li>
                        <li class="breadcrumb-item active">Edit Mobil</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Formulir Edit Mobil
                        </div>
                        <div class="card-body">
                            <form action="index.php?action=produk&subaction=update" method="POST">
                                
                                <input type="hidden" name="id_mobil" value="<?php echo $mobil['id_mobil']; ?>">
                                
                                <div class="mb-3">
                                    <label for="merk" class="form-label">Merk Mobil</label>
                                    <input type="text" class="form-control" id="merk" name="merk" required 
                                           value="<?php echo htmlspecialchars($mobil['merk']); ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nama_mobil" class="form-label">Nama Mobil</label>
                                    <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" required
                                           value="<?php echo htmlspecialchars($mobil['nama_mobil']); ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tahun" class="form-label">Tahun</label>
                                            <input type="number" class="form-control" id="tahun" name="tahun" min="1990" max="2030"
                                                   value="<?php echo htmlspecialchars($mobil['tahun']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="plat_nomor" class="form-label">Plat Nomor</label>
                                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required
                                                   value="<?php echo htmlspecialchars($mobil['plat_nomor']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="harga_sewa_per_hari" class="form-label">Harga Sewa / Hari (Rp)</label>
                                            <input type="number" class="form-control" id="harga_sewa_per_hari" name="harga_sewa_per_hari" required
                                                   value="<?php echo htmlspecialchars($mobil['harga_sewa_per_hari']); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="Tersedia" <?php if($mobil['status'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                                                <option value="Disewa" <?php if($mobil['status'] == 'Disewa') echo 'selected'; ?>>Disewa</option>
                                                <option value="Perawatan" <?php if($mobil['status'] == 'Perawatan') echo 'selected'; ?>>Perawatan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success">Update Data</button>
                                    <a href="index.php?action=produk" class="btn btn-secondary">Batal</a>
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
            
        </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>