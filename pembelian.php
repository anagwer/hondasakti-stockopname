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
                <?php $query2 = $conn->query("SELECT max(id_beli) as nota FROM pembelian");
                      $row2 = $query2->fetch_array();?>
                <input type="hidden" name="id_beli" value="<?php echo $row2['nota']+1;?>" readonly style="border:0px;width:20%;">
                <button class="btn btn-primary" type="submit" name="tambah" ><i class="bi bi-plus-lg"></i> Tambah</button>
              </form>
              <?php
                  require_once 'dbcon.php';
                  if (isset ($_POST ['tambah'])){
                  $id_beli=$_POST['id_beli'];
                  $conn->query("INSERT INTO pembelian values('$id_beli','-',null,'0')")or die(mysql_error());
                  echo "<script>window.location.href='detail_beli.php?id_beli=".$id_beli."';</script>";
                  }		
              ?>  
                <hr>
                
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Barang Masuk</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php 
											require 'dbcon.php';
											$bool = false;$total=0;
                      $no=1; $id=$_SESSION['ID'];
                      $query = $conn->query("SELECT * from pembelian ORDER BY id_beli DESC");
                      while($row = $query->fetch_array()){
                        $id_beli=$row['id_beli'];
										?>
                    <th scope="row"><?php echo $no; $no++;?></th>
                    <td><?php echo $row['no_nota'];?></td>
                    <td><?php echo $row['tgl'];?></td>
                    <td><?php echo $row['total'];?></td>
                    <td style="text-align:center">
												<a href="detail_beli.php?id_beli=<?php echo $row['id_beli']?>" class="btn btn-success btn-outline"><i class="bi bi-pencil-square"></i> </a>
                        <a rel="tooltip"  title="Delete" id="<?php echo $row['id_beli'] ?>" href="#delete_pembelian<?php echo $row['id_beli'];?>"  data-toggle="modal"class="btn btn-danger btn-outline"><i class="bi bi-trash-fill"></i> </a>		
                    </td>
											    <?php 
													require 'delete_pembelian_modal.php';
                          $total=$total+$row['total'];
												?>
                  </tr>
                  <?php } ?>
                  
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