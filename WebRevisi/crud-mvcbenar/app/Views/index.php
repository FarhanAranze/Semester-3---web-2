<?php 
// session_start(); 

if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') { 
    header("location:/crud-mvc/login.php?pesan=belum_login"); 
    exit; 
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
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
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="index.php?action=logout" onclick="return confirm('Anda yakin ingin logout?')">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        
        <?php include 'app/Views/layout/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid px-4 py-4">
                </ol>

                <div class="dashboard-header mb-5">
                    <h1>Rental Mobil </h1>
                    <span>Melayani rental mobil untuk dalam kota dan luar kota</span>
                </div>

                <div class="d-flex justify-content-center flex-wrap gap-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-chart-area me-2"></i>Booking</h5>
                            <p class="card-text">Konfirmasi booking.</p>
                            <a href="index.php?action=booking_views" class="btn btn-primary w-100">Kelola Booking</a>
                        </div>
                    </div>

                        <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-cart-plus me-2"></i>Paket Mobil</h5>
                            <p class="card-text">Menyediakan berbagai mobil.</p>
                            <a href="index.php?action=produk" class="btn btn-primary w-100">Lihat Mobil</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-file me-2"></i>Laporan</h5>
                            <p class="card-text">Laporan jumlah booking dan pendapatan.</p>
                            <a href="index.php?action=laporan_views" class="btn btn-primary w-100">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
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
        <script src="https://cdnjs.cloudflare.com/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>