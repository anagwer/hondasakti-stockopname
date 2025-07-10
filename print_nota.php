<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
<?php 
  require 'dbcon.php';
  $no_nota = $_GET['no_nota'];
  $query2 = $conn->query("SELECT * FROM penjualan WHERE nota='$no_nota'");
  $row2 = $query2->fetch_array();
  ?>
<!-- Table with stripped rows -->
  <div class="row">
    <div class="col-lg-12">
      <h2 class="text-center mb-2"><b>Nota<br>
        Hondanusantara Sakti Mertoyudan</b>
      </h2>
    </div>
  </div>
<p>
  No Nota: N<?php echo $row2['nota']?><br>
  Status Member: <?php echo $row2['status']?>
</p>  
<hr>

<table style="width:100%" class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Jumlah Beli</th>
      <th>Total</th>
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
        $total = $row['jml_beli'] * $row['hrg_jual']; 
        echo 'Rp. '.number_format($total, 0, ",", ".");
        $ttl += $total;
      ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="3">Total</td>
      <td><?php echo 'Rp. '.number_format($ttl, 0, ",", ".");?></td>
    </tr>
    <tr>
      <td colspan="3">Diskon</td>
      <td><?php
          if($row2['status']=='Member'){
            $diskon = $ttl * 10/100;
          }else{
            $diskon = 0;
          }
          echo 'Rp. '.number_format($diskon, 0, ",", ".");
          $ttl_s=$ttl-$diskon;?></td>
    </tr>
    <tr>
      <td colspan="3">Total Setelah Diskon</td>
      <td><?php echo 'Rp. '.number_format($ttl_s, 0, ",", ".");?></td>
    </tr>
  </tbody>
</table>


      <?php include ('script.php');?>

</body>

</html>