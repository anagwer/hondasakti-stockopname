<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
    <!-- Navigation -->
    <?php include ('side_bar.php');?>

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-3">
            <!-- Sales Card -->
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Jumlah User</h5>

                <div class="d-flex align-items-center">
                  <div class="ps-3">
                    <h6><?php 
                      require 'dbcon.php';
                      $query1 = $conn->query("SELECT COUNT(*) as jml FROM user");
                      $row1 = $query1->fetch_array();
                      echo $row1['jml'];
                    ?></h6>

                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
        </div>
        <!-- Left side columns -->
        <div class="col-lg-3">
            <!-- Sales Card -->
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Data Barang</h5>

                <div class="d-flex align-items-center">
                  <div class="ps-3">
                    <h6><?php 
                      require 'dbcon.php';
                      $query1 = $conn->query("SELECT COUNT(*) as jml FROM barang");
                      $row1 = $query1->fetch_array();
                      echo $row1['jml'];
                    ?></h6>

                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
        </div>
        <!-- Left side columns -->
        <div class="col-lg-3">
            <!-- Sales Card -->
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Data Pembelian</h5>

                <div class="d-flex align-items-center">
                  <div class="ps-3">
                    <h6><?php 
                      require 'dbcon.php';
                      $query1 = $conn->query("SELECT COUNT(*) as jml FROM pembelian where total!=0");
                      $row1 = $query1->fetch_array();
                      echo $row1['jml'];
                    ?></h6>

                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
        </div>
        <!-- Left side columns -->
        <div class="col-lg-3">
            <!-- Sales Card -->
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Data Penjualan</h5>

                <div class="d-flex align-items-center">
                  <div class="ps-3">
                    <h6><?php 
                      require 'dbcon.php';
                      $query1 = $conn->query("SELECT COUNT(*) as jml FROM penjualan where total!=0");
                      $row1 = $query1->fetch_array();
                      echo $row1['jml'];
                    ?></h6>

                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
        </div>
        <!-- Left side columns -->
        <div class="col-lg-12">
            <!-- Sales Card -->
            <div class="card info-card sales-card">
              <div class="card-body text-center">
                <img src="upload/situs.png" style="width:30%; margin:10% 0% 3% 0%;">
                <h1>Hondanusantara Sakti Mertoyudan</h1>
                <h3>Alamat: Nusantara Sakti Magelang, Jl. Mayjen Bambang Soegeng<bR> (Ruko Metro Square Blok C15-C16), Jarangan, Sumberrejo, Mertoyudan, Magelang</h2>
              </div>
            </div><!-- End Sales Card -->
        </div>
  </main><!-- End #main -->

  <?php include ('footer.php');?>
      <?php include ('script.php');?>

</body>

</html>