<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
<?php 
  require 'dbcon.php';
  $tgl1 = $_GET['tgl1'];
  $tgl2 = $_GET['tgl2'];
  $query2 = $conn->query("SELECT * FROM penjualan WHERE tgl BETWEEN '$tgl1' AND '$tgl2'");
  $row2 = $query2->fetch_array();
  ?>
<!-- Table with stripped rows -->
  <div class="row">
    <div class="col-4">
      <img src="upload/situs.png" style="width:50%;">
    </div>
    <div class="col-8">
      <h2 class="text-center mb-2" style="font-weight:bold;">Laporan Data Barang<br>
        Hondanusantara Sakti Mertoyudan<br></h2><p class="text-center" style="font-weight:bold;"> Periode
        <?php if($tgl1==$tgl2){
          echo $tgl1;
          $query = $conn->query("SELECT * from barang WHERE tgl like '%$tgl1%' ORDER BY id_barang DESC");
        }else{
          echo $tgl1.' s.d '.$tgl2;
          $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl2)));
          $query = $conn->query("SELECT * from barang WHERE tgl BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_barang DESC");
        }?></p>
    </div>
  </div>
<hr>

<table style="width:100%" class="table">
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

<div class="row" style="margin-top:100px;">
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