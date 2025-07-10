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
              <h2 style="margin:20px 0px;font-weight:bold;">Entry Transaksi Baru</h2>
              <form method = "post" enctype = "multipart/form-data">
                <?php $query2 = $conn->query("SELECT max(nota) as no_nota FROM penjualan");
                      $row2 = $query2->fetch_array();?>
                <input type="hidden" name="no_nota" value="<?php echo $row2['no_nota']+1;?>" readonly style="border:0px;width:20%;">
                <button class="btn btn-primary" type="submit" name="tambah" ><i class="bi bi-plus-lg"></i> Tambah</button>
              </form>
              <?php
                  require_once 'dbcon.php';
                  if (isset ($_POST ['tambah'])){
                  $no_nota=$_POST['no_nota'];
                  $conn->query("INSERT INTO penjualan values('$no_nota','0',null,'-')")or die(mysql_error());
                  echo "<script>window.location.href='detail_jual.php?no_nota=".$no_nota."';</script>";
                  }		
              ?>  
                <hr>
                
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Total</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php 
											require 'dbcon.php';
											$bool = false;
                      $no=1; $id=$_SESSION['ID'];
                      $query = $conn->query("SELECT * from penjualan ORDER BY nota DESC");
                      while($row = $query->fetch_array()){
                        $nota=$row['nota'];
										?>
                    <th scope="row"><?php echo $no; $no++;?></th>
                    <td><?php echo 'N'.$nota;?></td>
                    <td><?php echo 'Rp. '.number_format($row['total'], 0, ",", ".");?></td>
                    <td><?php echo $row['tgl'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td style="text-align:center">
												<a href="detail_jual.php?no_nota=<?php echo $row['nota']?>" class="btn btn-success btn-outline"><i class="bi bi-pencil-square"></i> </a>
                        <a rel="tooltip"  title="Delete" id="<?php echo $row['nota'] ?>" href="#delete_penjualan<?php echo $row['nota'];?>"  data-toggle="modal"class="btn btn-danger btn-outline"><i class="bi bi-trash-fill"></i> </a>		
                    </td>
											    <?php 
													require 'delete_penjualan_modal.php';
												?>
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