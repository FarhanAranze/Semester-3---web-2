<?php

$current_action = $_GET['action'] ?? 'dashboard';
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menu Navigasi</div>
                
                <a class="nav-link <?php if($current_action == 'dashboard') echo 'active'; ?>" 
                   href="index.php?action=dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                
                <a class="nav-link <?php if($current_action == 'produk') echo 'active'; ?>" 
                   href="index.php?action=produk">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                    Mobil
                </a>
                
                <a class="nav-link <?php if($current_action == 'booking_views') echo 'active'; ?>" 
                   href="index.php?action=booking_views">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Booking
                </a>
                
                <a class="nav-link <?php if($current_action == 'laporan_views') echo 'active'; ?>" 
                   href="index.php?action=laporan_views">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                    Laporan
                </a>
                
                <a class="nav-link" href="index.php?action=logout" onclick="return confirm('Anda yakin ingin logout?')">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Logout
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
        </div>
    </nav>
</div>