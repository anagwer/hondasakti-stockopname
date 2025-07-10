<?php include ('session.php');?>
<?php include ('head.php');?>

<body>
<?php 
  require 'dbcon.php';
  $id_beli = $_GET['id_beli'];
  $query2 = $conn->query("SELECT * FROM pembelian WHERE id_beli='$id_beli'");
  $row2 = $query2->fetch_array();
?>
<!-- Table with stripped rows -->
<div class="row">
    <div class="col-4">
      <img src="upload/situs.png" style="width:50%;">
    </div>
    <div class="col-8">
      <h2 class="text-center mb-2" style="font-weight:bold;">Laporan Detail Beli<br>
        Hondanusantara Sakti Mertoyudan<br></h2><p style="font-weight:bold;text-align:center;">
        <?php echo $row2['tgl'];?>
      </p>
    </div>
</div>
<hr>

<p>
  No Nota: <?php echo $row2['no_nota']?><br>
</p>  
<hr>

<table style="width:100%" class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Stok Masuk</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      require 'dbcon.php';
      $no = 1;
      $ttl_stok = 0;
      $query = $conn->query("SELECT * FROM detailbeli WHERE id_beli='$id_beli'");
      while($row = $query->fetch_array()){
        $id_barang = $row['id_barang'];
    ?>
    <tr>
      <th scope="row"><?php echo $no; $no++; ?></th>
      <?php 
        $query1 = $conn->query("SELECT * FROM barang WHERE id_barang='$id_barang'");
        $row1 = $query1->fetch_array();
      ?>
      <td><?php echo $row1['nm_barang']; ?></td>
      <td><?php 
          $stok_masuk = $row['stok_masuk']; // pastikan kolom ini ada di tabel detailbeli
          echo $stok_masuk;
          $ttl_stok += $stok_masuk;
        ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="1" class="text-center">Total Stok Masuk</td>
      <td><?php echo $ttl_stok; ?></td>
    </tr>
  </tbody>
</table>

<div class="row" style="margin-top:50px;">
  <div class="col-8"></div>
  <div class="col-4">
    <p class="text-center">Manager Hondanusantara<br><br>
    Bpdui<br>
    NIP. 1234567</p>
  </div>
</div>

<?php include ('script.php');?>
</body>
</html>