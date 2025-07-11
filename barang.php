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
              <h5 class="card-title">Data Barang</h5>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="bi bi-plus-lg"></i> Tambah</button>
                <?php include ('add_barang_modal.php');?>
                <hr>
                
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Aksi</th>
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
                    <td><?php echo $row['deskripsi'];?></td>
                    <td><?php echo $row['stok'];?></td>
                    <td><?php echo 'Rp. '.number_format($row['hrg_jual'], 0, ",", ".");?></td>
                    <td style="text-align:center">
												<a rel="tooltip"  title="Edit" id="<?php echo $row['id_barang'] ?>" href="#edit_barang<?php echo $row['id_barang'];?>"  data-toggle="modal"class="btn btn-success btn-outline"><i class="bi bi-pencil-square"></i> </a>
                        <a rel="tooltip"  title="Delete" id="<?php echo $row['id_barang'] ?>" href="#delete_barang<?php echo $row['id_barang'];?>"  data-toggle="modal"class="btn btn-danger btn-outline"><i class="bi bi-trash-fill"></i> </a>		
                    </td>
											    <?php 
													require 'edit_barang_modal.php';require 'delete_barang_modal.php';
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