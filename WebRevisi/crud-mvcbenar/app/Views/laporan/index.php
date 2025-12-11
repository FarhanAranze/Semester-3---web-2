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
    <title>Laporan Pendapatan - Rental Mobil</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand ps-3" href="index.php?action=dashboard">Rental mobil</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="index.php?action=logout"
                            onclick="return confirm('Anda yakin ingin logout?')">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">

        <?php include __DIR__ . '/../layout/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    <h1 class="mt-4">Laporan Pendapatan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php?action=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-filter me-1"></i>
                            Filter Laporan
                        </div>
                        <div class="card-body">
                            <form action="index.php?action=laporan_views" method="POST">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" id="tgl_mulai" name="tgl_mulai" type="date"
                                                value="<?php echo htmlspecialchars($tgl_mulai ?? ''); ?>" required />
                                            <label for="tgl_mulai">Dari Tanggal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <input class="form-control" id="tgl_selesai" name="tgl_selesai" type="date"
                                                value="<?php echo htmlspecialchars($tgl_selesai ?? ''); ?>" required />
                                            <label for="tgl_selesai">Sampai Tanggal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-grid">
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <?php if ($result !== null): ?>

                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        <div class="fs-5">Total Pendapatan</div>
                                        <div class="fs-3 fw-bold">Rp
                                            <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="fs-5">Jumlah Booking</div>
                                        <div class="fs-3 fw-bold"><?php echo $jumlah_booking; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Detail Laporan dari <?php echo htmlspecialchars($tgl_mulai); ?> s/d
                                <?php echo htmlspecialchars($tgl_selesai); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo htmlspecialchars($row['merk_mobil'] . ' - ' . $row['nama_mobil']); ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($row['tanggal_mulai_sewa']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['tanggal_selesai_sewa']); ?></td>
                                                    <td><?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <?php $status = $row['status_booking'];
                                                        $badge_class = ($status == 'Dikonfirmasi') ? 'bg-success' : 'bg-info text-dark';
                                                        echo '<span class="badge ' . $badge_class . '">' . htmlspecialchars($status) . '</span>';
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            } // Akhir while loop
                                        } else {
                                            echo '<tr><td colspan="7">Tidak ada data booking pada rentang tanggal ini.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data booking yang Dikonfirmasi/Selesai ditemukan pada rentang tanggal tersebut.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">
                            Silakan pilih rentang tanggal dan klik "Tampilkan" untuk melihat laporan.
                        </div>
                    <?php endif; ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script>
        // Kita inisialisasi datatables di sini
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
</body>

</html>