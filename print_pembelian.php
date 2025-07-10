<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
<?php 
  require 'dbcon.php';
  $tgl1 = $_GET['tgl1'];
  $tgl2 = $_GET['tgl2'];
  ?>
<!-- Table with stripped rows -->
  <div class="row">
    <div class="col-4">
      <img src="upload/situs.png" style="width:50%;">
    </div>
    <div class="col-8">
      <h2 class="text-center mb-2" style="font-weight:bold;">Laporan Data Pembelian<br>
        Hondanusantara Sakti Mertoyudan<br></h2><p class="text-center" style="font-weight:bold;"> Periode
        <?php if($tgl1==$tgl2){
          echo $tgl1;
          $query = $conn->query("SELECT * from pembelian WHERE total>0 AND tgl like '%$tgl1%' ORDER BY id_beli DESC");
        }else{
          echo $tgl1.' s.d '.$tgl2;
          $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl2)));
          $query = $conn->query("SELECT * from pembelian WHERE total>0 AND tgl BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_beli DESC");
        }?></p>
    </div>
  </div>
<hr>

<table style="width:100%" class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nota</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
  <?php 
      require 'dbcon.php';
      $bool = false;
      $no=1; $id=$_SESSION['ID'];$total=0;
      while($row = $query->fetch_array()){
        $id_beli=$row['id_beli'];
    ?>
    <th scope="row"><?php echo $no; $no++;?></th>
    <td><?php echo $row['no_nota'];?></td>
    <td><?php echo $row['tgl'];?></td>
    <td><?php echo 'Rp. '.number_format($row['total'], 0, ",", ".");?></td>
  </tr>
  <?php $total=$total+$row['total'];
			 } ?>
    
  </tbody>
  <tfoot>
    <tr>
      <th colspan="3">Total</th>
      <th><?php echo 'Rp. '.number_format($total, 0, ",", ".");;?></th><td></td>
    </tr>
  </tfoot>
</table>

<div class="row" style="margin-top:100px;">
  <div class="col-8">
  </div>
  <div class="col-4">
    <p class="text-center">Manager Hondanusantara<br><br>
    Bpdui<br>
    NIP. 1234567</p>
  </div>

      <?php include ('script.php');?>

</body>

</html>