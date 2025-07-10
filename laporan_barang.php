<?php include ('session.php');?>
<?php include ('head.php');?>

<body>
    <!-- Navigation -->
    <?php include ('side_bar.php');?>

  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan Data Barang</h5>
                
              <hr>
              
              <!-- Print Button -->
              <form method="post" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-6">
                          <input type="date" class="form-control" name="tgl1">
                      </div>
                      <div class="col-6">
                          <input type="date" class="form-control" name="tgl2">
                      </div>
                  </div>
                  <br>
                  <button type="submit" name="proses" class="btn btn-primary" style="float: right;">Print Nota</button>
              </form>

              <?php
              if (isset($_POST['proses'])) {
                  $tgl1 = $_POST['tgl1'];
                  $tgl2 = $_POST['tgl2'];
              ?>
              <script>
                  function printNota() {
                      var printWindow = window.open('print_barang.php?tgl1=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>');
                      printWindow.onload = function() {
                          printWindow.print();
                          printWindow.onafterprint = function() {
                              printWindow.close();
                          };
                      };
                  }
                  printNota();
              </script>
              <?php } ?>

              <br><br>
                
              <!-- Table with stripped rows -->
              <table class="table datatable" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Jual</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php 
                    require 'dbcon.php';
                    $bool = false;
                    $no=1; $id=$_SESSION['ID'];
                    $query = $conn->query("SELECT * from barang ORDER BY id_barang DESC");
                    while($row = $query->fetch_array()){
                      $id_barang=$row['id_barang'];
                  ?>
                    <th scope="row"><?php echo $no; $no++;?></th>
                    <td><?php echo $row['tgl'];?></td>
                    <td><?php echo $row['nm_barang'];?></td>
                    <td><?php echo $row['stok'];?></td>
                    <td><?php echo 'Rp. '.number_format($row['hrg_jual'], 0, ",", ".");?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include ('footer.php');?>
  <?php include ('script.php');?>

</body>

</html>
