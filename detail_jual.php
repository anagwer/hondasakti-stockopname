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
            <form method = "post" action="proses_nota.php" enctype = "multipart/form-data">
                <?php 
                $no_nota = $_GET['no_nota'];
                $query2 = $conn->query("SELECT * FROM penjualan WHERE nota='$no_nota'");
                $row2 = $query2->fetch_array();
                ?>
                <h2 style="margin:20px 0px;font-weight:bold;">Detail Penjualan - No nota :<input type="number" name="no_nota" value="<?php echo $no_nota;?>" readonly style="border:0px;width:20%;"></h2>
                    
                    
                    <div class="row">
                    <div class="col-lg-6">
                      <a href="penjualan.php" class="btn btn-danger" style="margin-bottom:2%;">Back</a>
                    </div>
                    <?php if($row2['status']!='-'){?>
                    <div class="col-lg-6 text-right">
                      <a href="javascript:void(0);" class="btn btn-primary" style="float: right;" onclick="printNota();">Print Nota</a>
                    </div>
                    <script>
                    function printNota() {
                        var printWindow = window.open('print_nota.php?no_nota=<?php echo $no_nota?>', '_blank');
                        printWindow.onload = function() {
                            printWindow.print();
                            
                            // Check for print dialog closure and close the window
                            printWindow.onafterprint = function() {
                                printWindow.close();
                            };
                        };
                    }
                    </script>
                    <?php }else{?>
                      <div class="col-lg-6"></div>
                    <div class="col-lg-3">
                        <label class="form-label">Pilih barang:</label>
                        <select name="id_barang" id="id_barang" class="form-select"> 
                            <option  selected disabled value>-- Pilih barang -- </option> 
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
                    <th scope="col">Total</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    require 'dbcon.php';
                    $bool=false;
                    $no = 1; 
                    $ttl = 0;
                    $query = $conn->query("SELECT * FROM detailjual WHERE no_nota_jual='$no_nota'");
                    while($row = $query->fetch_array()){
                      $id_detailjual = $row['id_detailjual'];
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
                      $total = $row['jml_beli'] * $row1['hrg_jual']; 
                      echo 'Rp. '.number_format($total, 0, ",", ".");
                      $ttl += $total;
                    ?></td>
                    <td style="text-align:center">
                    <?php if($row2['status']=='-'){?>
                      <a href="delete_detailjual.php?id_detailjual=<?php echo $id_detailjual; ?>&no_nota=<?php echo $no_nota; ?>" class="btn btn-danger btn-outline">
                        <i class="bi bi-trash-fill"></i> 
                      </a>		
                      <?php }?>
                    </td>
                    <?php 
                      require 'delete_penjualan_modal.php';
                    ?>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td>Total</td><td></td><td></td>
                    <td><input type="number" class="form-control" name="total" id="total" value="<?php echo $ttl;?>" readonly></td><td></td>
                  </tr>
                  <tr>
                    <td>Diskon</td><td></td><td></td>
                    <td><input type="number" class="form-control" name="diskon" id="diskon" readonly></td><td></td>
                  </tr>
                  <tr>
                    <td>Total Setelah Diskon</td><td></td><td></td>
                    <td><input type="number" class="form-control" name="total_diskon" id="total_diskon" readonly></td><td></td>
                  </tr>
                </tbody>
              </table>

              <!-- End Table with stripped rows -->
              <div class="row">
                <div class="col-lg-8">
                  <label class="form-label" style="font-weight:bold;">Pilih Status:</label>
                  <select name="member" id="member" class="form-select" required> 
                    <option value="<?php echo $row2['status'];?>"><?php echo $row2['status'];?></option>
                    <option value="Non-Member">Non-Member</option>
                    <option value="Member">Member</option>
                  </select>
                </div>
                <div class="col-lg-4">
                  <?php if($row2['status']=='-'){?>
                    <button type="submit" name="proses" style="margin-top:12%;" class="btn btn-success">Simpan Nota</button>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const memberSelect = document.getElementById('member');
    const totalInput = document.getElementById('total');
    const diskonInput = document.getElementById('diskon');
    const totalDiskonInput = document.getElementById('total_diskon');

    memberSelect.addEventListener('change', function() {
      const total = parseFloat(totalInput.value);
      let diskon = 0;

      if (memberSelect.value === 'Member') {
        diskon = total * 0.1; 
      } else {
        diskon = 0; 
      }

      diskonInput.value = diskon.toFixed(); 
      totalDiskonInput.value = (total - diskon).toFixed(); 
    });

    memberSelect.dispatchEvent(new Event('change'));
  });
  </script>                   
  <?php include ('footer.php');?>
      <?php include ('script.php');?>

</body>

</html>