<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Manajemen Booking - Rental Mobil</title>
    
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
                    <h1 class="mt-4">Manajemen Data Booking</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Booking</li>
                    </ol>

                    <div class="mb-3">
                        <a href="index.php?action=booking_views&subaction=tambah" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Booking Baru
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Booking
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mobil</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Total (Rp)</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // $result dari BookingController.php
                                    $no=1;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['merk_mobil'] . ' - ' . $row['nama_mobil']); ?></td>
                                            <td><?php echo htmlspecialchars($row['tanggal_mulai_sewa']); ?></td>
                                            <td><?php echo htmlspecialchars($row['tanggal_selesai_sewa']); ?></td>
                                            <td><?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                            
                                            <td>
                                                <?php 
                                                $status = $row['status_booking'];
                                                $badge_class = 'bg-secondary';
                                                if ($status == 'Pending') {
                                                    $badge_class = 'bg-warning text-dark';
                                                } elseif ($status == 'Dikonfirmasi') {
                                                    $badge_class = 'bg-success';
                                                } elseif ($status == 'Selesai') {
                                                    $badge_class = 'bg-info text-dark';
                                                } elseif ($status == 'Dibatalkan') {
                                                    $badge_class = 'bg-danger';
                                                }
                                                echo '<span class="badge ' . $badge_class . '">' . htmlspecialchars($status) . '</span>';
                                                ?>
                                            </td>
                                            
                                            <td>
                                                <a href="index.php?action=booking_views&subaction=editStatus&id=<?php echo $row['id_booking']; ?>" class="btn btn-success btn-sm" title="Ubah Status">
                                                    <i class="fas fa-check-circle"></i> Ubah Status
                                                </a>
                                                <a href="index.php?action=booking_views&subaction=hapus&id=<?php echo $row['id_booking']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        } 
                                    } else {
                                        echo '<tr><td colspan="8">Belum ada data booking.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
</body>
</html>