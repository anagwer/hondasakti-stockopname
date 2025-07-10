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
            <form method = "post" action="proses_beli.php" enctype = "multipart/form-data">
                <?php 
                $id_beli = $_GET['id_beli'];
                $query2 = $conn->query("SELECT * FROM pembelian WHERE id_beli='$id_beli'");
                $row2 = $query2->fetch_array();
                ?>
                <h2 style="margin:20px 0px;font-weight:bold;">Detail Pembelian - No nota :<input type="hidden" name="id_beli" value="<?php echo $id_beli;?>" readonly style="border:0px;width:20%;">
                <input type="text" name="no_nota" style="border:1px solid black;border-radius:10px;width:20%;"  value="<?php echo $row2['no_nota'];?>"></h2>
                    
                    <div class="row">
                    <div class="col-lg-6">
                      <a href="pembelian.php" class="btn btn-danger" style="margin-bottom:2%;">Back</a>
                    </div>
                      <div class="col-lg-6"></div>
                    <div class="col-lg-3">
                        <label class="form-label">Pilih barang:</label>
                        <select name="id_barang" id="id_barang" class="form-select" > 
                            <option selected disabled value>-- Pilih barang -- </option> 
                            <?php    
                            $result = mysqli_query($con, "select * from barang");  
                            while ($row = mysqli_fetch_array($result)) {  
                                echo '<option name="id_barang" value="'.$row['id_barang'] . '">' . $row['nm_barang'] .' | Stok: '. $row['stok'].'</option>';   
                            }  
                            ?>   
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Jumlah beli:</label>
                        <input type="number" class="form-control" name="jml_beli">
                        <input type="hidden" class="form-control" name="id_user" value="<?php echo $_SESSION['ID'];?>">
                    </div>
                    <?php if($row2['total']=='0'){?> 
                    <div class="col-lg-3">
                        <button type="submit" name="tambah" style="margin-top:12%;" class="btn btn-primary">Tambah</button>
                    </div>
                    <?php }?>
                    </div>
                <br>
                <hr>
                
              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Stok Masuk</th>
                    <?php if($row2['total']=='0'){?>
                    <th scope="col">Aksi</th>
                    <?php }?>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    require 'dbcon.php';
                    $bool=false;
                    $no = 1; 
                    $ttl = 0;
                    $query = $conn->query("SELECT * FROM detailbeli WHERE id_beli='$id_beli'");
                    while($row = $query->fetch_array()){
                      $id_detailbeli = $row['id_detailbeli'];
                      $id_barang = $row['id_barang'];
                  ?>
                  <tr>
                    <th scope="row"><?php echo $no; $no++; ?></th>
                    <?php 
                      $query1 = $conn->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
                      $row1 = $query1->fetch_array();
                    ?>
                    <td><?php echo $row1['nm_barang']; ?></td>
                    <td><?php echo $row['jml_beli']; ?></td>
                    <td><?php 
                      $total = $row['jml_beli']; 
echo $total . ' pcs';
$ttl += $total;

                    ?></td>
                    <?php if($row2['total']=='0'){?>
                    <td style="text-align:center">
                      <a href="delete_detailbeli.php?id_detailbeli=<?php echo $id_detailbeli; ?>&id_beli=<?php echo $id_beli; ?>" class="btn btn-danger btn-outline">
                        <i class="bi bi-trash-fill"></i> 
                      </a>		
                    </td>
                    <?php }
                    ?>
                  </tr>
                  <?php } ?>
                  <tr>
  <td></td><td></td><th>Total Stok Masuk</th>
  <td><input type="number" class="form-control" name="ttl" value="<?php echo $ttl;?>" readonly></td><td></td>
</tr>

                </tbody>
              </table>

              <!-- End Table with stripped rows -->
              <div class="row">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                  <?php if($row2['total']=='0'){?>
                    <button type="submit" name="proses" style="margin-top:12%;float:right;" class="btn btn-success text-right">Simpan Nota</button>
                  <?php }?>
                  
                </div>
              </div>
              </form>
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