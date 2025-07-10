<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Hondanusantara</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <span class="d-none d-lg-block" style="margin-left:10px;"><?php
        // Array of Indonesian day and month names
        $days = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );

        $months = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        );

// Get the current date in English
$englishDate = date('l, j F Y');

// Translate the date to Indonesian
$indonesianDate = strtr($englishDate, array_merge($days, $months));

echo $indonesianDate;
?>
</span>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="profil.php">
                    <img src="upload/<?php echo $_SESSION['FOTO']; ?>" alt="Profile" class="rounded-circle">
                </a><!-- End Profile Iamge Icon -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<?php 
    // Get current page name
    $current_page = basename($_SERVER['PHP_SELF']); 
?>
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed text-center" href="profil.php">
                <span><img src="upload/<?php echo $_SESSION['FOTO']; ?>" style="width:50%;border-radius:50%;margin:auto;"></span>
            </a>
        </li><!-- End Profile Nav -->
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'index.php' ? '' : 'collapsed'; ?>" href="index.php">
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <?php if($_SESSION['ROLE']=='Admin'){?>
        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'barang.php' ? '' : 'collapsed'; ?>" href="barang.php">
                <span>Data Barang</span>
            </a>
        </li><!-- End Data Barang Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo $current_page == 'user.php' ? '' : 'collapsed'; ?>" href="user.php">
                <span>Data User</span>
            </a>
        </li><!-- End Data User Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo in_array($current_page, ['pembelian.php', 'penjualan.php']) ? '' : 'collapsed'; ?>" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse <?php echo in_array($current_page, ['pembelian.php', 'penjualan.php']) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="pembelian.php" class="<?php echo $current_page == 'pembelian.php' ? 'active' : ''; ?>">
                        <span>Pembelian</span>
                    </a>
                </li>
                <li>
                    <a href="penjualan.php" class="<?php echo $current_page == 'penjualan.php' ? 'active' : ''; ?>">
                        <span>Penjualan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Transaksi Nav -->
        <?php }else{?>
        <li class="nav-item">
            <a class="nav-link <?php echo in_array($current_page, ['pembelian.php', 'penjualan.php']) ? '' : 'collapsed'; ?>" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
                <span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="laporan-nav" class="nav-content collapse <?php echo in_array($current_page, ['laporan_barang.php', 'laporan_pembelian.php', 'laporan_penjualan.php']) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="laporan_barang.php" class="<?php echo $current_page == 'laporan_barang.php' ? 'active' : ''; ?>">
                        <span>Barang</span>
                    </a>
                </li>
                <li>
                    <a href="laporan_pembelian.php" class="<?php echo $current_page == 'laporan_pembelian.php' ? 'active' : ''; ?>">
                        <span>Pembelian</span>
                    </a>
                </li>
                <li>
                    <a href="laporan_penjualan.php" class="<?php echo $current_page == 'laporan_penjualan.php' ? 'active' : ''; ?>">
                        <span>Penjualan</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Laporan Nav -->
        <?php }?>
        <li class="nav-item">
          <a class="nav-link <?php echo $current_page == 'logout.php' ? '' : 'collapsed'; ?>" href="logout.php">
              <span>Logout</span>
          </a>
        </li><!-- End Data User Nav -->
    </ul>
    
</aside><!-- End Sidebar -->
