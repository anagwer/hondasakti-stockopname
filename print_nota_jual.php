<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
<?php 
  require 'dbcon.php';
  $nota = $_GET['nota'];
  $query2 = $conn->query("SELECT * FROM penjualan WHERE nota='$nota'");
  $row2 = $query2->fetch_array();
  ?>
<!-- Table with stripped rows -->
<div class="row">
    <div class="col-4">
      <img src="upload/situs.png" style="width:50%;">
    </div>
    <div class="col-8">
      <h2 class="text-center mb-2" style="font-weight:bold;">Laporan Detail Jual<br>
        Hondanusantara Sakti Mertoyudan<br></h2><p style="font-weight:bold;text-align:center;">
        <?php echo $row2['tgl'];?>
      </p>
    </div>
  </div>
<hr>

<p>
  No Nota: <?php echo $row2['nota']?><br>
  Status Member: <?php echo $row2['status']?>
</p>  
<hr>

<table style="width:100%" class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Harga Satuan</th>
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
      $query = $conn->query("SELECT * FROM detailjual WHERE no_nota_jual='$nota'");
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
      <td><?php echo 'Rp. '.number_format($row['hrg_jual'], 0, ",", ".");; ?></td>
      <td><?php echo $row['jml_beli']; ?></td>
      <td><?php 
        $total = $row['jml_beli'] * $row['hrg_jual']; 
        echo 'Rp. '.number_format($total, 0, ",", ".");
        $ttl += $total;
      ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="4">Total</td>
      <td><?php echo 'Rp. '.number_format($ttl, 0, ",", ".");?></td>
    </tr>
    <tr>
      <td colspan="4">Diskon</td>
      <td><?php 
      if($row2['status']=='Member'){
        $diskon = $ttl*10/100; }
        else{
          $diskon =0;
        }echo 'Rp. '.number_format($diskon, 0, ",", ".");?></td>
    </tr>
    <tr>
      <td colspan="4">Total Setelah Diskon</td>
      <td><?php $hasil=$ttl-$diskon;echo 'Rp. '.number_format($hasil, 0, ",", ".")?></td>
    </tr>
  </tbody>
</table>

<div class="row" style="margin-top:50px;">
  <div class="col-8">
  </div>
  <div class="col-4">
    <p class="text-center">Manager Hondanusantara<br><br>
    Bpdui<br>
    NIP. 1234567</p>
  </div>
</div>
      <?php include ('script.php');?>

</body>

</html>