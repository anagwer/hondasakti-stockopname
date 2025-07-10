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
              <h5 class="card-title">Laporan Data Pembelian</h5>
                
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
                      var printWindow = window.open('print_pembelian.php?tgl1=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>');
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
                    <th scope="col">Nota</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Print Nota</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <?php 
											require 'dbcon.php';
											$bool = false; $total=0;
                      $no=1; $id=$_SESSION['ID'];
                      $query = $conn->query("SELECT * from pembelian where total>0 ORDER BY id_beli DESC");
                      while($row = $query->fetch_array()){
                        $id_beli=$row['id_beli'];
										?>
                    <th scope="row"><?php echo $no; $no++;?></th>
                    <td><?php echo $row['no_nota'];?></td>
                    <td><?php echo $row['tgl'];?></td>
                    <td><?php echo 'Rp. '.number_format($row['total'], 0, ",", ".");?></td>
                    <td style="text-align:center;" >
                          <a href="javascript:void(0);" class="btn btn-success" onclick="printNota('<?php echo $row['id_beli']; ?>');"><i class="bi bi-printer"></i></a>
                        <script>
                        function printNota(nota) {
                            var printWindow = window.open('print_nota_beli.php?id_beli=' + nota, '_blank');
                            printWindow.onload = function() {
                                printWindow.print();
                                
                                printWindow.onafterprint = function() {
                                    printWindow.close();
                                };
                            };
                        }
                        </script>
                      </td>
                  </tr>
                  <?php $total=$total+$row['total']; } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3">Total</th>
                    <th><?php echo 'Rp. '.number_format($total, 0, ",", ".");;?></th><td></td>
                  </tr>
                </tfoot>
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
